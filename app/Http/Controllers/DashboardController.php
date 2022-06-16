<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use App\Models\Department;
use App\Models\Event;
use App\Models\Fellowship;
use App\Models\News;
use App\Models\Note;
use App\Models\Stream;
use App\Models\Student;
use App\Models\TextBook;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if(Auth::user()->role==1) {
            $data['studentCount'] = Student::where('institute_id', Auth::user()->institute->id)->get()->count();
            $data['eventCount'] = Event::all()->count();
            $data['noteCount'] = Note::all()->count();
            $data['textBookCount'] = TextBook::all()->count();
            $data['departmentCount'] = Department::all()->count();
            $data['cafeteriaCount'] = Cafeteria::all()->count();
            $data['newsCount'] = News::all()->count();
            $data['fellowshipCount'] = Fellowship::all()->count();
        } else {
            $data['studentCount'] = Student::all()->count();
            $data['eventCount'] = Event::all()->count();
            $data['noteCount'] = Note::all()->count();
            $data['textBookCount'] = TextBook::all()->count();
            $data['departmentCount'] = Department::all()->count();
            $data['cafeteriaCount'] = Cafeteria::all()->count();
            $data['newsCount'] = News::all()->count();
            $data['fellowshipCount'] = Fellowship::all()->count();
        }
        return view('admin.home', compact('data'));
    }
}
