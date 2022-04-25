<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Room;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $studentCount = Student::all()->count();
        return view('admin.home',compact('studentCount'));
    }
}
