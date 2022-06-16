<?php

namespace App\Datatable;

use App\Models\Category;
use Auth;

class CategoryDatatable
{
    public function get($input = [])
    {
        /** @var Category $query */
        $query = Category::query()->select('categories.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
