<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repositories\EventsRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends AppBaseController
{
    /**
     * @param EventsRepository $eventsRepository
     */
    public function __construct(EventsRepository $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }

    /**
     * Swagger definition for Country
     *
     * @OA\Get(
     *     tags={"Events"},
     *     path="/events",
     *     description="Events",
     *     summary="Events",
     *     operationId="events",
     * @OA\Parameter(
     *     name="Content-Language",
     *     in="header",
     *     description="Content-Language",
     *     required=false,@OA\Schema(type="string")
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Succuess response"
     *     ,@OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     * @OA\Response(
     *     response="400",
     *     description="Validation error"
     *     ,@OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     * ),
     * @OA\Response(
     *     response="401",
     *     description="Not Authorized Invalid or missing Authorization header"
     *     ,@OA\JsonContent
     *     (ref="#/components/schemas/ErrorResponse")
     * ),
     * @OA\Response(
     *     response=500,
     *     description="Unexpected error"
     *     ,@OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *  ),
     * security={
     *     {"API-Key": {}}
     * }
     * )
     */
    /**
     * /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $data = [];
//            $perPage = $request->page ?? 10;
            $events = $this->eventsRepository->paginate(10);

            return $this->sendResponse($events, ('Your password changed successfully'));
        } catch (\Exception $ex) {
            return $this->sendResponse($ex);
        }
    }

    /**
     * Swagger defination got one all product
     *
     * @OA\Post(
     *     tags={"Events"},
     *     path="/getEvent",
     *     description="Get Event",
     *     summary="Get Single Event",
     *     operationId="getEvent",
     * @OA\Parameter(
     *     name="Content-Language",
     *     in="header",
     *     description="Content-Language",
     *     required=false,@OA\Schema(type="string")
     *     ),
     * @OA\RequestBody(
     *     required=true,
     * @OA\MediaType(
     *     mediaType="multipart/form-data",
     * @OA\JsonContent(
     * @OA\Property(
     *     property="event_id",
     *     type="string"
     *     ),
     *    )
     *   ),
     *  ),
     * @OA\Response(
     *     response=200,
     *     description="User response",@OA\JsonContent
     *     (ref="#/components/schemas/SuccessResponse")
     * ),
     * @OA\Response(
     *     response="400",
     *     description="Validation error",@OA\JsonContent
     *     (ref="#/components/schemas/ErrorResponse")
     * ),
     * @OA\Response(
     *     response="403",
     *     description="Not Authorized Invalid or missing Authorization header",@OA\
     *     JsonContent(ref="#/components/schemas/ErrorResponse")
     * ),
     * @OA\Response(
     *     response=500,
     *     description="Unexpected error",@OA\JsonContent
     *     (ref="#/components/schemas/ErrorResponse")
     * ),
     * security={
     *     {"API-Key": {}}
     * }
     * )
     */
    public function getEvent(Request $request)
    {
        try {
            $event = $this->eventsRepository->find($request->event_id);
            if (!$event){
                return $this->sendError('Something went wrong');
            }

            return $this->sendResponse($event, ('Event fetch successfully'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }
}
