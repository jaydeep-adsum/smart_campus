<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Repositories\OpportunityRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OpportunityController extends AppBaseController
{
    /**
     * OpportunityController constructor.
     * @param OpportunityRepository $opportunityRepository
     */
    public function __construct(OpportunityRepository $opportunityRepository)
    {
     $this->opportunityRepository = $opportunityRepository;
    }

    /**
     * Swagger definition for Opportunity
     *
     * @OA\Get(
     *     tags={"Opportunity"},
     *     path="/opportunity",
     *     description="Opportunity",
     *     summary="Opportunity",
     *     operationId="opportunity",
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
            $opportunity = $this->opportunityRepository->paginate(10);

            return $this->sendResponse($opportunity, ('Opportunity fetch successfully.'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }

    /**
     * Swagger defination got one Opportunity
     *
     * @OA\Post(
     *     tags={"Opportunity"},
     *     path="/getOpportunity",
     *     description="Get Opportunity",
     *     summary="Get Single Opportunity",
     *     operationId="getOpportunity",
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
     *     property="opportunity_id",
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
    public function getOpportunity(Request $request)
    {
        try {
            $opportunity = $this->opportunityRepository->find($request->opportunity_id);
            if (!$opportunity) {
                return $this->sendError('Something went wrong');
            }

            return $this->sendResponse($opportunity, ('Opportunity fetch successfully'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }
}
