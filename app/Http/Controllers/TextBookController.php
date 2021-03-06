<?php

namespace App\Http\Controllers;

use App\Datatable\TextBooksDatatable;
use App\Http\Requests\textbook\CreateTextBookRequest;
use App\Http\Requests\textbook\UpdateTextBookRequest;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Stream;
use App\Models\TextBook;
use App\Models\Year;
use App\Repositories\TextBookRepository;
use Auth;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TextBookController extends AppBaseController
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
        if(Auth::user()->role==1) {
            $department = Department::where('institute_id', Auth::user()->institute->id)->pluck('department', 'id');
//            $year = Year::where('institute_id', Auth::user()->institute->id)->pluck('year', 'id');
        } else {
            $department = Department::pluck('department', 'id');
//            $year = Year::pluck('year', 'id');
        }
        $institute = Institute::pluck('institute','id');

        return view('textbooks.create', compact('department','institute'));
    }

    /**
     * @param CreateTextBookRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateTextBookRequest $request)
    {
        $input = $request->all();
        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $input['institute_id'] = $institute_id;
        $textBooks = $this->textBookRepository->create($input);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $textBooks->addMedia($request->image)->toMediaCollection(TextBook::PATH);
        }
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $textBooks->addMedia($request->pdf)->toMediaCollection(TextBook::PDF_PATH);
        }
        Flash::success('Text book added successfully.');

        return redirect(route('textbooks'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        if(Auth::user()->role==1) {
            $department = Department::where('institute_id', Auth::user()->institute->id)->pluck('department', 'id');
//            $year = Year::where('institute_id', Auth::user()->institute->id)->pluck('year', 'id');
        } else {
            $department = Department::pluck('department', 'id');
//            $year = Year::pluck('year', 'id');
        }
        $textBooks = $this->textBookRepository->find($id);
        $institute = Institute::pluck('institute','id');

        return view('textbooks.edit', compact('textBooks', 'department','institute'));
    }

    /**
     * @param UpdateTextBookRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateTextBookRequest $request, $id)
    {
        $input = $request->all();
        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $input['institute_id'] = $institute_id;
        $textBooks = $this->textBookRepository->update($input, $id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $textBooks->clearMediaCollection(TextBook::PATH);
            $textBooks->addMedia($request->image)->toMediaCollection(TextBook::PATH);
        }
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $textBooks->clearMediaCollection(TextBook::PDF_PATH);
            $textBooks->addMedia($request->pdf)->toMediaCollection(TextBook::PDF_PATH);
        }
        Flash::success('Text book updated successfully.');

        return redirect(route('textbooks'));
    }

    /**
     * @param TextBook $textbook
     * @return JsonResponse
     */
    public function destroy(TextBook $textbook)
    {
        $textbook->delete();
        $textbook->media()->delete();

        return $this->sendSuccess('Text Book deleted successfully.');
    }
}
