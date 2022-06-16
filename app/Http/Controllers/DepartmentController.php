<?php

namespace App\Http\Controllers;

use App\Datatable\DepartmentDatatable;
use App\Repositories\DepartmentRepository;
use Auth;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends AppBaseController
{
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository){
        $this->departmentRepository = $departmentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new DepartmentDatatable())->get())->make(true);
        }
        return view('department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $institute_id = (Auth::check()&&Auth::user()->role==1)?Auth::user()->institute->id:null;
        $input['institute_id'] = $institute_id;
        $department = $this->departmentRepository->create($input);

        return $this->sendResponse($department, 'Department saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $department = $this->departmentRepository->find($id);

        return $this->sendResponse($department, 'Department Retrieved Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->departmentRepository->update($request->all(), $id);

        return $this->sendSuccess('Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->departmentRepository->delete($id);

        return $this->sendSuccess('Department deleted successfully.');
    }
}
