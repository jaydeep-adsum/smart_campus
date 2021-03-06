<?php

namespace App\Http\Controllers;

use App\Datatable\CategoryDatatable;
use App\Http\Requests\category\CreateCategoryRequest;
use App\Http\Requests\category\UpdateCategoryRequest;
use App\Models\CafeteriaUser;
use App\Models\Category;
use App\Models\Institute;
use App\Repositories\CategoryRepository;
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

class CategoryController extends AppBaseController
{
    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CategoryDatatable())->get())->make(true);
        }
        return view('category.index');
    }

    public function create()
    {
        $institute = Institute::pluck('institute','id');
        return view('category.create',compact('institute'));
    }

    /**
     * @param CreateCategoryRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $cafeUser = CafeteriaUser::where('user_id',Auth::id())->first();
//        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $input['institute_id'] = $cafeUser->institute_id;
        $category = $this->categoryRepository->create($input);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $category->addMedia($request->image)->toMediaCollection(Category::PATH);
        }
        Flash::success('Category added successfully.');

        return redirect(route('category'));
    }

    /**+
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $institute = Institute::pluck('institute','id');

        return view('category.edit', compact('category','institute'));
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateCategoryRequest $request,$id)
    {
        $input = $request->all();
        $cafeUser = CafeteriaUser::where('user_id',Auth::id())->first();
        $input['institute_id'] = $cafeUser->institute_id;
        $category = $this->categoryRepository->update($input, $id);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $category->clearMediaCollection(Category::PATH);
            $category->addMedia($request->image)->toMediaCollection(Category::PATH);
        }
        Flash::success('Category updated successfully.');

        return redirect(route('category'));
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->sendSuccess('Category deleted successfully.');
    }
}
