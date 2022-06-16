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

        return $query;
    }

}
