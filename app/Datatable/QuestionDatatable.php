<?php

namespace App\Datatable;

use App\Models\Question;
use Auth;

class QuestionDatatable
{
    public function get($input = [])
    {
        /** @var Question $query */
        $query = Question::query()->select('questions.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
