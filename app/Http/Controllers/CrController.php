<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrController extends Controller
{
    public function index(){
        return view('cr');
    }
}
