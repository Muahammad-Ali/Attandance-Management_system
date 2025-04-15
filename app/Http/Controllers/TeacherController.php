<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index(){
        $teachers = Teacher::all(); // Get all teachers
        return view('CreateTeacher', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'password' => 'required|min:6',
        ]);

        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('teacher')->login($teacher);
        return redirect()->route('teacher.dashboard');
    }


public function dashboard()
{
    return view('teacherDashboard');
}


}
