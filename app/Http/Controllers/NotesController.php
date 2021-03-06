<?php

namespace App\Http\Controllers;

use App\Datatable\NotesDatatable;
use App\Http\Requests\note\CreateNoteRequest;
use App\Http\Requests\note\UpdateNoteRequest;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Note;
use App\Models\Stream;
use App\Models\Year;
use App\Repositories\NoteRepository;
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

class NotesController extends AppBaseController
{
    /**
     * @param NoteRepository $noteRepository
     */
    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new NotesDatatable())->get())->make(true);
        }
        return view('note.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $institute = Institute::pluck('institute','id');

        return view('note.create', compact('institute'));
    }

    /**
     * @param CreateNoteRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateNoteRequest $request)
    {
        $input = $request->all();
        if (isset($input['all_institute'])){
            $institute_id=null;
        } else {
            $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        }
        $input['institute_id'] = $institute_id;
        $notes = $this->noteRepository->create($input);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $notes->addMedia($request->image)->toMediaCollection(Note::PATH);
        }
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $notes->addMedia($request->pdf)->toMediaCollection(Note::PDF_PATH);
        }
        Flash::success('Note created successfully.');

        return redirect(route('notes'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $institute = Institute::pluck('institute','id');
        $notes = $this->noteRepository->find($id);

        return view('note.edit', compact('notes', 'institute'));
    }

    /**
     * @param UpdateNoteRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateNoteRequest $request, $id)
    {
        $input = $request->all();
        if (isset($input['all_institute'])){
            $institute_id=null;
        } else {
            $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        }
        $input['institute_id'] = $institute_id;
        $notes = $this->noteRepository->update($input, $id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $notes->clearMediaCollection(Note::PATH);
            $notes->addMedia($request->image)->toMediaCollection(Note::PATH);
        }
        if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
            $notes->clearMediaCollection(Note::PDF_PATH);
            $notes->addMedia($request->pdf)->toMediaCollection(Note::PDF_PATH);
        }
        Flash::success('Note updated successfully.');

        return redirect(route('notes'));
    }

    /**
     * @param Note $note
     * @return JsonResponse
     */
    public function destroy(Note $note)
    {
        $note->delete();
        $note->media()->delete();

        return $this->sendSuccess('Note deleted successfully.');
    }
}
