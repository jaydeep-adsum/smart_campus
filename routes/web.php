<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CafeteriaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FellowshipController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TextBookController;
use App\Http\Controllers\YearController;
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
Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('changePassword', [DashboardController::class,'changePassword'])->name('changePassword');

    Route::get('institute', [InstituteController::class, 'index'])->name('institute');
    Route::get('institute/create', [InstituteController::class, 'create'])->name('institute.create');
    Route::post('institute/store', [InstituteController::class, 'store'])->name('institute.store');
    Route::get('institute/{institute}/edit', [InstituteController::class, 'edit'])->name('institute.edit');
    Route::post('institute/update/{id}', [InstituteController::class, 'update'])->name('institute.update');
    Route::delete('institute/{institute}', [InstituteController::class, 'destroy'])->name('institute.destroy');

    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('attendance/setSession', [AttendanceController::class, 'setSession'])->name('attendance.setSession');

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
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
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

    Route::get('fellowship', [FellowshipController::class, 'index'])->name('fellowship');
    Route::get('fellowship/create', [FellowshipController::class, 'create'])->name('fellowship.create');
    Route::post('fellowship/store', [FellowshipController::class, 'store'])->name('fellowship.store');
    Route::get('fellowship/{fellowship}/edit', [FellowshipController::class, 'edit'])->name('fellowship.edit');
    Route::post('fellowship/update/{id}', [FellowshipController::class, 'update'])->name('fellowship.update');
    Route::delete('fellowship/{fellowship}', [FellowshipController::class, 'destroy'])->name('fellowship.destroy');

    Route::get('question', [QuestionController::class, 'index'])->name('question');
    Route::post('question/store',[QuestionController::class,'store'])->name('question.store');
    Route::get('question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::post('question/update', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

    Route::get('opportunity', [OpportunityController::class, 'index'])->name('opportunity');
    Route::get('opportunity/create', [OpportunityController::class, 'create'])->name('opportunity.create');
    Route::post('opportunity/store', [OpportunityController::class, 'store'])->name('opportunity.store');
    Route::get('opportunity/{opportunity}/edit',[OpportunityController::class,'edit'])->name('opportunity.edit');
    Route::post('opportunity/update/{id}', [OpportunityController::class, 'update'])->name('opportunity.update');
    Route::delete('opportunity/{opportunity}', [OpportunityController::class, 'destroy'])->name('opportunity.destroy');

    Route::get('interview', [InterviewController::class, 'index'])->name('interview');
    Route::post('interview/store',[InterviewController::class,'store'])->name('interview.store');
    Route::get('interview/{interview}/edit', [InterviewController::class, 'edit'])->name('interview.edit');
    Route::post('interview/update', [InterviewController::class, 'update'])->name('interview.update');
    Route::delete('interview/{interview}', [InterviewController::class, 'destroy'])->name('interview.destroy');

    Route::resource('semester', SemesterController::class);
    Route::resource('department', DepartmentController::class);

    Route::resource('year', YearController::class);
});
