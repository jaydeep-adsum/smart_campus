<?php

namespace App\Http\Controllers;

use App\Datatable\FellowshipDatatable;
use App\Models\Fellowship;
use App\Repositories\FellowshipRepository;
use DataTables;
use Flash;
use Illuminate\Http\Request;

class FellowshipController extends AppBaseController
{
    public function __construct(FellowshipRepository $fellowshipRepository)
    {
        $this->fellowshipRepository = $fellowshipRepository;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FellowshipDatatable())->get())->make(true);
        }
        return view('fellowship.index');
    }

    public function create()
    {
        return view('fellowship.create');
    }
    public function store(Request $request)
    {
        $this->fellowshipRepository->create($request->all());

        Flash::success('Fellowship created successfully.');

        return redirect(route('fellowship'));
    }
    public function edit($id)
    {
        $fellowship = $this->fellowshipRepository->find($id);

        return view('fellowship.edit', compact('fellowship'));
    }

    public function update(Request $request, $id)
    {

        $fellowship = $this->fellowshipRepository->update($request->all(), $id);

        Flash::success('Fellowship updated successfully.');

        return redirect(route('fellowship'));
    }

    public function destroy(Fellowship $fellowship)
    {
        $fellowship->delete();

        return $this->sendSuccess('Fellowship deleted successfully.');
    }
}
