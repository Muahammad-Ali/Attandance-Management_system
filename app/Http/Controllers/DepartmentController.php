<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the departments.
     */
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new department.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created department.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully');
    }

    /**
     * Display the specified department.
     */
    public function show(Department $department)
    {
        // Load the semesters for this department
        $department->load('semesters');
        
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified department.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified department.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified department.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
