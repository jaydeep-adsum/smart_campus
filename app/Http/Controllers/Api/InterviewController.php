<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Repositories\InterviewRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InterviewController extends AppBaseController
{
    /**
     * InterviewController constructor.
     * @param InterviewRepository $interviewRepository
     */
    public function __construct(InterviewRepository $interviewRepository)
    {
        $this->interviewRepository = $interviewRepository;
    }

    /**
     * Swagger definition for Interview
     *
     * @OA\Get(
     *     tags={"Interview"},
     *     path="/interview",
     *     description="Interview",
     *     summary="Interview",
     *     operationId="interview",
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
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $interview = $this->interviewRepository->paginate(10);

            return $this->sendResponse($interview, ('Interview fetch successfully.'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }

    /**
     * Swagger defination got one Interview
     *
     * @OA\Post(
     *     tags={"Interview"},
     *     path="/getInterview",
     *     description="Get Interview",
     *     summary="Get Single Interview",
     *     operationId="getInterview",
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
     *     property="interview_id",
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
    public function getInterview(Request $request)
    {
        try {
            $interview = $this->interviewRepository->find($request->interview_id);
            if (!$interview) {
                return $this->sendError('Something went wrong');
            }

            return $this->sendResponse($interview, ('Interview fetch successfully'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }
}
