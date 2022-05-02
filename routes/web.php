<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\NotesController;
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

Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('student', [StudentController::class, 'index'])->name('student');
Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
Route::get('student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::post('student/update/{id}', [StudentController::class, 'update'])->name('student.update');
Route::get('student/{id}/delete', [StudentController::class, 'destroy'])->name('student.destroy');
Route::post('import', [StudentController::class, 'import'])->name('import');

Route::get('events', [EventController::class, 'index'])->name('events');
Route::get('events/create', [EventController::class, 'create'])->name('events.create');
Route::post('events/store', [EventController::class, 'store'])->name('events.store');
Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::post('events/update/{id}', [EventController::class, 'update'])->name('events.update');
Route::get('events/{id}/delete', [EventController::class, 'destroy'])->name('events.destroy');

Route::get('notes', [NotesController::class, 'index'])->name('notes');
Route::get('notes/create', [NotesController::class, 'create'])->name('notes.create');
Route::post('notes/store', [NotesController::class, 'store'])->name('notes.store');
Route::get('notes/{id}/edit', [NotesController::class, 'edit'])->name('notes.edit');
Route::post('notes/update/{id}', [NotesController::class, 'update'])->name('notes.update');
Route::get('notes/{id}/delete', [NotesController::class, 'destroy'])->name('notes.destroy');
