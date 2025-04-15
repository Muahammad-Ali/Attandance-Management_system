<?php

namespace App\Http\Controllers\CR;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $cr = Auth::user();
        $attendances = Attendance::where('cr_id', $cr->id)
            ->with('subject')
            ->latest()
            ->paginate(10);

        return view('cr.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $cr = Auth::user();
        $subjects = Subject::whereHas('semester', function($query) use ($cr) {
            $query->where('id', $cr->semester_id);
        })->get();

        return view('cr.attendance.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string|max:255',
        ]);

        $cr = Auth::user();

        Attendance::create([
            'cr_id' => $cr->id,
            'subject_id' => $request->subject_id,
            'date' => $request->date,
            'status' => $request->status,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('cr.attendance.index')
            ->with('success', 'Attendance recorded successfully.');
    }

    public function show(Attendance $attendance)
    {
        $this->authorize('view', $attendance);
        return view('cr.attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $this->authorize('update', $attendance);
        $cr = Auth::user();
        $subjects = Subject::whereHas('semester', function($query) use ($cr) {
            $query->where('id', $cr->semester_id);
        })->get();

        return view('cr.attendance.edit', compact('attendance', 'subjects'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $this->authorize('update', $attendance);

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
            'remarks' => 'nullable|string|max:255',
        ]);

        $attendance->update($request->all());

        return redirect()->route('cr.attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $this->authorize('delete', $attendance);
        $attendance->delete();

        return redirect()->route('cr.attendance.index')
            ->with('success', 'Attendance deleted successfully.');
    }
} 