<?php


namespace App\Repositories;


use App\Models\Interview;

class InterviewRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'question',
        'answer',
        'institute_id',
    ];
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Interview::class;
    }
}
