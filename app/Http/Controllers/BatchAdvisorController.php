<?php

namespace App\Http\Controllers;

use App\Models\BatchAdvisor;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BatchAdvisorController extends Controller
{
    public function index()
    {
        $batchAdvisors = BatchAdvisor::with('department')->get();
        $departments = Department::all();
        return view('batchadvisor.index', compact('batchAdvisors', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('batchadvisor.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:batch_advisors',
            'password' => 'required|min:6',
            'department_id' => 'required|exists:departments,id',
            'batch' => 'required|string|max:20',
        ]);

        $batchAdvisor = BatchAdvisor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'batch' => $request->batch,
        ]);

        // Debug log
        \Log::info('Batch Advisor created', [
            'id' => $batchAdvisor->id,
            'email' => $batchAdvisor->email,
            'name' => $batchAdvisor->name
        ]);

        return redirect()->route('batchadvisor.index')
            ->with('success', 'Batch Advisor created successfully.');
    }

    public function edit($id)
    {
        $batchAdvisor = BatchAdvisor::findOrFail($id);
        $departments = Department::all();
        return view('batchadvisor.edit', compact('batchAdvisor', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $batchAdvisor = BatchAdvisor::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:batch_advisors,email,' . $batchAdvisor->id,
            'department_id' => 'required|exists:departments,id',
            'batch' => 'required|string|max:20',
        ]);

        $batchAdvisor->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'batch' => $request->batch,
        ]);

        if ($request->filled('password')) {
            $batchAdvisor->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('batchadvisor.index')
            ->with('success', 'Batch Advisor updated successfully.');
    }

    public function destroy($id)
    {
        $batchAdvisor = BatchAdvisor::findOrFail($id);
        $batchAdvisor->delete();
        return redirect()->route('batchadvisor.index')
            ->with('success', 'Batch Advisor deleted successfully.');
    }

    /**
     * Display the specified batch advisor.
     */
    public function show($id)
    {
        $batchAdvisor = BatchAdvisor::findOrFail($id);
        return view('batchadvisor.show', compact('batchAdvisor'));
    }

    public function dashboard()
    {
        return view('batchadvisor.dashboard');
    }
} 