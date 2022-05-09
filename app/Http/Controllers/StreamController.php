<?php

namespace App\Http\Controllers;

use App\Datatable\StreamsDatatable;
use App\Models\Stream;
use App\Repositories\StreamRepository;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StreamController extends AppBaseController
{
    /**
     * @param StreamRepository $streamRepository
     */
    public function __construct(StreamRepository $streamRepository)
    {
        return $this->streamRepository = $streamRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new StreamsDatatable())->get())->make(true);
        }
        return view('streams.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $stream = $this->streamRepository->create($input);

        return $this->sendResponse($stream, 'Stream saved successfully.');
    }

    /**
     * @param Stream $stream
     * @return JsonResponse
     */
    public function edit(Stream $stream)
    {
        return $this->sendResponse($stream, 'Stream Retrieved Successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $this->streamRepository->update($input, $request->streamId);

        return $this->sendSuccess('Stream updated successfully.');
    }

    /**
     * @param Stream $stream
     * @return JsonResponse
     */
    public function destroy(Stream $stream)
    {
        $stream->delete();

        return $this->sendSuccess('Stream deleted successfully.');
    }
}
