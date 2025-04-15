<?php

namespace App\Http\Controllers;

use App\Models\SubjectFeedback;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectFeedbackController extends Controller
{
    public function index()
    {
        $cr = Auth::guard('cr')->user();
        $feedbacks = SubjectFeedback::where('cr_id', $cr->id)
            ->with(['subject', 'teacher', 'semester'])
            ->latest()
            ->paginate(10);

        return view('cr.feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        $cr = Auth::guard('cr')->user();
        $semesters = $cr->semesters;
        $subjects = Subject::whereIn('semester_id', $semesters->pluck('id'))->get();
        $teachers = Teacher::all();

        return view('cr.feedback.create', compact('semesters', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'semester_id' => 'required|exists:semesters,id',
            'feedback' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_anonymous' => 'boolean'
        ]);

        $validated['cr_id'] = Auth::guard('cr')->id();
        $validated['is_anonymous'] = $request->has('is_anonymous');

        SubjectFeedback::create($validated);

        return redirect()->route('cr.feedback.index')
            ->with('success', 'Feedback submitted successfully.');
    }

    public function show(SubjectFeedback $feedback)
    {
        return view('cr.feedback.show', compact('feedback'));
    }

    public function edit(SubjectFeedback $feedback)
    {
        $cr = Auth::guard('cr')->user();
        $semesters = $cr->semesters;
        $subjects = Subject::whereIn('semester_id', $semesters->pluck('id'))->get();
        $teachers = Teacher::all();

        return view('cr.feedback.edit', compact('feedback', 'semesters', 'subjects', 'teachers'));
    }

    public function update(Request $request, SubjectFeedback $feedback)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'semester_id' => 'required|exists:semesters,id',
            'feedback' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_anonymous' => 'boolean'
        ]);

        $validated['is_anonymous'] = $request->has('is_anonymous');

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

    // For admin dashboard
    public function adminIndex(Request $request)
    {
        $query = SubjectFeedback::with(['cr', 'subject', 'teacher', 'semester']);

        if ($request->has('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->has('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->has('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        $feedbacks = $query->latest()->paginate(10);

        return view('admin.feedback.index', compact('feedbacks'));
    }
} 