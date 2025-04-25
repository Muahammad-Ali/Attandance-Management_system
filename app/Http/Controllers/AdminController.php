<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Cr;
use App\Models\Subject;
use App\Models\TeacherAttendance;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        // Check if user is admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'You must be an admin to access this page.');
        }

        // Get fresh counts for dashboard - don't use cached values
        $teacherCount = Teacher::count();
        $crCount = Cr::count();
        $subjectCount = Subject::count();
        $batchAdvisorCount = \App\Models\BatchAdvisor::count();
        $semesterCoordinatorCount = \App\Models\SemesterCoordinator::count();

        // Get today's attendance statistics
        $today = Carbon::today();
        $todayStats = [
            'present' => TeacherAttendance::whereDate('date', $today)->where('status', 'present')->count(),
            'absent' => TeacherAttendance::whereDate('date', $today)->where('status', 'absent')->count(),
            'late' => TeacherAttendance::whereDate('date', $today)->where('status', 'late')->count(),
        ];

        // Get this month's attendance statistics
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $monthlyStats = [
            'present' => TeacherAttendance::whereBetween('date', [$startOfMonth, $endOfMonth])
                ->where('status', 'present')->count(),
            'absent' => TeacherAttendance::whereBetween('date', [$startOfMonth, $endOfMonth])
                ->where('status', 'absent')->count(),
            'late' => TeacherAttendance::whereBetween('date', [$startOfMonth, $endOfMonth])
                ->where('status', 'late')->count(),
        ];

        // Get recent attendance entries
        $recentAttendances = TeacherAttendance::with(['teacher', 'assignedSubject', 'semester'])
            ->latest()
            ->take(5)
            ->get();
            $daysInMonth = now()->daysInMonth;
            $monthlyData = collect();
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = Carbon::now()->startOfMonth()->addDays($i - 1)->toDateString();

                $monthlyData->push([
                    'date' => $date,
                    'present' => TeacherAttendance::whereDate('date', $date)->where('status', 'present')->count(),
                    'absent' => TeacherAttendance::whereDate('date', $date)->where('status', 'absent')->count(),
                    'late' => TeacherAttendance::whereDate('date', $date)->where('status', 'late')->count(),
                ]);
            }


        return view('admin.dashboard', compact(
            'teacherCount',
            'crCount',
            'subjectCount',
            'batchAdvisorCount',
            'semesterCoordinatorCount',
            'todayStats',
            'monthlyStats',
            'recentAttendances',
            'monthlyData'
        ));
    }
    public function getTeacherDetails($id)
{
    $teacher = Teacher::with(['assignedSubjects', 'attendances'])->findOrFail($id);
    return view('partials.teacher_attendance_popup', compact('teacher'));
}

}
