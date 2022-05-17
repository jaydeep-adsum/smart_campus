<?php

namespace App\Repositories;

use App\Models\TextBook;

class TextBookRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'written_by',
        'description',
        'year_id',
        'department_id',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return TextBook::class;
    }
}
