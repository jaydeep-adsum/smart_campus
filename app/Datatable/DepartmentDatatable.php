<?php

namespace App\Datatable;

use App\Models\Department;
use Auth;

class DepartmentDatatable
{
    public function get($input = [])
    {
        /** @var Department $query */
        $query = Department::query()->select('departments.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
