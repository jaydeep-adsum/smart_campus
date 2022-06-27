<?php


namespace App\Repositories;


use App\Models\Question;

class QuestionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'category','response','institute_id',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Question::class;
    }
}
