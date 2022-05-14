<?php

namespace App\Http\Controllers;

use App\Datatable\InterviewDatatable;
use App\Models\Interview;
use App\Repositories\InterviewRepository;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InterviewController extends AppBaseController
{
    /**
     * InterviewController constructor.
     * @param InterviewRepository $interviewRepository
     */
    public function __construct(InterviewRepository $interviewRepository){
        $this->interviewRepository = $interviewRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new InterviewDatatable())->get())->make(true);
        }
        return view('interview.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $interview = $this->interviewRepository->create($request->all());

        return $this->sendResponse($interview, 'Interview saved successfully.');
    }

    /**
     * @param Interview $interview
     * @return JsonResponse
     */
    public function edit(Interview $interview)
    {
        return $this->sendResponse($interview, 'Interview Retrieved Successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->interviewRepository->update($request->all(), $request->interviewId);

        return $this->sendSuccess('Interview updated successfully.');
    }

    /**
     * @param Interview $interview
     * @return JsonResponse
     */
    public function destroy(Interview $interview)
    {
        $interview->delete();

        return $this->sendSuccess('Interview deleted successfully.');
    }
}
