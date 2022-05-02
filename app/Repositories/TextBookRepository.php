<?php

namespace App\Repositories;

use App\Models\TextBook;

class TextBookRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'written_by',
        'description',
        'year',
        'stream',
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
