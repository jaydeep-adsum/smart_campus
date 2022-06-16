<?php

namespace App\Http\Controllers;

use App\Datatable\FellowshipDatatable;
use App\Http\Requests\fellowship\CreateFellowshipRequest;
use App\Http\Requests\fellowship\UpdateFellowshipRequest;
use App\Models\Fellowship;
use App\Repositories\FellowshipRepository;
use Auth;
use DataTables;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class FellowshipController extends AppBaseController
{
    /**
     * FellowshipController constructor.
     * @param FellowshipRepository $fellowshipRepository
     */
    public function __construct(FellowshipRepository $fellowshipRepository)
    {
        $this->fellowshipRepository = $fellowshipRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FellowshipDatatable())->get())->make(true);
        }
        return view('fellowship.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('fellowship.create');
    }

    /**
     * @param CreateFellowshipRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateFellowshipRequest $request)
    {
        $input = $request->all();
        $institute_id = (Auth::check()&&Auth::user()->role==1)?Auth::user()->institute->id:null;
        $input['institute_id'] = $institute_id;
        $this->fellowshipRepository->create($input);

        Flash::success('Fellowship created successfully.');

        return redirect(route('fellowship'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $fellowship = $this->fellowshipRepository->find($id);

        return view('fellowship.edit', compact('fellowship'));
    }

    /**
     * @param UpdateFellowshipRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateFellowshipRequest $request, $id)
    {

        $fellowship = $this->fellowshipRepository->update($request->all(), $id);

        Flash::success('Fellowship updated successfully.');

        return redirect(route('fellowship'));
    }

    /**
     * @param Fellowship $fellowship
     * @return JsonResponse
     */
    public function destroy(Fellowship $fellowship)
    {
        $fellowship->delete();

        return $this->sendSuccess('Fellowship deleted successfully.');
    }
}
