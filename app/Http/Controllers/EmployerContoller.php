<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer; //Employer model

class EmployerContoller extends Controller
{

    public function dashboard($employer_id)
    {
        // Get the employer details
        $employer_details = DB::table('employers')
            ->where('id', $employer_id)
            ->first();


        // Get the total number of jobs
        $totalJobs_counter = DB::table('jobs')
            ->where('employer_id', $employer_id)
            ->count();

        // Get the total number of active jobs
        $totalActiveJobs_counter = DB::table('jobs')
            ->where('employer_id', $employer_id)
            ->whereNotIn('status', ['Pending Payment', 'Completed'])
            ->count();

        // Get the total number of jobs that need to be reviewed
        $totalNeedReviewJobs_counter = DB::table('jobs')
            ->where('employer_id', $employer_id)
            ->whereNotIn('status', ['On going', 'Pending Payment', 'Completed'])
            ->count();

        // Get the total number of jobs pending payment
        $totalPendingPayment_counter = DB::table('jobs')
            ->where('employer_id', $employer_id)
            ->whereNotIn('status', ['On going', 'Need to be reviewed', 'Completed'])
            ->count();

        // Get the total number of completed jobs
        $totalCompletedJobs_counter = DB::table('jobs')
            ->where('employer_id', $employer_id)
            ->whereNotIn('status', ['On going', 'Need to be reviewed', 'Pending Payment'])
            ->count();


        $active_jobs = DB::table('active_jobs')
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'trainers.image', 'trainers.name', 'jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('trainers', 'active_jobs.trainer_id', '=', 'trainers.id')
            ->where('active_jobs.employer_id', $employer_id)
            ->whereNotIn('jobs.status', ['Pending Payment', 'Completed'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);


        $pendingPayment_jobs = DB::table('active_jobs')
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'trainers.image', 'trainers.name', 'jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('trainers', 'active_jobs.trainer_id', '=', 'trainers.id')
            ->where('active_jobs.employer_id', $employer_id)
            ->whereNotIn('jobs.status', ['On going', 'Need to be reviewed', 'Completed'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);


        // dd($active_jobs);

        return view('employers.dashboard', compact(
            'employer_details',
            'active_jobs',
            'pendingPayment_jobs',
            'totalActiveJobs_counter',
            'totalNeedReviewJobs_counter',
            'totalPendingPayment_counter',
            'totalCompletedJobs_counter',
            'totalJobs_counter'
        ));
    }

    public function all_jobs(Request $request)
    {
        // Get the authorized user's ID using the "employer" guard
        $userId = Auth::guard('employer')->id();

        // Get the employer details
        $employer_details = DB::table('employers')
            ->where('id', $userId)
            ->first();

        $jobs = DB::table('jobs')
            ->select('jobs.id', 'jobs.title', 'jobs.category', 'jobs.created_at', 'jobs.updated_at')
            ->where('jobs.employer_id', '=', $userId)
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);

        return view('employers.all-jobs', compact(
            'employer_details',
            'jobs'
        ));
    }

    public function active_jobs(Request $request)
    {
        // Get the authorized user's ID using the "employer" guard
        $userId = Auth::guard('employer')->id();

        // Get the employer details
        $employer_details = DB::table('employers')
            ->where('id', $userId)
            ->first();

        $active_jobs = DB::table('active_jobs')
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'trainers.image', 'trainers.name', 'jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('trainers', 'active_jobs.trainer_id', '=', 'trainers.id')
            ->where('active_jobs.employer_id', $userId)
            ->whereNotIn('jobs.status', ['Completed'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);

        foreach ($active_jobs as $active_job) {

            $applicant_counter = DB::table('trainer_applications')
                ->where('trainer_applications.employer_id', $userId)
                ->where('trainer_applications.job_id', $active_job->job_id)
                ->where('trainer_applications.application_status', 'Applied')
                ->count();

            $active_job->applicant_counter = $applicant_counter;
        }

        return view('employers.active-jobs', compact(
            'employer_details',
            'active_jobs'
        ));
    }
}
