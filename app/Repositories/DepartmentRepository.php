<?php


namespace App\Repositories;


use App\Models\Department;

class DepartmentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'department',
    ];
    public function getFieldsSearchable()
    {
        return $this->fieldsSearchable;
    }

    public function model()
    {
        return Department::class;
    }
}
