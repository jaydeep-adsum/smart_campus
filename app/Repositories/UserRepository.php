<?php

namespace App\Repositories;

use App\Models\CafeteriaUser;

class UserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'institute_id',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return CafeteriaUser::class;
    }
}
