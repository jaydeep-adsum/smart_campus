<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use App\Models\Event;
use App\Models\Fellowship;
use App\Models\News;
use App\Models\Note;
use App\Models\Stream;
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
        $data['streamCount'] = Stream::all()->count();
        $data['cafeteriaCount'] = Cafeteria::all()->count();
        $data['newsCount'] = News::all()->count();
        $data['fellowshipCount'] = Fellowship::all()->count();
        return view('admin.home', compact('data'));
    }
}
