<?php

namespace App\Http\Controllers;

use App\Datatable\NewsDatatable;
use App\Http\Requests\news\CreateNewsRequest;
use App\Http\Requests\news\UpdateNewsRequest;
use App\Models\News;
use App\Repositories\NewsRepository;
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

class NewsController extends AppBaseController
{
    /**
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new NewsDatatable())->get())->make(true);
        }
        return view('news.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateNewsRequest $request)
    {
        $input = $request->all();
        $institute_id = (Auth::check()&&Auth::user()->role==1)?Auth::user()->institute->id:null;
        $input['institute_id'] = $institute_id;
        $news = $this->newsRepository->create($input);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $news->addMedia($request->image)->toMediaCollection(News::PATH);
        }
        Flash::success('News created successfully.');

        return redirect(route('news'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $news = $this->newsRepository->find($id);

        return view('news.edit', compact('news'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateNewsRequest $request, $id)
    {
        $news = $this->newsRepository->update($request->all(), $id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $news->clearMediaCollection(News::PATH);
            $news->addMedia($request->image)->toMediaCollection(News::PATH);
        }

        Flash::success('News updated successfully.');

        return redirect(route('news'));
    }

    /**
     * @param News $news
     * @return JsonResponse
     */
    public function destroy(News $news)
    {
        $news->delete();
        $news->media()->delete();

        return $this->sendSuccess('News deleted successfully.');
    }
}
