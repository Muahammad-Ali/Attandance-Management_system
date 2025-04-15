<?php

namespace App\Http\Controllers\CR;

use App\Http\Controllers\Controller;
use App\Models\SubjectFeedback;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Semester;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = SubjectFeedback::with(['subject', 'teacher', 'semester'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('cr.feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $semesters = Semester::all();

        return view('cr.feedback.create', compact('subjects', 'teachers', 'semesters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'semester_id' => 'required|exists:semesters,id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        SubjectFeedback::create($validated);

        return redirect()->route('cr.feedback.index')
            ->with('success', 'Feedback submitted successfully.');
    }

    public function show(SubjectFeedback $feedback)
    {
        $feedback->load(['subject', 'teacher', 'semester']);
        return view('cr.feedback.show', compact('feedback'));
    }

    public function edit(SubjectFeedback $feedback)
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $semesters = Semester::all();

        return view('cr.feedback.edit', compact('feedback', 'subjects', 'teachers', 'semesters'));
    }

    public function update(Request $request, SubjectFeedback $feedback)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'semester_id' => 'required|exists:semesters,id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        $feedback->update($validated);

        return redirect()->route('cr.feedback.index')
            ->with('success', 'Feedback updated successfully.');
    }

    public function destroy(SubjectFeedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('cr.feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
} 