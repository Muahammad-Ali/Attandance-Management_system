<?php

namespace App\Http\Controllers\CR;

use App\Http\Controllers\Controller;
use App\Models\SubjectFeedback;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = SubjectFeedback::query()->with(['subject', 'teacher', 'semester']);
        
        // Apply filters
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('subject', function($q) use ($search) {
                    $q->where('subject_name', 'like', "%{$search}%")
                      ->orWhere('subject_code', 'like', "%{$search}%");
                })
                ->orWhereHas('teacher', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });
        }
        
        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }
        
        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }
        
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }
        
        $feedbacks = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Get data for filter dropdowns
        $semesters = Semester::all();
        $teachers = Teacher::orderBy('name')->get();
        $ratings = [5, 4, 3, 2, 1];
        
        return view('cr.feedback.index', compact('feedbacks', 'semesters', 'teachers', 'ratings'));
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