<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::redirect("/api-view", "public/swagger-ui");

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
require __DIR__.'/auth.php';

Route::get('dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('student',[StudentController::class, 'index'])->name('student');
Route::get('student/create',[StudentController::class, 'create'])->name('student.create');
Route::post('student/store',[StudentController::class, 'store'])->name('student.store');
Route::get('student/{id}/edit',[StudentController::class, 'edit'])->name('student.edit');
Route::post('student/update/{id}',[StudentController::class, 'update'])->name('student.update');
Route::get('student/{id}/delete',[StudentController::class, 'destroy'])->name('student.destroy');
Route::post('import', [StudentController::class, 'import'])->name('import');
