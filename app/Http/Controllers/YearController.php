<?php

namespace App\Http\Controllers;

use App\Datatable\YearDatatable;
use App\Models\Institute;
use App\Models\Year;
use App\Repositories\YearRepository;
use Auth;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class YearController extends AppBaseController
{
    /**
     * @var YearRepository
     */
    private $yearRepository;

    public function __construct(YearRepository $yearRepository){
        $this->yearRepository = $yearRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        $institute = Institute::pluck('institute','id');
        if ($request->ajax()) {
            return Datatables::of((new YearDatatable())->get())->make(true);
        }
        return view('year.index',compact('institute'));
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
        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $input['institute_id'] = $institute_id;
        $year = $this->yearRepository->create($input);

        return $this->sendResponse($year, 'Year saved successfully.');
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
        $year = $this->yearRepository->find($id);
        return $this->sendResponse($year, 'Year Retrieved Successfully.');
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
        $input = $request->all();
        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $input['institute_id'] = $institute_id;
        $this->yearRepository->update($input, $id);

        return $this->sendSuccess('Year updated successfully.');
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
        $this->yearRepository->delete($id);

        return $this->sendSuccess('Year deleted successfully.');
    }
}
