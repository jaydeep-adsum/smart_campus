<?php

namespace App\Http\Controllers;

use App\Datatable\CategoryDatatable;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $category = $this->categoryRepository->create($request->all());

        return $this->sendResponse($category, 'Category saved successfully.');
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function edit(Category $category)
    {
        return $this->sendResponse($category, 'Category Retrieved Successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->categoryRepository->update($request->all(), $request->categoryId);

        return $this->sendSuccess('Category updated successfully.');
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
