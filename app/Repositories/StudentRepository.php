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
        'institute_id',
        'department_id',
        'semester_id',
        'dob',
        'gender',
        'student_id',
        'year_id',
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
