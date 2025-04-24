<?php

namespace App\Http\Controllers;

use App\Models\SemesterCoordinator;
use App\Models\Department;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SemesterCoordinatorController extends Controller
{
    public function index()
    {
        $semesterCoordinators = SemesterCoordinator::with(['department', 'semester'])->get();
        $departments = Department::all();
        $semesters = Semester::all();
        return view('semestercoordinator.index', compact('semesterCoordinators', 'departments', 'semesters'));
    }

    public function create()
    {
        $departments = Department::all();
        $semesters = Semester::all();
        return view('semestercoordinator.create', compact('departments', 'semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:semester_coordinators',
            'password' => 'required|min:6',
            'department_id' => 'required|exists:departments,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);

        $semesterCoordinator = SemesterCoordinator::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'semester_id' => $request->semester_id,
        ]);

        return redirect()->route('semestercoordinator.index')
            ->with('success', 'Semester Coordinator created successfully.');
    }

    public function edit($id)
    {
        $semesterCoordinator = SemesterCoordinator::findOrFail($id);
        $departments = Department::all();
        $semesters = Semester::all();
        return view('semestercoordinator.edit', compact('semesterCoordinator', 'departments', 'semesters'));
    }

    public function update(Request $request, $id)
    {
        $semesterCoordinator = SemesterCoordinator::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:semester_coordinators,email,' . $semesterCoordinator->id,
            'department_id' => 'required|exists:departments,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);

        $semesterCoordinator->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'semester_id' => $request->semester_id,
        ]);

        if ($request->filled('password')) {
            $semesterCoordinator->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('semestercoordinator.index')
            ->with('success', 'Semester Coordinator updated successfully.');
    }

    public function destroy($id)
    {
        $semesterCoordinator = SemesterCoordinator::findOrFail($id);
        $semesterCoordinator->delete();
        return redirect()->route('semestercoordinator.index')
            ->with('success', 'Semester Coordinator deleted successfully.');
    }

    /**
     * Display the specified semester coordinator.
     */
    public function show($id)
    {
        $semesterCoordinator = SemesterCoordinator::findOrFail($id);
        return view('semestercoordinator.show', compact('semesterCoordinator'));
    }

    public function dashboard()
    {
        return view('semestercoordinator.dashboard');
    }
} 