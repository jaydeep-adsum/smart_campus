<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        $student = Student::all();
        $data = [];
        foreach ($student as $item) {
            $data[] = [
                'id' => $item->id,
                'student_id' => $item->student_id,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'father_name' => $item->father_name,
                'email' => $item->email,
                'mobile_no' => $item->mobile_no,
                'emergency_contact' => $item->emergency_contact,
                'dob' => $item->dob,
                'gender' => $item->gender,
                'institute' => $item->institute ? $item->institute->institute : '-',
                'department' => $item->department ? $item->department->department : '-',
                'semester' => $item->semester ? $item->semester->semester : '-',
                'year' => $item->year ? $item->year->year : '-',
                'address' => $item->address,
                'state' => $item->state,
                'city' => $item->city,
            ];
        }
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Student Id',
            'First Name',
            'Last Name',
            'Father Name',
            'Email',
            'Mobile No.',
            'Emergency Contact',
            'DOB',
            'Gender',
            'Institute',
            'Department',
            'Semester',
            'Year',
            'Address',
            'State',
            'City',
        ];
    }
}
