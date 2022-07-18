<?php

namespace App\Datatable;

use App\Models\CafeteriaUser;

class CafeteriaUserDatatable
{
    public function get($input = [])
    {
        /** @var CafeteriaUser $query */
        $query = CafeteriaUser::query()->select('cafeteria_users.*');

        return $query;
    }
}
