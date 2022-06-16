<?php

namespace App\Datatable;

use App\Models\Opportunity;
use Auth;

class OpportunityDatatable
{
    public function get($input = [])
    {
        /** @var Opportunity $query */
        $query = Opportunity::query()->select('opportunities.*');
        if (Auth::user()->role==1) {
            $query->where('institute_id', Auth::user()->institute->id);
        }

        return $query;
    }
}
