<?php

namespace App\Datatable;

use App\Models\News;
use Auth;

class NewsDatatable
{
    public function get($input = [])
    {
        /** @var News $query */
        $query = News::query()->select('news.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
