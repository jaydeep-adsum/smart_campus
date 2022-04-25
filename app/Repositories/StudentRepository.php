<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'first_name',
        'father_name',
        'last_name',
        'email',
        'password',
        'institute_name',
        'department',
        'semester',
        'dob',
        'gender',
        'student_id',
        'year',
        'mobile_no',
        'emergency_contact',
        'address',
        'city',
        'state',
        'is_active',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Student::class;
    }
}
