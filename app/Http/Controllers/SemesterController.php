<?php

namespace App\Http\Controllers;

use App\Models\Cr;
use App\Models\Department;
use App\Models\Semester;
use App\Models\SemesterCr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SemesterController extends Controller
{
    /**
     * Display a listing of semesters.
     */
    public function index()
    {
        $semesters = Semester::with('department')->get();
        return view('semesters.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new semester.
     */
    public function create()
    {
        $departments = Department::all();
        return view('semesters.create', compact('departments'));
    }

    /**
     * Store a newly created semester.
     */
    public function store(Request $request)
    {
        // Validate basic semester data
        $validatedData = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'semester_number' => 'required|integer|between:1,8',
            'name' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        // Handle CR assignment if checkbox is checked
        if ($request->has('assign_cr')) {
            // Check if creating a new CR or using an existing one
            if ($request->input('cr_selection_type') === 'new') {
                // Validate new CR data
                $request->validate([
                    'cr_name' => 'required|string|max:255',
                    'cr_email' => 'required|email|unique:crs,cr_email',
                    'reg_no' => 'required|string|max:50',
                    'section' => 'required|string|max:10',
                    'password' => 'required|string|min:6|confirmed',
                ]);
            } else {
                // Validate existing CR selection
                $request->validate([
                    'cr_id' => 'required|exists:crs,id',
                ]);
            }
        }

        // Use DB transaction to ensure both semester and CR association are saved
        DB::beginTransaction();

        try {
            // Create the semester
            $semester = Semester::create($validatedData);

            // Handle CR assignment if requested
            if ($request->has('assign_cr')) {
                $crId = null;

                // Create a new CR if needed
                if ($request->input('cr_selection_type') === 'new') {
                    $cr = Cr::create([
                        'cr_name' => $request->input('cr_name'),
                        'cr_email' => $request->input('cr_email'),
                        'reg_no' => $request->input('reg_no'),
                        'section' => $request->input('section'),
                        'semester' => $semester->semester_number,
                        'password' => Hash::make($request->input('password')),
                    ]);
                    $crId = $cr->id;
                } else {
                    // Use existing CR
                    $crId = $request->input('cr_id');
                }

                // Create association between semester and CR
                if ($crId) {
                    // Add the association
                    DB::table('semester_crs')->insert([
                        'semester_id' => $semester->id,
                        'cr_id' => $crId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('semesters.index')
                ->with('success', 'Semester created successfully' . ($request->has('assign_cr') ? ' with CR assigned' : ''));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create semester: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified semester.
     */
    public function show(Semester $semester)
    {
        // Load the timetables for this semester
        $semester->load(['timetables.subject', 'timetables.teacher', 'timetables.cr', 'department']);
        
        return view('semesters.show', compact('semester'));
    }

    /**
     * Show the form for editing the specified semester.
     */
    public function edit(Semester $semester)
    {
        $departments = Department::all();
        return view('semesters.edit', compact('semester', 'departments'));
    }

    /**
     * Update the specified semester.
     */
    public function update(Request $request, Semester $semester)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'semester_number' => 'required|integer|between:1,8',
            'name' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $semester->update($request->all());

        return redirect()->route('semesters.index')
            ->with('success', 'Semester updated successfully');
    }

    /**
     * Remove the specified semester.
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();

        return redirect()->route('semesters.index')
            ->with('success', 'Semester deleted successfully');
    }
    
    /**
     * Create all semesters (1-8) for a department at once.
     */
    public function createBulk()
    {
        $departments = Department::all();
        return view('semesters.create-bulk', compact('departments'));
    }
    
    /**
     * Store all semesters (1-8) for a department at once.
     */
    public function storeBulk(Request $request)
    {
        // Validate basic semester data
        $validatedData = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Handle CR assignment if checkbox is checked
        if ($request->has('assign_cr')) {
            // Check if creating a new CR or using an existing one
            if ($request->input('cr_selection_type') === 'new') {
                // Validate new CR data
                $request->validate([
                    'cr_name' => 'required|string|max:255',
                    'cr_email' => 'required|email|unique:crs,cr_email',
                    'reg_no' => 'required|string|max:50',
                    'section' => 'required|string|max:10',
                    'password' => 'required|string|min:6|confirmed',
                ]);
            } else {
                // Validate existing CR selection
                $request->validate([
                    'cr_id' => 'required|exists:crs,id',
                ]);
            }
        }

        // Use DB transaction to ensure both semesters and CR association are saved
        DB::beginTransaction();

        try {
            $firstSemester = null;
            
            // Create semesters 1-8 for this department
            for ($i = 1; $i <= 8; $i++) {
                $semester = Semester::create([
                    'department_id' => $request->department_id,
                    'semester_number' => $i,
                    'name' => 'Semester ' . $i,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'is_active' => ($i == 1) ? true : false, // Make only first semester active by default
                ]);
                
                // Save the first semester for CR assignment
                if ($i == 1) {
                    $firstSemester = $semester;
                }
            }
            
            // Handle CR assignment for first semester if requested
            if ($request->has('assign_cr') && $firstSemester) {
                $crId = null;

                // Create a new CR if needed
                if ($request->input('cr_selection_type') === 'new') {
                    $cr = Cr::create([
                        'cr_name' => $request->input('cr_name'),
                        'cr_email' => $request->input('cr_email'),
                        'reg_no' => $request->input('reg_no'),
                        'section' => $request->input('section'),
                        'semester' => $firstSemester->semester_number,
                        'password' => Hash::make($request->input('password')),
                    ]);
                    $crId = $cr->id;
                } else {
                    // Use existing CR
                    $crId = $request->input('cr_id');
                }

                // Create association between first semester and CR
                if ($crId) {
                    DB::table('semester_crs')->insert([
                        'semester_id' => $firstSemester->id,
                        'cr_id' => $crId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('semesters.index')
                ->with('success', 'All semesters created successfully' . 
                        ($request->has('assign_cr') ? ' with CR assigned to first semester' : ''));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create semesters: ' . $e->getMessage()]);
        }
    }
}
