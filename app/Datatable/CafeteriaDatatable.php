<?php

namespace App\Datatable;

use App\Models\Cafeteria;
use App\Models\CafeteriaUser;
use Auth;

class CafeteriaDatatable
{
    public function get($input = [])
    {
        /** @var Cafeteria $query */
        $query = Cafeteria::query()->select('cafeterias.*');
        if (Auth::user()->role==2) {
            $cafeUser = CafeteriaUser::where('user_id',Auth::id())->first();
            $query->where('institute_id', $cafeUser->institute_id);
        }

        return $query;
    }
}
