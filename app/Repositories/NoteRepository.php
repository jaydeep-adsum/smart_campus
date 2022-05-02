<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'chapter',
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
        return Note::class;
    }
}
