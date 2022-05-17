<?php


namespace App\Repositories;


use App\Models\Year;

class YearRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldsSearchable = [
        'year'
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldsSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Year::class;
    }
}
