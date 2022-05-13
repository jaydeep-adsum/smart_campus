<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Repositories\FellowshipRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FellowshipController extends AppBaseController
{
    /**
     * FellowshipController constructor.
     * @param FellowshipRepository $fellowshipRepository
     */
    public function __construct(FellowshipRepository $fellowshipRepository)
    {
        $this->fellowshipRepository = $fellowshipRepository;
    }

    /**
     * Swagger definition for Fellowship
     *
     * @OA\Get(
     *     tags={"Fellowship"},
     *     path="/fellowship",
     *     description="Fellowship",
     *     summary="Fellowship",
     *     operationId="fellowship",
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
            $fellowship = $this->fellowshipRepository->paginate(10);

            return $this->sendResponse($fellowship, ('Fellowship fetch successfully.'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }

    /**
     * Swagger defination got one Fellowship
     *
     * @OA\Post(
     *     tags={"Fellowship"},
     *     path="/getFellowship",
     *     description="Get Fellowship",
     *     summary="Get Single Fellowship",
     *     operationId="getFellowship",
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
     *     property="fellowship_id",
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
    public function getFellowship(Request $request)
    {
        try {
            $fellowship = $this->fellowshipRepository->find($request->fellowship_id);
            if (!$fellowship) {
                return $this->sendError('Something went wrong');
            }

            return $this->sendResponse($fellowship, ('Fellowship fetch successfully'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }
}
