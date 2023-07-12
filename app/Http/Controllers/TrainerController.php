<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\TrainerApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Trainer; //Trainer Model

class TrainerController extends Controller
{
    // Show all trainers
    public function index()
    {
        $trainers = Trainer::latest()->filter(request(['keywords', 'category', 'state', 'rate', 'level']))->paginate(10);

        // Get the total number of reviews for each trainer
        $trainerIds = $trainers->pluck('id');
        $reviewsCount = Review::whereIn('trainer_id', $trainerIds)
            ->select('trainer_id', DB::raw('count(*) as count'))
            ->groupBy('trainer_id')
            ->pluck('count', 'trainer_id');

        // Calculate the average review stars for each trainer
        $averageStars = Review::whereIn('trainer_id', $trainerIds)
            ->select('trainer_id', DB::raw('avg(rating_value) as average'))
            ->groupBy('trainer_id')
            ->pluck('average', 'trainer_id');

        return view('find-trainers.index', [
            'trainers' => $trainers,
            'reviewsCount' => $reviewsCount,
            'averageStars' => $averageStars,
        ]);
    }



    //Show single job
    public function show(Trainer $id)
    {
        $isEmployer = Auth::guard('employer')->check();

        if ($isEmployer) {
            // Get the authorized user's ID using the "employer" guard
            $userId = Auth::guard('employer')->id();
            // Get all the jobs
            $jobs = DB::table('jobs')
                ->select('*')
                ->where('jobs.employer_id', $userId)
                ->where('jobs.trainer_id', null)
                ->whereNotIn('status', ['Pending Payment', 'Need to be reviewed', 'Completed'])
                ->orderBy('jobs.created_at', 'desc') // Updated the orderBy clause
                ->get();
        } else {
            $jobs = []; // Empty array or null, depending on your preference
        }

        $reviews = DB::table('reviews')
            ->select(
                'reviews.title AS review_title',
                'reviews.description AS review_description',
                'reviews.rating_value',
                'employers.name AS employer_name',
                'employers.created_at',
            )
            ->join('employers', 'reviews.employer_id', '=', 'employers.id')
            ->where('reviews.trainer_id', $id->id)
            ->orderBy('employers.created_at', 'desc')
            ->take(8) // Limit the result to 8 reviews
            ->get();

        $reviews->transform(function ($item) {
            $item->created_at = Carbon::parse($item->created_at)->format('F Y');
            return $item;
        });

        // dd($trainer);


        return view('find-trainers.show', [
            'trainer' => $id,
            'reviews' => $reviews,
            'jobs' => $jobs,
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
        $totalActiveJobs_counter = DB::table('jobs')
            ->where('trainer_id', $trainer_id)
            ->whereNotIn('status', ['Pending Payment', 'Completed'])
            ->count();

        // Get the total number of jobs that need to be reviewed
        $totalNeedReviewJobs_counter = DB::table('jobs')
            ->where('trainer_id', $trainer_id)
            ->whereNotIn('status', ['On going', 'Pending Payment', 'Completed'])
            ->count();

        // Get the total number of jobs pending payment
        $totalPendingPayment_counter = DB::table('jobs')
            ->where('trainer_id', $trainer_id)
            ->whereNotIn('status', ['On going', 'Need to be reviewed', 'Completed'])
            ->count();

        // Get the total number of completed jobs
        $totalCompletedJobs_counter = DB::table('jobs')
            ->where('trainer_id', $trainer_id)
            ->whereNotIn('status', ['On going', 'Need to be reviewed', 'Pending Payment'])
            ->count();


        $active_jobs = DB::table('active_jobs')
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'jobs.rate', 'employers.profile_picture', 'employers.name', 'jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('employers', 'active_jobs.employer_id', '=', 'employers.id')
            ->where('active_jobs.trainer_id', '=', $trainer_id)
            ->whereNotIn('jobs.status', ['Pending payment', 'Completed'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);


        // dd($active_jobs);


        $pendingPayment_jobs = DB::table('active_jobs')
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'employers.profile_picture', 'employers.name', 'jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('employers', 'active_jobs.employer_id', '=', 'employers.id')
            ->where('active_jobs.trainer_id', '=', $trainer_id)
            ->whereNotIn('jobs.status', ['On going', 'Need to be reviewed', 'Completed'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);

        // dd($pendingPayment_jobs);


        return view('trainers.dashboard', [
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

    public function active_jobs(Request $request)
    {
        // Get the authorized user's ID using the "trainer" guard
        $userId = Auth::guard('trainer')->id();

        // Get the trainer details
        $trainer_details = DB::table('trainers')
            ->where('id', $userId)
            ->first();

        $active_jobs = DB::table('active_jobs')
            ->select('active_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'jobs.rate', 'employers.profile_picture', 'employers.name', 'jobs.status')
            ->join('jobs', 'active_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('employers', 'active_jobs.employer_id', '=', 'employers.id')
            ->where('active_jobs.trainer_id', $userId)
            ->whereNotIn('jobs.status', ['Need to be reviewed', 'Completed'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);

        return view('trainers.active-jobs', compact(
            'trainer_details',
            'active_jobs'
        ));
    }

    public function completed_jobs()
    {
        // Get the authorized user's ID using the "trainer" guard
        $userId = Auth::guard('trainer')->id();

        // Get the trainer details
        $trainer_details = DB::table('trainers')
            ->where('id', $userId)
            ->first();

        $completed_jobs = DB::table('completed_jobs')
            ->select('completed_jobs.id', 'jobs.id AS job_id', 'jobs.title', 'employers.profile_picture', 'employers.name', 'jobs.status')
            ->join('jobs', 'completed_jobs.job_id', '=', 'jobs.id')
            ->leftJoin('employers', 'completed_jobs.employer_id', '=', 'employers.id')
            ->where('completed_jobs.employer_id', $userId)
            ->whereNotIn('jobs.status', ['On going', 'Pending payment'])
            ->orderBy('jobs.id', 'asc')
            ->paginate(5);

        return view('trainers.completed-jobs', compact(
            'trainer_details',
            'completed_jobs'
        ));
    }

    public function show_applications()
    {
        // Get the authorized user's ID using the "trainer" guard
        $userId = Auth::guard('trainer')->id();

        // Get the trainer details
        $trainer = DB::table('trainers')
            ->where('id',  $userId)
            ->first();

        $applications = DB::table('trainer_applications')
            ->select(
                'trainer_applications.id',
                'trainer_applications.trainer_id',
                'trainer_applications.job_id',
                'trainer_applications.employer_id',
                'trainer_applications.description',
                'trainer_applications.application_status',
                'trainer_applications.created_at AS applied_time',
                'jobs.title AS job_title'
            )
            ->leftJoin('jobs', 'jobs.id', '=', 'trainer_applications.job_id')
            ->where('trainer_applications.trainer_id', $userId)
            ->orderBy('trainer_applications.created_at', 'asc')
            ->paginate(10);

        return view('trainers.job-applications', compact('trainer', 'applications'));
    }

    public function withdraw_application(TrainerApplication $application)
    {
        $application->delete();
        return redirect('/trainer/jobs/job-applications')->with('success-message', 'Application withdrawn successfully');
    }

    public function reject_application(TrainerApplication $application)
    {
        // Update the specific column in the trainer_applications table based on the provided parameters
        DB::table('trainer_applications')
            ->where('id', $application->id)
            ->where('job_id', $application->job_id)
            ->where('trainer_id', $application->trainer_id)
            ->update(['application_status' => "Rejected"]);

        return redirect('/trainer/jobs/job-applications')->with('success-message', 'Application rejected successfully');
    }

    public function accept_application(TrainerApplication $application)
    {
        // Update the specific column in the trainer_applications table based on the provided parameters
        DB::table('trainer_applications')
            ->where('job_id', $application->job_id)
            ->where('trainer_id', $application->trainer_id)
            ->update(['application_status' => "Accepted"]);

        return redirect('/trainer/jobs/job-applications')->with('success-message', 'Application accepted successfully');
    }

    public function apply_job(Request $request, Job $job)
    {
        // Get the authorized user's ID using the "trainer" guard
        $userId = Auth::guard('trainer')->id();

        // Check if the user has already applied for or accepted this job
        $existingApplication = TrainerApplication::where(function ($query) use ($userId, $job) {
            $query->where('trainer_id', $userId)
                ->where('job_id', $job->id)
                ->whereIn('application_status', ['Applied', 'Accepted']);
        })->first();

        if ($existingApplication) {
            // User has already applied for or accepted this job, handle accordingly (e.g., show an error message)
            return back()->with('error-message', 'You have already applied or accepted this job.');
        }

        // Create a new TrainerApplication instance
        $trainerApplication = new TrainerApplication();
        $trainerApplication->trainer_id = $userId;
        $trainerApplication->job_id = $job->id;
        $trainerApplication->employer_id = $job->employer_id;
        $trainerApplication->description = $request->description;
        $trainerApplication->application_status = "Applied";

        $trainerApplication->save(); // Save the new trainer application to the database

        return redirect('/trainer/jobs/job-applications')->with('success-message', 'Successfully applied!');
    }

    public function show_settings_page($trainer_id)
    {
        // Get the employer details
        $trainer_details = DB::table('trainers')
            ->where('id', $trainer_id)
            ->first();

        return view('trainers.show-settings', compact('trainer_details'));
    }

    public function update_trainer_settings(Request $request, Trainer $trainer)
    {
        $allowedStates = [
            'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan', 'Melaka', 'Negeri Sembilan', 'Pahang', 'Penang',
            'Perak', 'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'Others'
        ];

        $allowedCategory = [
            'Accounting & Consulting',
            'Admin Support',
            'Customer Service',
            'Data Science & Analytics',
            'Design & Creative',
            'Engineering & Architecture',
            'IT & Networking',
            'Legal',
            'Sales & Marketing',
            'Translation',
            'Web/Mobile & Software Dev',
            'Writing',
            'Others',
        ];

        $allowedEnglish = [
            'Basic',
            'Conversational',
            'Fluent',
            'Native or bilingual',
        ];

        // dd($request->all());
        //Validate is for what rule we want for certain file.
        //https://laravel.com/docs/10.x/validation
        $formFields = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:trainers,username,' . $trainer->id,
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:trainers,email,' . $trainer->id,
            ],
            'new-password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
            ],
            'name' => 'required|string|max:255',
            'state' => [
                Rule::in($allowedStates),
            ],
            'contact_no' => [
                'nullable',
                'regex:/^(\+?6?01)[0-9]{8}$/'
            ],
            'hourly_rate' => 'nullable|numeric',
            'category' => [
                'nullable',
                Rule::in($allowedCategory),
            ],
            'specialization_title' => 'nullable|string|max:100',
            'specialization_description' => 'nullable|string|max:255',
            'skills_expertise' => 'nullable|string|max:255',
            'english_level' => [
                'nullable',
                Rule::in($allowedEnglish),
            ]
        ], [
            'username.required' => 'Please enter your username.',
            'username.unique' => 'The username is already in use.',
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'new-password.min' => 'Your password must be at least 8 characters long.',
            'new-password.regex' => 'Your password must contain at least one lowercase letter, one uppercase letter, and one number.',
            'new-password.confirmed' => 'Please confirm your password.',
            'state.in' => 'Please select a valid state.',
            'contact_no.regex' => 'Please enter a valid Malaysia phone number.',
            'gender.in' => 'Please select a valid gender.',
            'hourly_rate.numeric' => 'Please enter a numeric value for hourly rate.',
            'category.in' => 'Please select a valid category.',
            'specialization_title.max' => 'Specialization title should not exceed 100 characters.',
            'specialization_description.max' => 'Specialization description should not exceed 255 characters.',
            'skills_expertise.max' => 'Skills and expertise should not exceed 255 characters.',
            'english_level.in' => 'Please select a valid English level.',
        ]);


        // Handle the file upload (if applicable)
        if ($request->hasFile('image')) {
            $attachment = $request->file('image');

            // Check if the file size exceeds the limit of 8MB
            if ($attachment->getSize() > 8000000) {
                return back()->with('error-message', 'File size exceeds the limit of 8MB');
            }

            // Define the allowed file formats
            $allowedFormats = ['png', 'jpg'];
            // Get the file format of the uploaded file
            $fileFormat = strtolower($attachment->getClientOriginalExtension());

            // Check if the file format is not in the allowed formats
            if (!in_array($fileFormat, $allowedFormats)) {
                return back()->with('error-message', 'Invalid file format. Allowed formats: PNG, JPG');
            }

            // Store the file inside public/storage/app/public/completed_attachments
            $formFields['image'] = $attachment->store('trainer_profile_images', 'public');
        }

        // dd($formFields['profile_picture']);
        $trainer->update($formFields);

        return back()->with('success-message', 'Settings updated successfully!');
    }
}
