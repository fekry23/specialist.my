<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainerController;
use App\Models\Job;
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

//Show All Trainers at find-candidate page (find-trainers/index.blade.php)
Route::get('/find-candidate', [TrainerController::class, 'index']);

//Show Specific Job at find-job overview page (find-trainers/show.blade.php)
Route::get('/find-candidate/{id}', [TrainerController::class, 'show']);

//Show All Jobs at find-job page (find-job/index.blade.php)
Route::get('/find-job', [JobController::class, 'index']);

//Show Specific Job at find-job overview page (find-job/show.blade.php)
Route::get('/find-job/{id}', [JobController::class, 'show']);

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
