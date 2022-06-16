<?php

namespace App\Datatable;

use App\Models\Note;
use Auth;

class NotesDatatable
{
    public function get($input = [])
    {
        /** @var Note $query */
        $query = Note::query()->select('notes.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
