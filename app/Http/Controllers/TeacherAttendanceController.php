<?php

namespace App\Http\Controllers;

use App\Models\TeacherAttendance;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeacherAttendanceController extends Controller
{
    public function index()
    {
        $cr = Auth::guard('cr')->user();
        $attendances = TeacherAttendance::where('recorded_by', $cr->id)
            ->with(['teacher', 'subject', 'semester'])
            ->latest()
            ->paginate(10);

        return view('cr.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $cr = Auth::guard('cr')->user();
        $semesters = $cr->semesters;
        $subjects = Subject::whereIn('semester_id', $semesters->pluck('id'))->get();
        $teachers = Teacher::all();

        return view('cr.attendance.create', compact('semesters', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'semester_id' => 'required|exists:semesters,id',
            'date' => 'required|date',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string'
        ]);

        $validated['recorded_by'] = Auth::guard('cr')->id();

        TeacherAttendance::create($validated);

        return redirect()->route('cr.attendance.index')
            ->with('success', 'Attendance recorded successfully.');
    }

    public function show(TeacherAttendance $attendance)
    {
        return view('cr.attendance.show', compact('attendance'));
    }

    public function edit(TeacherAttendance $attendance)
    {
        $cr = Auth::guard('cr')->user();
        $semesters = $cr->semesters;
        $subjects = Subject::whereIn('semester_id', $semesters->pluck('id'))->get();
        $teachers = Teacher::all();

        return view('cr.attendance.edit', compact('attendance', 'semesters', 'subjects', 'teachers'));
    }

    public function update(Request $request, TeacherAttendance $attendance)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'semester_id' => 'required|exists:semesters,id',
            'date' => 'required|date',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string'
        ]);

        $attendance->update($validated);

        return redirect()->route('cr.attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy(TeacherAttendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('cr.attendance.index')
            ->with('success', 'Attendance record deleted successfully.');
    }

    // For teacher dashboard
    public function teacherAttendance()
    {
        $teacher = Auth::guard('teacher')->user();
        $attendances = TeacherAttendance::where('teacher_id', $teacher->id)
            ->with(['subject', 'semester'])
            ->latest()
            ->paginate(10);

        return view('teacher.attendance.index', compact('attendances'));
    }

    // For admin dashboard
    public function adminIndex(Request $request)
    {
        $query = TeacherAttendance::with(['teacher', 'subject', 'semester', 'recordedBy']);

        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('month')) {
            $query->whereMonth('date', Carbon::parse($request->month)->month)
                  ->whereYear('date', Carbon::parse($request->month)->year);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query->latest()->paginate(10);

        return view('admin.attendance.index', compact('attendances'));
    }
} 