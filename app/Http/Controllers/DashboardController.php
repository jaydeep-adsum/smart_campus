<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Note;
use App\Models\Student;
use App\Models\TextBook;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $data['studentCount'] = Student::all()->count();
        $data['eventCount'] = Event::all()->count();
        $data['noteCount'] = Note::all()->count();
        $data['textBookCount'] = TextBook::all()->count();
        return view('admin.home', compact('data'));
    }
}
