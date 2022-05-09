<?php

namespace App\Repositories;

use App\Models\Cafeteria;

class CafeteriaRepository extends BaseRepository
{
    protected $fieldsSearchable = [
        'name',
        'price',
        'category_id ',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldsSearchable;
    }

    public function model()
    {
        return Cafeteria::class;
    }
}
