<?php

namespace App\Datatable;

use App\Models\Interview;
use Auth;

class InterviewDatatable
{
    public function get($input = [])
    {
        /** @var Interview $query */
        $query = Interview::query()->select('interviews.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
