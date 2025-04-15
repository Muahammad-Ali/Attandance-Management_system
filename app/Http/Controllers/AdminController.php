<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Cr;
use App\Models\Subject;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        // Get counts for dashboard
        $teacherCount = Teacher::count();
        $crCount = Cr::count();
        $subjectCount = Subject::count();
        
        return view('admin.dashboard', compact('teacherCount', 'crCount', 'subjectCount'));
    }
}
