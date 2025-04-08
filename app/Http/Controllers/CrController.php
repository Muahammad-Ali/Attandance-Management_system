<?php

// app/Http/Controllers/CrController.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Cr;

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
}
