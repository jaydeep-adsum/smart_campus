<?php


namespace App\Repositories;


use App\Models\Institute;

class InstituteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'institute',
    ];
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Institute::class;
    }
}
