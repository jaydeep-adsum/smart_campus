<?php

namespace App\Http\Controllers;

use App\Datatable\AttendanceDatatable;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Year;
use App\Repositories\AttendanceRepository;
use Auth;
use DataTables;
use Flash;
use Illuminate\Http\Request;
use Session;

class AttendanceController extends Controller
{
    public function __construct(AttendanceRepository $attendanceRepository){
        $this->attendanceRepository = $attendanceRepository;
    }
    public function index(Request $request)
    {
        $department = Department::where('institute_id', Auth::user()->institute->id)->pluck('department','id');
        $year = Year::where('institute_id', Auth::user()->institute->id)->pluck('year','id');
        $semester = Semester::where('institute_id', Auth::user()->institute->id)->pluck('semester','id');
        if ($request->ajax()) {
            return Datatables::of((new AttendanceDatatable())->get())->make(true);
        }

        return view('attendance.index',compact('department','year','semester'));
    }
    public function create(Request $request)
    {
        $month = session('month');
        $year = session('year');
        $department = session('department');
        $student_year = session('student_year');
        $semester = session('semester');
        $studentId = Student::where('institute_id', Auth::user()->institute->id)->where('department_id',$department)->where('semester_id',$semester)->where('year_id',$student_year)->pluck('id')->toArray();
        $attendanceData = Attendance::with('student')->select('student_id','dates')->where('month',$month)->where('year',$year)->whereIn('student_id',$studentId)->get()->toArray();
        $attend =[];
        foreach ($attendanceData as $att){
            unset($att['student']['institute'],$att['student']['semester'],$att['student']['department'],$att['student']['year'],$att['student']['media']);
            $attend[] = $att;
        }
        $attendance = collect($attend);
        if(count($attendance)==0){
            $attendance = 0;
        }
        if ($request->ajax()) {
            return Datatables::of((new AttendanceDatatable())->getStudents())->make(true);
        }
        return view('attendance.create',compact('attendance'));
    }

    public function setSession(Request $request){
        Session::forget(['month','year','department','student_year','semester']);
        Session::put('month', $request->month);
        Session::put('year', $request->year);
        Session::put('department', $request->department);
        Session::put('student_year', $request->student_year);
        Session::put('semester', $request->semester);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'calender' => 'required',
        ],
        [
            'calender.required'=>'Select almost one date',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => "false", 'messages' => array(implode(', ', $validator->errors()->all()))]);
        }
        $this->attendanceRepository->store($request->all());

        Flash::success('Attendance added successfully.');

        return redirect(route('attendance'));

    }
}
