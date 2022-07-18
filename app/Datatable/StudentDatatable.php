<?php

namespace App\Datatable;

use App\Models\Student;
use Auth;

class StudentDatatable
{
    public function get($input = [])
    {
        /** @var Student $query */
        $query = Student::query()->select('students.*');

        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }
        if ($input['institute_id']){
            $query->where('institute_id', $input['institute_id']);
        }
        if ($input['department_id']){
            $query->where('department_id', $input['department_id']);
        }
        if ($input['semester_id']){
            $query->where('semester_id', $input['semester_id']);
        }
        if ($input['year_id']){
            $query->where('year_id', $input['year_id']);
        }

        return $query;
    }

}
