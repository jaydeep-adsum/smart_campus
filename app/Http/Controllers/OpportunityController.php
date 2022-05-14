<?php

namespace App\Http\Controllers;

use App\Datatable\OpportunityDatatable;
use App\Http\Requests\opportunity\CreateOpportunityRequest;
use App\Http\Requests\opportunity\UpdateOpportunityRequest;
use App\Models\Opportunity;
use App\Repositories\OpportunityRepository;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class OpportunityController extends AppBaseController
{
    /**
     * OpportunityController constructor.
     * @param OpportunityRepository $opportunityRepository
     */
    public function __construct(OpportunityRepository $opportunityRepository)
    {
        $this->opportunityRepository = $opportunityRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new OpportunityDatatable())->get())->make(true);
        }
        return view('opportunity.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('opportunity.create');
    }

    /**
     * @param CreateOpportunityRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateOpportunityRequest $request)
    {
        $opportunity = $this->opportunityRepository->create($request->all());

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $opportunity->addMedia($request->image)->toMediaCollection(Opportunity::PATH);
        }
        Flash::success('Opportunity created successfully.');

        return redirect(route('opportunity'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $opportunity = $this->opportunityRepository->find($id);

        return view('opportunity.edit', compact('opportunity'));
    }

    /**
     * @param UpdateOpportunityRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateOpportunityRequest $request, $id)
    {
        $opportunity = $this->opportunityRepository->update($request->all(), $id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $opportunity->clearMediaCollection(Opportunity::PATH);
            $opportunity->addMedia($request->image)->toMediaCollection(Opportunity::PATH);
        }

        Flash::success('Opportunity updated successfully.');

        return redirect(route('opportunity'));
    }

    /**
     * @param Opportunity $opportunity
     * @return JsonResponse
     */
    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();
        $opportunity->media()->delete();

        return $this->sendSuccess('Opportunity deleted successfully.');
    }
}
