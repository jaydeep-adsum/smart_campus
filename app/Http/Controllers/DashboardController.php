<?php

namespace App\Http\Controllers;

use App\Models\Cafeteria;
use App\Models\CafeteriaUser;
use App\Models\Department;
use App\Models\Event;
use App\Models\Fellowship;
use App\Models\News;
use App\Models\Note;
use App\Models\Stream;
use App\Models\Student;
use App\Models\TextBook;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if(Auth::user()->role==1) {
            $data['studentCount'] = Student::where('institute_id', Auth::user()->institute->id)->get()->count();
            $data['eventCount'] = Event::where('institute_id', Auth::user()->institute->id)->get()->count();
            $data['noteCount'] = Note::where('institute_id', Auth::user()->institute->id)->get()->count();
            $data['textBookCount'] = TextBook::where('institute_id', Auth::user()->institute->id)->get()->count();
            $data['departmentCount'] = Department::where('institute_id', Auth::user()->institute->id)->get()->count();

            $data['newsCount'] = News::where('institute_id', Auth::user()->institute->id)->get()->count();
            $data['fellowshipCount'] = Fellowship::where('institute_id', Auth::user()->institute->id)->get()->count();
        } elseif (Auth::user()->role==2){
            $cafeUser = CafeteriaUser::where('user_id',Auth::id())->first();
            $data['cafeteriaCount'] = Cafeteria::where('institute_id', $cafeUser->institute_id)->get()->count();
        } else {
            $data['studentCount'] = Student::all()->count();
            $data['eventCount'] = Event::all()->count();
            $data['noteCount'] = Note::all()->count();
            $data['textBookCount'] = TextBook::all()->count();
            $data['departmentCount'] = Department::all()->count();
            $data['newsCount'] = News::all()->count();
            $data['fellowshipCount'] = Fellowship::all()->count();
        }
        return view('admin.home', compact('data'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changePassword(Request $request): JsonResponse
    {
        $user = User::where('id',Auth::user()->id)->first();

        if(Hash::check($request->old_password, $user->password))
        {
            if($request->new_password == $request->confirm_password)
            {
                $user->password = Hash::make($request->new_password);
                $user->save();
                $data['status'] = 1;
                $data['messages'] = 'Your password changed successfully';
                return response()->json($data);
            }
            else
            {
                $data['status'] = 0;
                $data['messages'] = 'The password confirmation does not match.';
                return response()->json($data);
            }
        }
        else
        {
            $data['status'] = 0;
            $data['messages'] = 'The old password does not match.';
            return response()->json($data);
        }
    }
}
