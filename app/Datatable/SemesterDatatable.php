<?php

namespace App\Datatable;

use App\Models\Semester;
use Auth;

class SemesterDatatable
{
    public function get($input = [])
    {
        /** @var Semester $query */
        $query = Semester::query()->select('semesters.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
