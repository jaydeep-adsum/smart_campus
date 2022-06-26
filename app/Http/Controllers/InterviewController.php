<?php

namespace App\Http\Controllers;

use App\Datatable\InterviewDatatable;
use App\Models\Institute;
use App\Models\Interview;
use App\Repositories\InterviewRepository;
use Auth;
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
        $institute = Institute::pluck('institute','id');
        if ($request->ajax()) {
            return Datatables::of((new InterviewDatatable())->get())->make(true);
        }
        return view('interview.index',compact('institute'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $input['institute_id'] = $institute_id;
        $interview = $this->interviewRepository->create($input);

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
        $input = $request->all();
        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $input['institute_id'] = $institute_id;
        $this->interviewRepository->update($input, $request->interviewId);

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
