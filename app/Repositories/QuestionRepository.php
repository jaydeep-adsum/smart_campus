<?php


namespace App\Repositories;


use App\Models\Question;

class QuestionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'category','response'
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldsSearchable;
    }

    public function model()
    {
        return Question::class;
    }
}
