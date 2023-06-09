<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Job;
use Stripe\Product;
use Stripe\SetupIntent;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;
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
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'jobs.rate', 'trainers.image', 'trainers.name', 'jobs.status')
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
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'jobs.rate', 'trainers.image', 'trainers.name', 'jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('trainers', 'active_jobs.trainer_id', '=', 'trainers.id')
            ->where('active_jobs.employer_id', $userId)
            ->whereNotIn('jobs.status', ['Need to be reviewed', 'Completed'])
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

    public function completed_jobs()
    {
        // Get the authorized user's ID using the "employer" guard
        $userId = Auth::guard('employer')->id();

        // Get the employer details
        $employer_details = DB::table('employers')
            ->where('id', $userId)
            ->first();

        $completed_jobs = DB::table('completed_jobs')
            ->select('completed_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'trainers.image', 'trainers.name', 'jobs.status')
            ->join('jobs', 'completed_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('trainers', 'completed_jobs.trainer_id', '=', 'trainers.id')
            ->where('completed_jobs.employer_id', $userId)
            ->whereNotIn('jobs.status', ['On going', 'Pending payment'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);

        return view('employers.completed-jobs', compact(
            'employer_details',
            'completed_jobs'
        ));
    }

    public function show_payment_page(Request $request, $job_id, $rate)
    {
        // dd(request()->query('paymentIntentId'));
        $job = Job::findOrFail($job_id);
        $user = auth()->user();

        $paymentIntentId = request()->query('paymentIntentId') ?? null;
        $paymentIntent = $this->getPaymentIntent($rate, $paymentIntentId);

        $clientSecret = $paymentIntent->client_secret;
        $paymentIntentId = $paymentIntent->id;
        $paymentAmount = $paymentIntent->amount;

        return view('payments.show-payment-page', compact('user', 'clientSecret', 'paymentIntentId', 'paymentAmount', 'job'));
    }

    public function show_review_page($job_id)
    {

        return view('employers.show-review-page', compact('job_id'));
    }

    public function update_payment(Request $request, $job_id, $rate)
    {
        // Get the employer email
        $employer_email = DB::table('jobs')
            ->select('employers.email AS email')
            ->join('employers', 'jobs.employer_id', '=', 'employers.id')
            ->where('jobs.id', $job_id)
            ->first();

        $paymentIntentId = $request->input('paymentIntentId');

        $paymentIntent = $this->getPaymentIntent($rate, $paymentIntentId);

        if ($request->specialist_rate) {
            $paymentIntent->update($paymentIntent->id, [
                'amount' => $request->specialist_rate * 100, // Amount in cents
                "receipt_email" => $employer_email,
            ]);

            $paymentIntentId = $paymentIntent->id;

            return redirect()->route('employer.show_payment_page', ['job_id' => $job_id, 'rate' => $rate, 'paymentIntentId' => $paymentIntentId])->with('success-message', 'Amount successfully updated!');
        }
    }

    private function getPaymentIntent($rate, $paymentIntentId = null)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        if ($paymentIntentId) {
            return PaymentIntent::retrieve($paymentIntentId);
        }

        if ($paymentIntentId === null) {
            return PaymentIntent::create([
                'amount' => $rate * 100, // Amount in cents
                'currency' => 'myr',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
        }
    }
}
