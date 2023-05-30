<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Trainer; //Trainer Model

class TrainerController extends Controller
{
    // Show all trainers
    public function index()
    {
        return view('find-trainers.index', [ //folderName.fileName

            //latest get the latest data first
            //filter according to the requested tag
            //get the data
            'trainers' => Trainer::latest()->filter(request(['keywords', 'category', 'state', 'rate', 'level']))->paginate(10)
        ]);
    }

    //Show single job
    public function show(Trainer $id)
    {
        return view('find-trainers.show', [
            'trainer' => $id
        ]); //view('nama file', [apa yang kita nak passkan kat file tu])
    }

    public function dashboard($trainer_id)
    {
        // Get the trainer details
        $trainer_details = DB::table('trainers')
            ->where('id', $trainer_id)
            ->first();


        // Get the total number of jobs
        $totalJobs_counter = DB::table('jobs')
            ->where('trainer_id', $trainer_id)
            ->count();

        // Get the total number of active jobs
        $totalActiveJobs_counter = DB::table('active_jobs')
            ->where('trainer_id', $trainer_id)
            ->whereNotIn('status', ['Pending Payment', 'Completed'])
            ->count();

        // Get the total number of jobs that need to be reviewed
        $totalNeedReviewJobs_counter = DB::table('active_jobs')
            ->where('trainer_id', $trainer_id)
            ->whereNotIn('status', ['On going', 'Pending Payment', 'Completed'])
            ->count();

        // Get the total number of jobs pending payment
        $totalPendingPayment_counter = DB::table('active_jobs')
            ->where('trainer_id', $trainer_id)
            ->whereNotIn('status', ['On going', 'Need to be reviewed', 'Completed'])
            ->count();

        // Get the total number of completed jobs
        $totalCompletedJobs_counter = DB::table('active_jobs')
            ->where('trainer_id', $trainer_id)
            ->whereNotIn('status', ['On going', 'Need to be reviewed', 'Pending Payment'])
            ->count();


        $active_jobs = DB::table('active_jobs')
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'trainers.image', 'trainers.name', 'active_jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->join('trainers', 'active_jobs.trainer_id', '=', 'trainers.id')
            ->where('active_jobs.trainer_id', '=', $trainer_id)
            ->whereNotIn('status', ['Pending Payment', 'Completed'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);

        $pendingPayment_jobs = DB::table('active_jobs')
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'trainers.image', 'trainers.name', 'active_jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->join('trainers', 'active_jobs.trainer_id', '=', 'trainers.id')
            ->where('active_jobs.trainer_id', '=', $trainer_id)
            ->whereNotIn('status', ['On going', 'Need to be reviewed', 'Completed'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);

        // dd($active_jobs);

        return view('find-jobs.index_trainer_dashboard', [
            'trainer_details' => $trainer_details,
            'active_jobs' => $active_jobs,
            'pendingPayment_jobs' => $pendingPayment_jobs,
            'totalActiveJobs_counter' => $totalActiveJobs_counter,
            'totalNeedReviewJobs_counter' => $totalNeedReviewJobs_counter,
            'totalPendingPayment_counter' => $totalPendingPayment_counter,
            'totalCompletedJobs_counter' => $totalCompletedJobs_counter,
            'totalJobs_counter' => $totalJobs_counter
        ]);
    }
}
