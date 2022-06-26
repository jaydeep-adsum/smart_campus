<?php

namespace App\Datatable;

use App\Models\Attendance;
use App\Models\Student;
use Auth;

class AttendanceDatatable
{
    public function get(){
        $query = Attendance::query()->select('attendances.*')->with('student');

        return $query;
    }

    public function getStudents($input = [])
    {
        /** @var Student $query */
        $query = Student::query()->select('students.*');

        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        if (session('department') !== null){
            $query->where('department_id', session('department'));
        }
        if (session('student_year') !== null){
            $query->where('year_id',session('student_year'));
        }
        if (session('semester') !== null){
            $query->where('semester_id', session('semester'));
        }


        return $query;
    }

}
