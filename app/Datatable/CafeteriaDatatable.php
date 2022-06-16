<?php

namespace App\Datatable;

use App\Models\Cafeteria;
use Auth;

class CafeteriaDatatable
{
    public function get($input = [])
    {
        /** @var Cafeteria $query */
        $query = Cafeteria::query()->select('cafeterias.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
