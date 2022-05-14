<?php

use App\Http\Controllers\Api\CafeteriaController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\FellowshipController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TextBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('Api')->group(
    function () {
        Route::get('swagger', 'SwaggerController@listItem');
        Route::post('login', [StudentController::class, 'login']);

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('forget-password', [StudentController::class, 'forgetPassword']);

            Route::get('events', [EventController::class, 'index']);
            Route::post('getEvent', [EventController::class, 'getEvent']);

            Route::get('notes', [NoteController::class, 'index']);
            Route::post('getNote', [NoteController::class, 'getNote']);

            Route::get('textbooks', [TextBookController::class, 'index']);
            Route::post('getTextbook', [TextBookController::class, 'getTextbook']);

            Route::get('cafeteria', [CafeteriaController::class, 'index']);
            Route::post('getCafeteria', [CafeteriaController::class, 'getCafeteria']);
            Route::get('categoryWithCafeteria', [CafeteriaController::class, 'getCategoryWithCafeteria']);
            Route::post('singleCategoryWithCafeteria', [CafeteriaController::class, 'getSingleCategoryWithCafeteria']);

            Route::get('news', [NewsController::class, 'index']);
            Route::post('getNews', [NewsController::class, 'getNews']);

            Route::get('fellowship', [FellowshipController::class, 'index']);
            Route::post('getFellowship', [FellowshipController::class, 'getFellowship']);

            Route::get('questions', [QuestionController::class, 'index']);
            Route::post('getQuestion', [QuestionController::class, 'getQuestion']);
        });
    }
);
