<?php

namespace App\Repositories;

use App\Models\Fellowship;

class FellowshipRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'start_date',
        'end_date',
        'description',
        'web_url',
        'institute_id',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Fellowship::class;
    }
}
