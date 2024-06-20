<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobseekerController;
use App\Http\Controllers\JobSeekerController as ControllersJobSeekerController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;

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

Route::get('', fn() => to_route('jobs.index'));
Route::resource('jobs', JobController::class)->only(['index', 'show']);

Route::get('login', fn() => to_route('auth.create'))->name('login');
Route::resource('auth', AuthController::class)->only(['create', 'store']);

Route::get('logout', fn() => to_route('auth.destroy'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');

Route::get('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/save-user', [AuthController::class, 'saveUser'])->name('auth.save-user');

Route::get('auth/employer-register', [AuthController::class, 'employerRegister'])->name('auth.employer-register');

Route::post('auth/save-employer', [AuthController::class, 'saveEmployer'])->name('auth.save-employer');


Route::middleware('auth')->group(function () {
    Route::resource('job.application', JobApplicationController::class)->only(['create', 'store', 'show']);
    Route::get('job/{job}/application/{application}/status', [JobApplicationController::class, 'updateState'])->name('job.application.updateState');
    Route::resource('my-job-applications', MyJobApplicationController::class)->only(['index', 'destroy']);

    Route::resource('employer', EmployerController::class)->only(['create', 'store', 'edit', 'update']);

    Route::middleware('employer')->resource('my-jobs', MyJobController::class);

    // Jobseeker routes
    /**
     * custome route first 
     * to avoid route path confusion 
     * with resource routes path
     */
    Route::get('job-seeker/recomendedjob', [JobseekerController::class, 'myRecommendedJobs'])->name('job-seeker.recomendedjob');

    Route::resource('job-seeker', JobseekerController::class)->only(['create', 'store', 'show', 'edit', 'update']);

    // Recommended candidates
    Route::get('employer/suggestedCandidates', [EmployerController::class, 'suggestedCandidates'])->name('employer.suggestedCandidates');

});