<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Authenticator;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends AppBaseController
{
    /**
     * @param StudentRepository $studentRepository
     * @param Authenticator $authenticator
     * @param Request $request
     */
    public function __construct(StudentRepository $studentRepository, Authenticator $authenticator, Request $request)
    {
        $this->studentRepository = $studentRepository;
        $this->authenticator = $authenticator;
        $this->request = $request;
    }

    /**
     * Swagger defination got one all product
     *
     * @OA\Post(
     *     tags={"Authentication"},
     *     path="/login",
     *     description="Login Student",
     *     summary="Login Student",
     *     operationId="loginStudent",
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
     *     property="email",
     *     type="string"
     *     ),
     * @OA\Property(
     *     property="password",
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
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => "false", 'data' => "", 'message' => implode(', ', $validator->errors()->all())]);
            }
            $credentials = array_values(
                $this->request->only('email', 'password')
            );

            $credentials['email'] = $request->email;
            $credentials['password'] = $request->password;

            if ($student = $this->authenticator->attemptLogin($credentials)) {
                $update = Student::where('id', $student->id)->update(['device_token' => $request->device_token, 'device_type' => $request->device_type]);
                $student = Student::find($student->id);
                $tokenResult = $student->createToken('smart_campus');
                $token = $tokenResult->token;
                $token->save();
                $success['token'] = 'Bearer ' . $tokenResult->accessToken;
                $success['expires_at'] = Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString();
                $success['user'] = $student;

                return $this->sendResponse(
                    $success, 'You Have Successfully Logged in to smart campus.'
                );
            } else {
                return response()->json(['status' => "false", 'data' => "", 'message' => 'These credentials do not match our records']);
            }
        } catch (Exception $e) {
            return $this->sendErrorResponse($e);
        }

    }

    /**
     * Swagger defination got one all product
     *
     * @OA\Post(
     *     tags={"Authentication"},
     *     path="/forget-password",
     *     description="Forget Password",
     *     summary="Forget Password",
     *     operationId="forgetPassword",
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
     *     property="student_id",
     *     type="string"
     *     ),
     * @OA\Property(
     *     property="password",
     *     type="string"
     *     ),
     * @OA\Property(
     *     property="confirm_password",
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
    public function forgetPassword(Request $request)
    {
        try {
            if (Auth::user()->id != $request->student_id) {
                return $this->sendError('Unauthorized');
            }
            $student = Student::find($request->student_id);
            if (!$student) {
                return $this->sendError('User does not exist');
            }
            if ($request->password != $request->confirm_password) {
                return $this->sendError('Your password and confirmation password do not match');
            }
            $student->password = Hash::make($request->password);
            $student->is_active = '1';
            $student->save();

            return $this->sendResponse($student->toArray(), ('Your password changed successfully'));
        } catch (\Exception $ex) {
            return $this->sendResponse($ex);
        }
    }


}
