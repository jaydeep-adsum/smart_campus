<?php

namespace App\Datatable;

use App\Models\Fellowship;
use Auth;

class FellowshipDatatable
{
    public function get($input = [])
    {
        /** @var Fellowship $query */
        $query = Fellowship::query()->select('fellowships.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
