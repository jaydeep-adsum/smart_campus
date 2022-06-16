<?php

namespace App\Http\Controllers;

use App\Datatable\InstituteDatatable;
use App\Models\Institute;
use App\Repositories\InstituteRepository;
use DataTables;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        $institute = $this->instituteRepository->store($request->all());

        Flash::success('Institute saved successfully.');

        return redirect(route('institute'));
    }

    public function edit(Institute $institute)
    {
        return $this->sendResponse($institute, 'Institute Retrieved Successfully.');
    }
    public function update(Request $request)
    {
        $this->instituteRepository->update($request->all(), $request->instituteId);

        return $this->sendSuccess('Institute updated successfully.');
    }
    public function destroy(Institute $institute)
    {
        $institute->delete();

        return $this->sendSuccess('Institute deleted successfully.');
    }
}
