<?php

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\userController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\EmployerContoller;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - show form to edit listing
// update - Update listing
// destroy - Delete listing

Route::get('/', function () {
    return view('home');
});

//Show the register page
Route::get('/register', [userController::class, 'index'])->middleware('guest');

//Show the register form
Route::get('/register/{userType}', [userController::class, 'create'])->name('register.create')->middleware('guest');

//Store Created Job Data
// Modify it later so it redirect to Employer Dashboard Page
Route::post('/users', [userController::class, 'store']);


// Log User Out
Route::post('/logout', [userController::class, 'logout']);

// Show Login Form
Route::get('/login', [userController::class, 'login'])->name('login')->middleware('guest');

// Log in User
Route::post('/login/authenticate', [userController::class, 'authenticate']);

// Authorised Logged in - Employer
Route::middleware('auth:employer')->group(function () {
    // Show dashboard for logged-in employer
    Route::get('/employer/dashboard/{id}', [EmployerContoller::class, 'dashboard'])->name('employer.dashboard')->middleware('auth');



    // Show all-jobs for logged-in employer
    Route::get('/employer/jobs/all-jobs', [EmployerContoller::class, 'all_jobs'])->name('employer.all_jobs')->middleware('auth');

    // Search All Jobs Fitler
    Route::get('/employer/jobs/all-jobs/search', [JobController::class, 'search_all_jobs'])->name('employer.search_all_jobs')->middleware('auth');

    // Show active-jobs for logged-in employer
    Route::get('/employer/jobs/active-jobs', [EmployerContoller::class, 'active_jobs'])->name('employer.active_jobs')->middleware('auth');

    // Search Active Jobs Fitler
    Route::get('/employer/jobs/active-jobs/search', [JobController::class, 'search_active_jobs'])->name('employer.search_active_jobs')->middleware('auth');

    //Show Create Job Form page
    Route::get('/employer/jobs/create', [JobController::class, 'create_job'])->middleware('auth');

    //Store Created Job Data
    Route::post('/employer/jobs/store-job-data', [JobController::class, 'store_job']);

    //Show Specific Job details for Logged in Employer
    Route::get('/employer/jobs/{job}', [JobController::class, 'show_logged_in'])->name('employer.show_logged_in')->middleware('auth');

    //Show Specific Job Progress details for Logged in Employer
    Route::get('/employer/jobs/{job}/progress', [JobController::class, 'show_job_progress'])->name('employer.show_job_progress')->middleware('auth');

    //Show Edit Job Form page
    Route::get('/employer/jobs/{job}/edit', [JobController::class, 'edit_job'])->name('employer.edit_job')->middleware('auth');

    //Store Edited Job Data
    Route::put('/employer/jobs/{job}/edit/store', [JobController::class, 'store_edited_job']);

    ///Delete Job Data
    Route::delete('/employer/jobs/{job}/delete', [JobController::class, 'delete_job']);

    // Show Specialist Applications for a certain job
    Route::get('/employer/jobs/{job}/applicants', [JobController::class, 'show_job_applicants'])->name('employer.show_job_applicants')->middleware('auth');

    // Show the detailed view of the applications when clicked the button
    Route::get('/employer/jobs/{job}/applicants/{applicant_id}', [JobController::class, 'show_detailed_applicant'])->name('employer.show_detailed_applicant')->middleware('auth');

    // Store updated trainar application status
    Route::put('/employer/jobs/{job_id}/applicants/{trainer_id}/{applicant_action}', [JobController::class, 'update_applicant_status'])->name('employer.update_applicant_status');

    // Remove Trainer from current job
    Route::put('/employer/jobs/{job_id}/remove-trainer/{trainer_id}', [JobController::class, 'remove_trainer'])->name('employer.remove_trainer');

    Route::post('/employer/jobs/{job_id}/update-job-status/{trainer_id}', [JobController::class, 'update_job_status'])->name('employer.update_job_status');
});

// Show dashboard for logged-in trainer (trainer/dashboard.blade.php)
Route::middleware('auth:trainer')->group(function () {
    Route::get('/trainer/dashboard/{id}', [TrainerController::class, 'dashboard'])->name('trainer.dashboard');
});





//Show All Trainers at find-candidate page (find-trainers/index.blade.php)
Route::get('/find-candidate', [TrainerController::class, 'index']);

//Show Specific Job at find-job overview page (find-trainers/show.blade.php)
Route::get('/find-candidate/{id}', [TrainerController::class, 'show']);




//Show All Jobs at find-job page 
Route::get('/find-job', [JobController::class, 'index']);

//Show Specific Job at find-job overview page
Route::get('/find-job/{job_id}', [JobController::class, 'show']);
