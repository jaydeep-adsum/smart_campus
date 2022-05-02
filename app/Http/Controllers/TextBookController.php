<?php

namespace App\Http\Controllers;

use App\Datatable\TextBooksDatatable;
use App\Http\Requests\textbook\CreateTextBookRequest;
use App\Http\Requests\textbook\UpdateTextBookRequest;
use App\Models\TextBook;
use App\Repositories\TextBookRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TextBookController extends Controller
{
    /**
     * @param TextBookRepository $textBookRepository
     */
    public function __construct(TextBookRepository $textBookRepository)
    {
        $this->textBookRepository = $textBookRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new TextBooksDatatable())->get())->make(true);
        }
        return view('textbooks.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('textbooks.create');
    }

    /**
     * @param CreateTextBookRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateTextBookRequest $request)
    {
        $input = $request->all();
        $textBooks = $this->textBookRepository->create($input);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $textBooks->addMedia($request->image)->toMediaCollection(TextBook::PATH);
        }
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $textBooks->addMedia($request->pdf)->toMediaCollection(TextBook::PDF_PATH);
        }

        return redirect(route('textbooks'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $textBooks = $this->textBookRepository->find($id);

        return view('textbooks.edit', compact('textBooks'));
    }

    /**
     * @param UpdateTextBookRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateTextBookRequest $request, $id)
    {
        $input = $request->all();

        $textBooks = $this->textBookRepository->update($input, $id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $textBooks->clearMediaCollection(TextBook::PATH);
            $textBooks->addMedia($request->image)->toMediaCollection(TextBook::PATH);
        }
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $textBooks->clearMediaCollection(TextBook::PDF_PATH);
            $textBooks->addMedia($request->pdf)->toMediaCollection(TextBook::PDF_PATH);
        }

        return redirect(route('textbooks'));
    }

    /**
     * @param $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id)
    {
        $textBooks = $this->textBookRepository->find($id);
        $this->textBookRepository->delete($id);
        $textBooks->media()->delete();

        return redirect(route('textbooks'));
    }
}
