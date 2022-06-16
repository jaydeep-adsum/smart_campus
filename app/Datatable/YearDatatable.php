<?php

namespace App\Datatable;

use App\Models\Year;
use Auth;

class YearDatatable
{
    public function get($input = [])
    {
        /** @var Year $query */
        $query = Year::query()->select('years.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }
        return $query;
    }
}
