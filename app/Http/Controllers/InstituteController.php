<?php

namespace App\Http\Controllers;

use App\Datatable\InstituteDatatable;
use App\Models\Institute;
use App\Models\User;
use App\Repositories\InstituteRepository;
use DataTables;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class InstituteController extends AppBaseController
{
    /**
     * @var InstituteRepository
     */
    private $instituteRepository;

    /**
     * InstituteController constructor.
     * @param InstituteRepository $instituteRepository
     */
    public function __construct(InstituteRepository $instituteRepository){
        $this->instituteRepository = $instituteRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new InstituteDatatable())->get())->make(true);
        }
        return view('institute.index');
    }

    public function create()
    {
        return view('institute.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        $institute = $this->instituteRepository->store($request->all());

        Flash::success('Institute saved successfully.');

        return redirect(route('institute'));
    }

    public function edit($id)
    {
        $institute = Institute::with('user')->where('id',$id)->first();

        return view('institute.edit',compact('institute'));
    }
    public function update(Request $request,$id)
    {
        $user = User::find($request->user_id);
        $checkUser = User::where('email', $request->email)->first();

        if ($user->id != $checkUser->id) {
            return Redirect::back()->withErrors('The email has already been taken.');
        }
        $this->instituteRepository->updateInstitute($request->all(), $id);

        Flash::success('Institute updated successfully.');

        return redirect(route('institute'));
    }
    public function destroy(Institute $institute)
    {
        $institute->delete();

        return $this->sendSuccess('Institute deleted successfully.');
    }
}
