<?php

namespace App\Datatable;

use App\Models\Event;
use Auth;

class EventsDatatable
{
    public function get($input = [])
    {
        /** @var Event $query */
        $query = Event::query()->select('events.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }

}
