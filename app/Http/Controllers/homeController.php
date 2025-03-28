<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        return view('homeScreen');
    }
    public function attendanceToday() {
        // You can add data fetching logic here later
        return view('present');
    }
}
