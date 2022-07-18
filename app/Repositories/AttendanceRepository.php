<?php

namespace App\Repositories;

use App\Models\Attendance;

class AttendanceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'student_id', 'dates','month','year',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Attendance::class;
    }

    public function store($input){
        $month = session('month');
        $year = session('year');
        foreach ($input['calender'] as $student_id=> $calender){
            $attendance = Attendance::where('student_id',$student_id)->first();
            $inputArr['month'] = $month;
            $inputArr['year'] = $year;
            $inputArr['student_id'] = $student_id;
            $inputArr['dates'] = implode(',',$calender);

            if (isset($attendance)&& $attendance->month==$month&&$attendance->year==$year){
                $attendance->update(['dates'=>'']);
                $attendance->update($inputArr);
            } else{
                $this->create($inputArr);
            }
        }
    }
}
