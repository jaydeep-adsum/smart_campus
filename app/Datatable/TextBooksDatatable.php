<?php

namespace App\Datatable;

use App\Models\TextBook;
use Auth;

class TextBooksDatatable
{
    public function get($input = [])
    {
        /** @var TextBook $query */
        $query = TextBook::query()->select('text_books.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
