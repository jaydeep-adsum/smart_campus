<?php

namespace App\Http\Controllers;

use App\Datatable\SemesterDatatable;
use App\Repositories\SemesterRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SemesterController extends AppBaseController
{
    public function __construct(SemesterRepository $semesterRepository){
        $this->semesterRepository = $semesterRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new SemesterDatatable())->get())->make(true);
        }
        return view('semester.index');
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
        $semester = $this->semesterRepository->create($request->all());

        return $this->sendResponse($semester, 'Semester saved successfully.');
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
     * @param int $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $semester = $this->semesterRepository->find($id);
        return $this->sendResponse($semester, 'Semester Retrieved Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->semesterRepository->update($request->all(), $id);

        return $this->sendSuccess('Semester updated successfully.');
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
        $this->semesterRepository->delete($id);

        return $this->sendSuccess('Semester deleted successfully.');
    }
}
