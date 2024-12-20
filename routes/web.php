<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\GradingSchemesController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubAssessmentsController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('grading', GradingSchemesController::class);
Route::resource('semester', SemesterController::class);
Route::resource('subject', SubjectsController::class);
Route::resource('study', StudyController::class);
Route::resource('dashboard', DashboardController::class);

Route::get('/assessment/create/{subject_id}', [AssessmentsController::class, 'create'])->name('assessment.create'); //assessment based on subject id
Route::post('/assessment/{subject_id}', [AssessmentsController::class, 'store'])->name('assessment.store');
Route::get('assessment/{assessment}/edit',[AssessmentsController::class, 'edit'])->name('assessment.edit');
Route::patch('/assessment/{assessment}', [AssessmentsController::class, 'update'])->name('assessment.update');

Route::get('/subAssessment/create/{subject_id}', [SubAssessmentsController::class, 'create'])->name('subAssessment.create'); //sub assessment based on subject
Route::post('/subAssessment/{subject_id}', [SubAssessmentsController::class, 'store'])->name('subAssessment.store');
Route::get('/subAssessment/{subAssessment}/edit', [SubAssessmentsController::class, 'edit'])->name('subAssessment.edit');
Route::patch('/subAssessment/{subAssessment}', [SubAssessmentsController::class, 'update'])->name('subAssessment.update');
Route::delete('/subAssessment/{subAssessment}', [SubAssessmentsController::class, 'destroy'])->name('subAssessment.destroy');

Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
Route::get('/progress/{subjects}', [ProgressController::class, 'show'])->name('progress.show');

//Route::view('/show_reward', 'show_reward')->name('show_reward');
