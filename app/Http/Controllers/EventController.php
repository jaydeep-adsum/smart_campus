<?php

namespace App\Http\Controllers;

use App\Datatable\EventsDatatable;
use App\Http\Requests\event\createEventRequest;
use App\Http\Requests\event\UpdateEventRequest;
use App\Models\Event;
use App\Repositories\EventsRepository;
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

class EventController extends AppBaseController
{
    /**+
     * @param EventsRepository $eventsRepository
     */
    public function __construct(EventsRepository $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new EventsDatatable())->get())->make(true);
        }
        return view('events.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * @param createEventRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(createEventRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::user()->name;

        $event = $this->eventsRepository->create($input);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $event->addMedia($request->image)->toMediaCollection(Event::PATH);
        }
        Flash::success('Event Created successfully.');

        return redirect(route('events'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', compact('event'));
    }

    /**
     * @param UpdateEventRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $input = $request->all();

        $event = $this->eventsRepository->update($input, $id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $event->clearMediaCollection(Event::PATH);
            $event->addMedia($request->image)->toMediaCollection(Event::PATH);
        }
        Flash::success('Event updated successfully.');

        return redirect(route('events'));
    }

    /**
     * @param Event $event
     * @return JsonResponse
     */
    public function destroy(Event $event)
    {
        $event->delete();
        $event->media()->delete();

        return $this->sendSuccess('Event deleted successfully.');
    }
}
