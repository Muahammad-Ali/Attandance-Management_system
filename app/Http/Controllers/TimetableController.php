<?php

namespace App\Http\Controllers;

use App\Models\AssignedSubject;
use App\Models\Cr;
use App\Models\Department;
use App\Models\Semester;
use App\Models\Teacher;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display a listing of timetables.
     */
    public function index()
    {
        $departments = Department::all();
        return view('timetables.index', compact('departments'));
    }

    /**
     * Show timetable for a specific semester.
     */
    public function semesterTimetable($semesterId)
    {
        $semester = Semester::with(['department', 'timetables.subject', 'timetables.teacher', 'timetables.cr'])
            ->findOrFail($semesterId);
            
        // Group timetable entries by day
        $timetablesByDay = $semester->timetables->groupBy('day');
        
        // Sort days in correct order
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $sortedTimetable = collect();
        
        foreach ($days as $day) {
            if ($timetablesByDay->has($day)) {
                $sortedTimetable[$day] = $timetablesByDay[$day]->sortBy('start_time');
            }
        }
        
        return view('timetables.semester', compact('semester', 'sortedTimetable', 'days'));
    }

    /**
     * Show the form for creating a new timetable entry.
     */
    public function create($semesterId)
    {
        $semester = Semester::with('department')->findOrFail($semesterId);
        $teachers = Teacher::all();
        $subjects = AssignedSubject::all();
        $crs = Cr::all();
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        
        return view('timetables.create', compact('semester', 'teachers', 'subjects', 'crs', 'days'));
    }

    /**
     * Store a newly created timetable entry.
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'subject_id' => 'required|exists:assigned_subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'cr_id' => 'nullable|exists:crs,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'classroom' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        Timetable::create($request->all());

        return redirect()->route('timetables.semester', $request->semester_id)
            ->with('success', 'Timetable entry created successfully');
    }

    /**
     * Display the specified timetable entry.
     */
    public function show(Timetable $timetable)
    {
        $timetable->load(['semester.department', 'subject', 'teacher', 'cr']);
        return view('timetables.show', compact('timetable'));
    }

    /**
     * Show the form for editing the specified timetable entry.
     */
    public function edit(Timetable $timetable)
    {
        $timetable->load('semester.department');
        
        $teachers = Teacher::all();
        $subjects = AssignedSubject::all();
        $crs = Cr::all();
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        
        return view('timetables.edit', compact('timetable', 'teachers', 'subjects', 'crs', 'days'));
    }

    /**
     * Update the specified timetable entry.
     */
    public function update(Request $request, Timetable $timetable)
    {
        $request->validate([
            'subject_id' => 'required|exists:assigned_subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'cr_id' => 'nullable|exists:crs,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'classroom' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $timetable->update($request->all());

        return redirect()->route('timetables.semester', $timetable->semester_id)
            ->with('success', 'Timetable entry updated successfully');
    }

    /**
     * Remove the specified timetable entry.
     */
    public function destroy(Timetable $timetable)
    {
        $semesterId = $timetable->semester_id;
        $timetable->delete();

        return redirect()->route('timetables.semester', $semesterId)
            ->with('success', 'Timetable entry deleted successfully');
    }
}
