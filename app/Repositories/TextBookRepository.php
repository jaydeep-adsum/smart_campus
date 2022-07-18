<?php

namespace App\Repositories;

use App\Models\TextBook;

class TextBookRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'written_by',
        'description',
        'department_id',
        'institute_id',
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
