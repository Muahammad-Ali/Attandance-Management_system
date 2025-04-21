<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Cr;
use App\Models\Subject;
use App\Models\Attendance;
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


        return view('admin.dashboard', );
    }
}
