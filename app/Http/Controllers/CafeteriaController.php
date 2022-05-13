<?php

namespace App\Http\Controllers;

use App\Datatable\CafeteriaDatatable;
use App\Models\Cafeteria;
use App\Models\Category;
use App\Repositories\CafeteriaRepository;
use DataTables;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CafeteriaController extends AppBaseController
{
    /**
     * @param CafeteriaRepository $cafeteriaRepository
     */
    public function __construct(CafeteriaRepository $cafeteriaRepository)
    {
        $this->cafeteriaRepository = $cafeteriaRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CafeteriaDatatable())->get())->make(true);
        }
        return view('cafeteria.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $category = Category::pluck('name', 'id');
        return view('cafeteria.create', compact('category'));
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $cafeteria = $this->cafeteriaRepository->create($request->all());

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $cafeteria->addMedia($request->image)->toMediaCollection(Cafeteria::PATH);
        }

        Flash::success('Cafeteria created successfully.');

        return redirect(route('cafeteria'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = Category::pluck('name', 'id');
        $cafeteria = $this->cafeteriaRepository->find($id);

        return view('cafeteria.edit', compact('cafeteria', 'category'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $cafeteria = $this->cafeteriaRepository->update($input, $id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $cafeteria->clearMediaCollection(Cafeteria::PATH);
            $cafeteria->addMedia($request->image)->toMediaCollection(Cafeteria::PATH);
        }

        Flash::success('Cafeteria updated successfully.');

        return redirect(route('cafeteria'));
    }

    /**
     * @param Cafeteria $cafeteria
     * @return JsonResponse
     */
    public function destroy(Cafeteria $cafeteria)
    {
        $cafeteria->delete();
        $cafeteria->media()->delete();

        return $this->sendSuccess('Cafeteria deleted successfully.');
    }
}