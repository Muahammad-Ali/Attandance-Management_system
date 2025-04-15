<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Cr;
use App\Models\AssignedSubject;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{


    public function index()
    {
        $teachers = Teacher::all();
        $crs = Cr::all();
        $assignedSubjects = AssignedSubject::with('teacher', 'cr')->get();

        return view('Subject', compact('teachers', 'crs', 'assignedSubjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'cr_id' => 'required|exists:crs,id',
            'section' => 'required|string|max:50',
            'semester' => 'required|string|max:10',
        ]);

        AssignedSubject::create([
            'subject_name' => $validated['subject_name'],
            'teacher_id' => $validated['teacher_id'],
            'cr_id' => $validated['cr_id'],
            'section' => $validated['section'],
            'semester' => $validated['semester'],
        ]);

        return redirect()->back()->with('success', 'Subject assigned successfully!');
    }


    public function mySubjects()
{
    $teacher = Auth::guard('teacher')->user(); // Get logged-in teacher
    $assignedSubjects = $teacher->assignedSubjects()->with('cr')->get(); // Get assigned subjects

    return view('Teacher.AssignSubjects', compact('assignedSubjects', 'teacher'));
}


}
