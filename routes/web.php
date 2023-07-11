<?php

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\userController;
use App\Http\Controllers\EmployerContoller;
use App\Http\Controllers\TrainerController;

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

// -------------------------------------------------------------------------------------- //
// ------------------------------------- REGISTER --------------------------------------- //
// -------------------------------------------------------------------------------------- //

//Show the register page
Route::get('/register', [userController::class, 'index'])->middleware('guest');

//Show the register form
Route::get('/register/{userType}', [userController::class, 'create'])->name('register.create')->middleware('guest');

//Store Created users Data
Route::post('/users', [userController::class, 'store']);

// -------------------------------------------------------------------------------------- //
// -------------------------------------- LOGIN/LOGOUT ---------------------------------- //
// -------------------------------------------------------------------------------------- //

// Log User Out
Route::post('/logout', [userController::class, 'logout']);

// Show Login Form
Route::get('/login', [userController::class, 'login'])->name('login')->middleware('guest');

// Log in User
Route::post('/login/authenticate', [userController::class, 'authenticate']);

// -------------------------------------------------------------------------------------- //
// ---------------------------------- EMPLOYER ROUTES ----------------------------------- //
// -------------------------------------------------------------------------------------- //
// Authorised Logged in - Employer
Route::middleware('auth:employer')->group(function () {

    // -------------------------------------------------------------------------------------- //
    // ------------------------------------- DASHBOARD -------------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show dashboard for logged-in employer
    Route::get('/employer/dashboard/{id}', [EmployerContoller::class, 'dashboard'])->name('employer.dashboard')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ------------------------------------ ALL-JOBS PAGE ----------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show all-jobs for logged-in employer
    Route::get('/employer/jobs/all-jobs', [EmployerContoller::class, 'all_jobs'])->name('employer.all_jobs')->middleware('auth');

    // Search All Jobs Fitler
    Route::get('/employer/jobs/all-jobs/search', [JobController::class, 'search_all_jobs'])->name('employer.search_all_jobs')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ----------------------------------- ACTIVE-JOBS PAGE --------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show active-jobs for logged-in employer
    Route::get('/employer/jobs/active-jobs', [EmployerContoller::class, 'active_jobs'])->name('employer.active_jobs')->middleware('auth');

    // Search Active Jobs Fitler
    Route::get('/employer/jobs/active-jobs/search', [JobController::class, 'search_active_jobs'])->name('employer.search_active_jobs')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ---------------------------------- COMPLETED-JOBS PAGE ------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Search completed-jobs for logged-in employer
    Route::get('/employer/jobs/completed-jobs', [EmployerContoller::class, 'completed_jobs'])->name('employer.completed_jobs')->middleware('auth');

    // Search Completed Jobs Fitler
    Route::get('/employer/jobs/completed-jobs/search', [JobController::class, 'search_completed_jobs'])->name('employer.search_completed_jobs')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // --------------------------------------- CREATE JOB ----------------------------------- //
    // -------------------------------------------------------------------------------------- //
    //Show Create Job Form page
    Route::get('/employer/jobs/create', [JobController::class, 'create_job'])->middleware('auth');

    //Store Created Job Data
    Route::post('/employer/jobs/store-job-data', [JobController::class, 'store_job']);

    // -------------------------------------------------------------------------------------- //
    // ------------------------------------- EDIT/DELETE JOB -------------------------------- //
    // -------------------------------------------------------------------------------------- //
    //Show Edit Job Form page
    Route::get('/employer/jobs/{job}/edit', [JobController::class, 'edit_job'])->name('employer.edit_job')->middleware('auth');

    //Store Edited Job Data
    Route::put('/employer/jobs/{job}/edit/store', [JobController::class, 'store_edited_job']);

    ///Delete Job Data
    Route::delete('/employer/jobs/{job}/delete', [JobController::class, 'delete_job']);

    // -------------------------------------------------------------------------------------- //
    // ----------------------------------- SPECIFIC JOB DETAILS ----------------------------- //
    // -------------------------------------------------------------------------------------- //
    //Show Specific Job details for Logged in Employer
    Route::get('/employer/jobs/{job}', [JobController::class, 'show_logged_in'])->name('employer.show_logged_in')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ---------------------------------------- JOB PROGRESS -------------------------------- //
    // -------------------------------------------------------------------------------------- //
    //Show Specific Job Progress details for Logged in Employer
    Route::get('/employer/jobs/{job}/progress', [JobController::class, 'show_job_progress'])->name('employer.show_job_progress')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ------------------------------------------ APPLICANTS -------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show Specialist Applications for a certain job
    Route::get('/employer/jobs/{job}/applicants', [JobController::class, 'show_job_applicants'])->name('employer.show_job_applicants')->middleware('auth');

    // Show the detailed view of the applications when clicked the button
    Route::get('/employer/jobs/{job}/applicants/{applicant_id}', [JobController::class, 'show_detailed_applicant'])->name('employer.show_detailed_applicant')->middleware('auth');

    // Store updated trainar application status
    Route::put('/employer/jobs/{job_id}/applicants/{trainer_id}/{applicant_action}', [JobController::class, 'update_applicant_status'])->name('employer.update_applicant_status');

    // -------------------------------------------------------------------------------------- //
    // -------------------------------- OFFER JOB TO SPECIALIST ----------------------------- //
    // -------------------------------------------------------------------------------------- //

    // Store offered job details
    Route::post('/employer/jobs/offer', [EmployerContoller::class, 'offer_job'])->name('employer.offer_job');

    // -------------------------------------------------------------------------------------- //
    // ----------------------------------- REMOVE SPECIALIST -------------------------------- //
    // -------------------------------------------------------------------------------------- //

    // Remove Trainer from current job
    Route::put('/employer/jobs/{job_id}/remove-trainer/{trainer_id}', [JobController::class, 'remove_trainer'])->name('employer.remove_trainer');

    // -------------------------------------------------------------------------------------- //
    // ----------------------------------- UPDATE JOB STATUS -------------------------------- //
    // -------------------------------------------------------------------------------------- //

    // Store updated job status
    Route::post('/employer/jobs/{job_id}/update-job-status/{trainer_id}', [JobController::class, 'update_job_status'])->name('employer.update_job_status');

    // -------------------------------------------------------------------------------------- //
    // -------------------------------------------- PAYMENT --------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show payment page
    Route::get('/employer/jobs/{job_id}/{rate}/payment', [EmployerContoller::class, 'show_payment_page'])->name('employer.show_payment_page')->middleware('auth');

    // Update payment intent amount
    Route::post('/employer/jobs/payment/{job_id}/{rate}/update_payment', [EmployerContoller::class, 'update_payment'])->name('employer.update_payment');

    // Show success payment page
    Route::get('/employer/jobs/{job_id}/{rate}/payment/success', function ($job_id, $rate) {
        // Update the specific column in the trainer_applications table based on the provided parameters
        DB::table('jobs')
            ->where('id', $job_id)
            ->update(['status' => 'Need to be reviewed']);

        return view('payments.success-page');
    })->name('employer.show_success_page')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // --------------------------------------------- REVIEW --------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show review form page
    Route::get('/employer/jobs/{job_id}/review', [EmployerContoller::class, 'show_review_page'])->name('employer.show_review_page')->middleware('auth');

    //Store review
    Route::post('/employer/jobs/{job_id}/review/store', [JobController::class, 'store_review'])->name('employer.store_review');

    // -------------------------------------------------------------------------------------- //
    // ---------------------------------------- DOWNLOAD ATTACHMENT ------------------------- //
    // -------------------------------------------------------------------------------------- //
    //Download attachment
    Route::get('/employer/jobs/{job_id}/download', function ($job_id) {
        $attachment = request()->query('attachment');

        // Check if the file exists in the public disk
        if (Storage::disk('public')->exists($attachment)) {
            // If the file exists, download it
            return Storage::disk('public')->download($attachment);
        } else {
            // Handle file not found error
            abort(404);
        }
    })->name('employers.download');

    // -------------------------------------------------------------------------------------- //
    // -------------------------------------------- SETTINGS -------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show settings page
    Route::get('/employer/settings/{employer_id}', [EmployerContoller::class, 'show_settings_page'])->name('employer.show_settings_page')->middleware('auth');

    // Store updated settings
    Route::put('/employer/settings/{employer}', [EmployerContoller::class, 'update_employer_settings'])->name('employer.update_employer_settings')->middleware('auth');
});

// -------------------------------------------------------------------------------------- //
// ----------------------------------- TRAINER ROUTES ----------------------------------- //
// -------------------------------------------------------------------------------------- //
// Show dashboard for logged-in trainer (trainer/dashboard.blade.php)
Route::middleware('auth:trainer')->group(function () {
    Route::get('/trainer/dashboard/{id}', [TrainerController::class, 'dashboard'])->name('trainer.dashboard')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ----------------------------------- ACTIVE-JOBS PAGE --------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show active-jobs for logged-in trainer
    Route::get('/trainer/jobs/active-jobs', [TrainerController::class, 'active_jobs'])->name('trainer.active_jobs')->middleware('auth');

    // Search Active Jobs Fitler
    Route::get('/trainer/jobs/active-jobs/search', [JobController::class, 'search_active_jobs_for_trainer'])->name('trainer.search_active_jobs')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ---------------------------------------- JOB PROGRESS -------------------------------- //
    // -------------------------------------------------------------------------------------- //
    //Show Specific Job Progress details for Logged in trainer
    Route::get('/trainer/jobs/{job}/progress', [JobController::class, 'show_job_progress_for_trainer'])->name('trainer.show_job_progress_for_trainer')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ---------------------------------- COMPLETED-JOBS PAGE ------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Search completed-jobs for logged-in employer
    Route::get('/trainer/jobs/completed-jobs', [TrainerController::class, 'completed_jobs'])->name('trainer.completed_jobs')->middleware('auth');

    // Search Completed Jobs Fitler
    Route::get('/trainer/jobs/completed-jobs/search', [JobController::class, 'search_completed_jobs_for_trainer'])->name('trainer.search_completed_jobs_for_trainer')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // ---------------------------------- JOB-APPLICATIONS PAGE ------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Search completed-jobs for logged-in employer
    Route::get('/trainer/jobs/job-applications', [TrainerController::class, 'show_applications'])->name('trainer.show_applications')->middleware('auth');

    // Search Completed Jobs Fitler
    Route::get('/trainer/jobs/job-applications/search', [JobController::class, 'search_applications_for_trainer'])->name('trainer.search_applications_for_trainer')->middleware('auth');

    // Apply job
    Route::post('/trainer/jobs/job-applications/{job}/apply', [TrainerController::class, 'apply_job'])->name('trainer.apply_job')->middleware('auth');

    // Withdraw application
    Route::delete('/trainer/jobs/job-applications/{application}/withdraw', [TrainerController::class, 'withdraw_application'])->name('trainer.withdraw_application')->middleware('auth');

    // Accept job application
    Route::put('/trainer/jobs/job-applications/{application}/accept', [TrainerController::class, 'accept_application'])->name('trainer.accept_application')->middleware('auth');

    // Reject job application
    Route::put('/trainer/jobs/job-applications/{application}/reject', [TrainerController::class, 'reject_application'])->name('trainer.reject_application')->middleware('auth');

    // -------------------------------------------------------------------------------------- //
    // -------------------------------------------- SETTINGS -------------------------------- //
    // -------------------------------------------------------------------------------------- //
    // Show settings page
    Route::get('/trainer/settings/{trainer_id}', [TrainerController::class, 'show_settings_page'])->name('trainer.show_settings_page')->middleware('auth');

    // Store updated settings
    Route::put('/trainer/settings/{trainer}', [TrainerController::class, 'update_trainer_settings'])->name('trainer.update_trainer_settings')->middleware('auth');
});





//Show All Trainers at find-candidate page (find-trainers/index.blade.php)
Route::get('/find-candidate', [TrainerController::class, 'index']);

//Show Specific Job at find-job overview page (find-trainers/show.blade.php)
Route::get('/find-candidate/{id}', [TrainerController::class, 'show']);




//Show All Jobs at find-job page 
Route::get('/find-job', [JobController::class, 'index']);

//Show Specific Job at find-job overview page
Route::get('/find-job/{job_id}', [JobController::class, 'show']);
