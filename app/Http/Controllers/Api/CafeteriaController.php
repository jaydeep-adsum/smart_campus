<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CafeteriaRepository;
use App\Repositories\CategoryRepository;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CafeteriaController extends AppBaseController
{
    /**
     * @param CafeteriaRepository $cafeteriaRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CafeteriaRepository $cafeteriaRepository, CategoryRepository $categoryRepository)
    {
        $this->cafeteriaRepository = $cafeteriaRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Swagger definition for Cafeteria
     *
     * @OA\Get(
     *     tags={"Cafeteria"},
     *     path="/cafeteria",
     *     description="Cafeteria",
     *     summary="Cafeteria",
     *     operationId="cafeteria",
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
            $cafeteria = $this->cafeteriaRepository->paginate(10);

            return $this->sendResponse($cafeteria, ('Cafeteria fetch successfully.'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }

    /**
     * Swagger defination got one Cafeteria
     *
     * @OA\Post(
     *     tags={"Cafeteria"},
     *     path="/getCafeteria",
     *     description="Get Cafeteria",
     *     summary="Get Single Cafeteria",
     *     operationId="getCafeteria",
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
     *     property="cafeteria_id",
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
    public function getCafeteria(Request $request)
    {
        try {
            $cafeteria = $this->cafeteriaRepository->find($request->cafeteria_id);
            if (!$cafeteria) {
                return $this->sendError('Something went wrong');
            }

            return $this->sendResponse($cafeteria, ('Cafeteria fetch successfully'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }

    /**
     * Swagger definition for Cafeteria
     *
     * @OA\Get(
     *     tags={"Cafeteria"},
     *     path="/categoryWithCafeteria",
     *     description="Category With Cafeteria",
     *     summary="Category With Cafeteria",
     *     operationId="categoryWithCafeteria",
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
    public function getCategoryWithCafeteria(Request $request)
    {
        try {
            $category = Category::with('cafeteria')->where('institute_id',Auth::user()->institute_id)->get();

            if (!$category) {
                return $this->sendError('Something went wrong');
            }

            return $this->sendResponse(['data'=>$category], ('Category with cafeteria fetch successfully'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }

    /**
     * Swagger defination got one Cafeteria
     *
     * @OA\Post(
     *     tags={"Cafeteria"},
     *     path="/singleCategoryWithCafeteria",
     *     description="Get single category with Cafeteria",
     *     summary="Get Single Category with Cafeteria",
     *     operationId="getSingleCategoryWithCafeteria",
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
     *     property="category_id",
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
    public function getSingleCategoryWithCafeteria(Request $request)
    {
        try {
            if (!$request->category_id) {
                return $this->sendError('Something went wrong');
            }
            $category = Category::where('id', $request->category_id)->with('cafeteria')->where('institute_id',Auth::user()->institute_id)->get();

            return $this->sendResponse($category, ('Category with cafeteria fetch successfully'));
        } catch (Exception $ex) {
            return $this->sendError($ex);
        }
    }
}
