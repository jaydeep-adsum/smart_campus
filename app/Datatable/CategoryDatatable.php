<?php

namespace App\Datatable;

use App\Models\CafeteriaUser;
use App\Models\Category;
use Auth;

class CategoryDatatable
{
    public function get($input = [])
    {
        /** @var Category $query */
        $query = Category::query()->select('categories.*');
        if (Auth::user()->role==2) {
            $cafeUser = CafeteriaUser::where('user_id',Auth::id())->first();
            $query->where('institute_id', $cafeUser->institute_id);
        }

        return $query;
    }
}
