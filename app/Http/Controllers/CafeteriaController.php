<?php

namespace App\Http\Controllers;

use App\Datatable\CafeteriaDatatable;
use App\Http\Requests\cafeteria\CreateCafeteriaRequest;
use App\Http\Requests\cafeteria\UpdateCafeteriaRequest;
use App\Models\Cafeteria;
use App\Models\CafeteriaUser;
use App\Models\Category;
use App\Models\Institute;
use App\Repositories\CafeteriaRepository;
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
        $institute = Institute::pluck('institute','id');
        if(Auth::user()->role==1) {
            $category = Category::where('institute_id', Auth::user()->institute->id)->pluck('name', 'id');
        } else {
            $category = Category::pluck('name', 'id');
        }
        return view('cafeteria.create', compact('category','institute'));
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateCafeteriaRequest $request)
    {
        $input = $request->all();
        $cafeUser = CafeteriaUser::where('user_id',Auth::id())->first();
        $input['institute_id'] = $cafeUser->institute_id;
        $cafeteria = $this->cafeteriaRepository->create($input);

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
        $institute = Institute::pluck('institute','id');
        if(Auth::user()->role==1) {
            $category = Category::where('institute_id', Auth::user()->institute->id)->pluck('name', 'id');
        } else {
            $category = Category::pluck('name', 'id');
        }
        $cafeteria = $this->cafeteriaRepository->find($id);

        return view('cafeteria.edit', compact('cafeteria', 'category','institute'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateCafeteriaRequest $request, $id)
    {
        $input = $request->all();
        $cafeUser = CafeteriaUser::where('user_id',Auth::id())->first();
        $input['institute_id'] = $cafeUser->institute_id;
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
