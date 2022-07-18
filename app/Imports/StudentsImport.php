<?php

namespace App\Imports;

use App\Mail\loginMail;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use App\Models\Year;
use Auth;
use DB;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $row) {
                $input = [];
                if ($row['sl_no'] != '') {
                    $strRand = Str::random(8);
                    $institute = Institute::where('institute', $row['previous_college_school'])->first();
                    $department = Department::where('department', $row['stream_department'])->first();
                    $year = Year::where('year', $row['entry_year'])->first();
                    $semester = Semester::where('semester', $row['semester'])->first();

                    if (!$institute) {
                        $user = User::where('email', $row['previous_college_contact_person_email'])->first();
                        $userInput['name'] = $row['previous_college_contact_person'];
                        $userInput['email'] = $row['previous_college_contact_person_email'];
                        $userInput['password'] = Hash::make($row['previous_college_contact_person_password']);
                        $userInput['role'] = '1';
                        if (!$user) {
                            $user = User::create($userInput);
                        }
                        $institute = Institute::create([
                            'institute' => $row['previous_college_school'],
                            'address' => $row['previous_college_school'],
                            'contact' => $row['previous_college_school'],
                            'user_id' => $user->id,
                        ]);
                    }
                    if (Auth::check() && Auth::user()->role == 1) {
                        $institute_id = Auth::user()->institute->id;
                    } else {
                        $institute_id = $institute->id;
                    }
                    if (!$department) {
                        $department = Department::create([
                            'department' => $row['stream_department'],
                            'institute_id' => $institute_id
                        ]);
                    }
                    $department_id = $department->id;
                    if (!$year) {
                        $year = Year::create([
                            'year' => $row['entry_year'],
                            'institute_id' => $institute_id
                        ]);
                    }
                    $year_id = $year->id;
                    if (!$semester) {
                        $semester = Semester::create([
                            'semester' => $row['semester'],
                            'institute_id' => $institute_id
                        ]);
                    }
                    $semester_id = $semester->id;

                    $input = [
                        'first_name' => (explode(' ', $row['student_name_first_name_last_name']))[0],
                        'father_name' => $row['father_name'],
                        'last_name' => (explode(' ', $row['student_name_first_name_last_name']))[1],
                        'email' => $row['email_id'],
                        'institute_id' => $institute_id,
                        'department_id' => $department_id,
                        'semester_id' => $semester_id,
                        'dob' => Date::excelToDateTimeObject($row['birth_dateddmmyyyy'])->format('Y-m-d'),
                        'gender' => $row['gender'],
                        'student_id' => $row['student_id'],
                        'year_id' => $year_id,
                        'mobile_no' => $row['contact_number'],
                        'emergency_contact' => $row['emergency_contact'],
                        'address' => $row['address'],
                        'city' => $row['city'],
                        'state' => $row['state'],
                    ];
                    $input['password'] = Hash::make($strRand);
                    $student = Student::create($input);
                    if ($student) {
                        $details = [
                            'username' => $input['email'],
                            'password' => $strRand,
                        ];
                        \Mail::to($input['email'])->send(new loginMail($details));
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
