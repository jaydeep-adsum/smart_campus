<?php


namespace App\Repositories;


use App\Models\Opportunity;

class OpportunityRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'company_name',
        'interview_date',
        'location',
        'criteria',
        'overview',
        'institute_id',
    ];

    /**
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Opportunity::class;
    }
}
