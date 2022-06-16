<?php

namespace App\Http\Controllers;

use App\Datatable\StudentDatatable;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Imports\StudentsImport;
use App\Mail\loginMail;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Year;
use App\Repositories\StudentRepository;
use Auth;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends AppBaseController
{
    /**
     * @var StudentRepository
     */
    private $studentRepository;

    /**
     * @param StudentRepository $studentRepository
     */
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new StudentDatatable())->get())->make(true);
        }
        return view('student.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $institute = Institute::pluck('institute','id');
        $department = Department::pluck('department','id');
        $semester = Semester::pluck('semester','id');
        $year = Year::pluck('year','id');
        return view('student.create',compact('institute','department','semester','year'));
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StudentRequest $request)
    {
        $input = $request->all();
        $password = Str::random(8);
        $institute_id = Auth::user()->institute->id;
        $input['password'] = Hash::make($password);
        $input['institute_id'] = $request->institute_id?$request->institute_id:$institute_id;
        $student = $this->studentRepository->create($input);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $student->addMedia($request->image)->toMediaCollection(Student::PATH);
        }
        if ($student) {
            $details = [
                'username' => $input['email'],
                'password' => $password,
            ];
            \Mail::to($input['email'])->send(new loginMail($details));
        }
        Flash::success('Student added successfully.');

        return redirect(route('student'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $institute = Institute::pluck('institute','id');
        $department = Department::pluck('department','id');
        $semester = Semester::pluck('semester','id');
        $year = Year::pluck('year','id');
        $student = Student::find($id);
        return view('student.edit', compact('student','institute','department','semester','year'));
    }

    /**
     * @param UpdateStudentRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $input = $request->all();

        $student = $this->studentRepository->update($input, $id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $student->clearMediaCollection(Student::PATH);
            $student->addMedia($request->image)->toMediaCollection(Student::PATH);
        }
        Flash::success('Student updated successfully.');

        return redirect(route('student'));
    }

    /**
     * @param Student $student
     * @return JsonResponse
     */
    public function destroy(Student $student)
    {
        $student->delete();
        $student->media()->delete();

        return $this->sendSuccess('Student deleted successfully.');
    }

    public function import()
    {
        Excel::import(new StudentsImport(), request()->file('file'));
        return back();
    }
}
