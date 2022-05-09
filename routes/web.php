<?php

use App\Http\Controllers\CafeteriaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TextBookController;
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
Route::delete('student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
Route::post('import', [StudentController::class, 'import'])->name('import');

Route::get('events', [EventController::class, 'index'])->name('events');
Route::get('events/create', [EventController::class, 'create'])->name('events.create');
Route::post('events/store', [EventController::class, 'store'])->name('events.store');
Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::post('events/update/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

Route::get('streams', [StreamController::class, 'index'])->name('streams');
Route::post('streams/store', [StreamController::class, 'store'])->name('streams.store');
Route::get('streams/{stream}/edit', [StreamController::class, 'edit'])->name('streams.edit');
Route::post('streams/update', [StreamController::class, 'update'])->name('streams.update');
Route::delete('streams/{stream}', [StreamController::class, 'destroy'])->name('streams.destroy');

Route::get('notes', [NotesController::class, 'index'])->name('notes');
Route::get('notes/create', [NotesController::class, 'create'])->name('notes.create');
Route::post('notes/store', [NotesController::class, 'store'])->name('notes.store');
Route::get('notes/{id}/edit', [NotesController::class, 'edit'])->name('notes.edit');
Route::post('notes/update/{id}', [NotesController::class, 'update'])->name('notes.update');
Route::delete('notes/{note}', [NotesController::class, 'destroy'])->name('notes.destroy');

Route::get('textbooks', [TextBookController::class, 'index'])->name('textbooks');
Route::get('textbooks/create', [TextBookController::class, 'create'])->name('textbooks.create');
Route::post('textbooks/store', [TextBookController::class, 'store'])->name('textbooks.store');
Route::get('textbooks/{id}/edit', [TextBookController::class, 'edit'])->name('textbooks.edit');
Route::post('textbooks/update/{id}', [TextBookController::class, 'update'])->name('textbooks.update');
Route::delete('textbooks/{textbook}', [TextBookController::class, 'destroy'])->name('textbooks.destroy');

Route::get('category', [CategoryController::class, 'index'])->name('category');
Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('cafeteria', [CafeteriaController::class, 'index'])->name('cafeteria');
Route::get('cafeteria/create', [CafeteriaController::class, 'create'])->name('cafeteria.create');
Route::post('cafeteria/store', [CafeteriaController::class, 'store'])->name('cafeteria.store');
Route::get('cafeteria/{cafeteria}/edit', [CafeteriaController::class, 'edit'])->name('cafeteria.edit');
Route::post('cafeteria/update/{id}', [CafeteriaController::class, 'update'])->name('cafeteria.update');
Route::delete('cafeteria/{cafeteria}', [CafeteriaController::class, 'destroy'])->name('cafeteria.destroy');

Route::get('news', [NewsController::class, 'index'])->name('news');
Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('news/store', [NewsController::class, 'store'])->name('news.store');
Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::post('news/update/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
