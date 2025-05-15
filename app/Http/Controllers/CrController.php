<?php

// app/Http/Controllers/CrController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Cr;
use Illuminate\Support\Facades\Auth;

class CrController extends Controller
{
    public function index(){
        $crs = Cr::all(); // fetch all CRs to show in table
        return view('cr', compact('crs'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'cr_name' => 'required|string|max:255',
            'cr_email' => 'required|email|unique:crs,cr_email',
            'reg_no' => 'required|string|max:50',
            'section' => 'required|string|max:10',
            'semester' => 'required|string|max:10',
            'password' => 'required|string|min:6',
        ]);
         // Hash the password before storing
    $validated['password'] = Hash::make($validated['password']);


        Cr::create($validated);
        return redirect()->back()->with('success', 'CR created successfully!');
    }

    public function dashboard()
    {
        $cr = Auth::guard('cr')->user();

        // Eager load semesters with their relationships
        if ($cr) {
            $cr->load([
                'semesters.department',
                'semesters.timetables.subject',
                'semesters.timetables.teacher'
            ]);
        }

        return view('crDashboard', compact('cr'));
    }

    // View single CR
public function show($id) {
    $cr = Cr::findOrFail($id);
    return view('crShow', compact('cr'));
}

// Edit CR form
public function edit($id) {
    $cr = Cr::findOrFail($id);
    return view('crEdit', compact('cr'));
}

// Update CR
public function update(Request $request, $id) {
    $cr = Cr::findOrFail($id);

    $validated = $request->validate([
        'cr_name' => 'required|string|max:255',
        'cr_email' => 'required|email|unique:crs,cr_email,' . $cr->id,
        'reg_no' => 'required|string|max:50',
        'section' => 'required|string|max:10',
        'semester' => 'required|string|max:10',
    ]);

    if ($request->filled('password')) {
        $validated['password'] = Hash::make($request->password);
    }

    $cr->update($validated);

    return redirect()->route('admin.cr.index')->with('success', 'CR updated successfully!');
}

// Delete CR
public function destroy($id) {
    Cr::destroy($id);
    return redirect()->back()->with('success', 'CR deleted successfully!');
}

}
