<?php

namespace App\Http\Controllers;

use App\Models\TeacherAttendance;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AssignedSubject;

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

        // Debug CR info
        \Log::info('CR User:', ['id' => $cr->id, 'name' => $cr->cr_name, 'email' => $cr->cr_email]);

        // Get and log semester info - ensure CR has assigned semesters
        $semesters = $cr->semesters;
        \Log::info('CR Semesters: ' . $semesters->count());

        // If no semesters, create some for testing
        if ($semesters->count() == 0) {
            $this->seedTestData();

            // Refresh data after seeding
            $semesters = \App\Models\Semester::all();

            // Assign the CR to all semesters
            foreach ($semesters as $semester) {
                if (!$cr->semesters()->where('semester_id', $semester->id)->exists()) {
                    $cr->semesters()->attach($semester->id);
                }
            }

            // Refresh the CR
            $cr = $cr->fresh(['semesters']);
            $semesters = $cr->semesters;

            \Log::info('Created and assigned semesters: ' . $semesters->count());
        }

        // Get subjects for the CR's semesters


        $crId = $cr->id;
        $assignedSubjects = AssignedSubject::where('cr_id', $crId)->with('teacher')->get();

        \Log::info('Assigned Subjects count: ' . $assignedSubjects->count());

        \Log::info('Subjects available to CR: ' . $assignedSubjects->count());

        // Get teachers with their subjects - using eager loading
        $teachers = Teacher::with('subjects')->get();
        \Log::info('Teachers: ' . $teachers->count());

        // Check if teachers have subjects
        foreach ($teachers as $teacher) {
            \Log::info('Teacher: ' . $teacher->name . ' has ' . $teacher->subjects->count() . ' subjects assigned');
        }

        // If no teachers or no subjects assigned to teachers, create test data
        if ($teachers->count() == 0 || $teachers->sum(function($teacher) {
            return $teacher->subjects->count();
        }) == 0) {
            \Log::info('No teachers or no subjects assigned to teachers. Creating test data...');
            $this->seedTestData();

            // Reload teachers with subjects
            $teachers = Teacher::with('subjects')->get();

            // Check if the seeding fixed the issue
            foreach ($teachers as $teacher) {
                \Log::info('After seeding - Teacher: ' . $teacher->name . ' has ' . $teacher->subjects->count() . ' subjects assigned');
            }
        }

        // Debug info
        \Log::info('Teacher->subjects relationship check');
        foreach($teachers as $teacher) {
            foreach($teacher->subjects as $subject) {
                \Log::info("Teacher {$teacher->id} ({$teacher->name}) has subject {$subject->id} ({$subject->subject_name})");
            }
        }

        return view('cr.attendance.create', compact('semesters',  'teachers','assignedSubjects'));
    }

    private function seedTestData()
    {
        // Check if we have departments
        if (\App\Models\Department::count() == 0) {
            $department = \App\Models\Department::create([
                'name' => 'Computer Science',
                'code' => 'CS',
                'description' => 'Computer Science Department'
            ]);
        } else {
            $department = \App\Models\Department::first();
        }

        // Create semesters if none exist
        if (\App\Models\Semester::count() == 0) {
            for ($i = 1; $i <= 8; $i++) {
                \App\Models\Semester::create([
                    'department_id' => $department->id,
                    'semester_number' => $i,
                    'name' => 'Semester ' . $i,
                    'start_date' => now(),
                    'end_date' => now()->addMonths(6),
                    'is_active' => true
                ]);
            }
        }

        // Create subjects if none exist
        if (\App\Models\Subject::count() == 0) {
            $semesters = \App\Models\Semester::all();
            $subjects = [
                ['name' => 'Introduction to Programming', 'code' => 'CS101'],
                ['name' => 'Data Structures', 'code' => 'CS201'],
                ['name' => 'Database Systems', 'code' => 'CS301'],
                ['name' => 'Web Development', 'code' => 'CS401'],
                ['name' => 'Artificial Intelligence', 'code' => 'CS501'],
                ['name' => 'Machine Learning', 'code' => 'CS601']
            ];

            foreach ($subjects as $index => $subject) {
                $semesterId = $semesters[min($index, $semesters->count() - 1)]->id;
                \App\Models\Subject::create([
                    'subject_name' => $subject['name'],
                    'subject_code' => $subject['code'],
                    'credits' => 3,
                    'semester_id' => $semesterId,
                    'description' => 'Description for ' . $subject['name']
                ]);
            }
        }

        // Create a teacher if none exist
        if (\App\Models\Teacher::count() == 0) {
            $teacher = \App\Models\Teacher::create([
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => bcrypt('password')
            ]);

            // Assign subjects to the teacher
            $subjects = \App\Models\Subject::all();
            foreach ($subjects as $subject) {
                $teacher->subjects()->attach($subject->id);
            }
        } else {
            $teacher = \App\Models\Teacher::first();

            // Ensure teacher has subjects
            $subjects = \App\Models\Subject::all();
            foreach ($subjects as $subject) {
                if (!$teacher->subjects()->where('subject_id', $subject->id)->exists()) {
                    $teacher->subjects()->attach($subject->id);
                }
            }
        }
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
    public function teacherAttendance(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();
        $query = TeacherAttendance::where('teacher_id', $teacher->id)
            ->with(['subject', 'semester']);

        // Filter by month
        if ($request->has('month')) {
            $date = Carbon::parse($request->month);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        } else {
            // Default to current month if no month is specified
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        }

        // Filter by subject if specified
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $attendances = $query->latest()->paginate(10);

        // Get all subjects taught by the teacher
        $subjects = $teacher->subjects;

        // Calculate attendance stats for the period
        $totalClasses = $attendances->total();
        $present = TeacherAttendance::where('teacher_id', $teacher->id)
            ->where('status', 'present')
            ->whereBetween('date', [$startOfMonth, $endOfMonth]);

        $absent = TeacherAttendance::where('teacher_id', $teacher->id)
            ->where('status', 'absent')
            ->whereBetween('date', [$startOfMonth, $endOfMonth]);

        $late = TeacherAttendance::where('teacher_id', $teacher->id)
            ->where('status', 'late')
            ->whereBetween('date', [$startOfMonth, $endOfMonth]);

        // Apply subject filter to stats if specified
        if ($request->filled('subject_id')) {
            $present->where('subject_id', $request->subject_id);
            $absent->where('subject_id', $request->subject_id);
            $late->where('subject_id', $request->subject_id);
        }

        $presentCount = $present->count();
        $absentCount = $absent->count();
        $lateCount = $late->count();

        // Calculate percentages safely (avoiding division by zero)
        $stats = [
            'total' => $totalClasses,
            'present' => $presentCount,
            'absent' => $absentCount,
            'late' => $lateCount,
            'present_percentage' => $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100, 1) : 0,
            'absent_percentage' => $totalClasses > 0 ? round(($absentCount / $totalClasses) * 100, 1) : 0,
            'late_percentage' => $totalClasses > 0 ? round(($lateCount / $totalClasses) * 100, 1) : 0,
        ];

        return view('teacher.attendance.index', compact('attendances', 'subjects', 'stats'));
    }

    // For admin dashboard
    public function adminIndex(Request $request)
    {
        $query = TeacherAttendance::with(['teacher', 'subject', 'semester', 'recordedBy']);

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('month')) {
            $query->whereMonth('date', Carbon::parse($request->month)->month)
                  ->whereYear('date', Carbon::parse($request->month)->year);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $attendances = $query->latest()->paginate(10);
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.attendance.index', compact('attendances', 'teachers'));
    }

    public function adminTeacherAttendance(Request $request)
    {
        // Get teacher from request or default to first teacher
        $teacherId = $request->teacher_id ?? Teacher::first()->id ?? null;
        $teacher = Teacher::with('subjects')->findOrFail($teacherId);
        
        $query = TeacherAttendance::where('teacher_id', $teacher->id)
            ->with(['subject', 'semester']);

        // Filter by month
        if ($request->filled('month')) {
            $date = Carbon::parse($request->month);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        } else {
            // Default to current month if no month is specified
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        }

        // Filter by subject if specified
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $attendances = $query->latest()->paginate(10);

        // Get all subjects taught by the teacher
        $subjects = $teacher->subjects;

        // Calculate attendance stats for the period
        $totalClasses = $attendances->total();
        $present = TeacherAttendance::where('teacher_id', $teacher->id)
            ->where('status', 'present')
            ->whereBetween('date', [$startOfMonth, $endOfMonth]);

        $absent = TeacherAttendance::where('teacher_id', $teacher->id)
            ->where('status', 'absent')
            ->whereBetween('date', [$startOfMonth, $endOfMonth]);

        $late = TeacherAttendance::where('teacher_id', $teacher->id)
            ->where('status', 'late')
            ->whereBetween('date', [$startOfMonth, $endOfMonth]);

        // Apply subject filter to stats if specified
        if ($request->filled('subject_id')) {
            $present->where('subject_id', $request->subject_id);
            $absent->where('subject_id', $request->subject_id);
            $late->where('subject_id', $request->subject_id);
        }

        $presentCount = $present->count();
        $absentCount = $absent->count();
        $lateCount = $late->count();

        // Calculate percentages safely (avoiding division by zero)
        $stats = [
            'total' => $totalClasses,
            'present' => $presentCount,
            'absent' => $absentCount,
            'late' => $lateCount,
            'present_percentage' => $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100, 1) : 0,
            'absent_percentage' => $totalClasses > 0 ? round(($absentCount / $totalClasses) * 100, 1) : 0,
            'late_percentage' => $totalClasses > 0 ? round(($lateCount / $totalClasses) * 100, 1) : 0,
        ];

        // Get all teachers for the dropdown
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.attendance.teacher', compact('attendances', 'subjects', 'stats', 'teacher', 'teachers'));
    }
}
