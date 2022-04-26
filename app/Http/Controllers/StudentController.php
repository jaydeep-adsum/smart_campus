<?php

namespace App\Http\Controllers;

use App\Datatable\StudentDatatable;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Imports\StudentsImport;
use App\Mail\loginMail;
use App\Models\Student;
use App\Repositories\StudentRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends AppBaseController
{
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
        return view('student.create');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StudentRequest $request)
    {
        $input = $request->all();
        $password = Str::random(8);
        $input['password'] = Hash::make($password);
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

        return redirect(route('student'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit', compact('student'));
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

        return redirect(route('student'));
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id){
        $student = Student::find($id);
        $this->studentRepository->delete($id);
        $student->media()->delete();

        return redirect(route('student'));
    }

    public function import(){
        Excel::import(new StudentsImport(),request()->file('file'));
        return back();
    }
}
