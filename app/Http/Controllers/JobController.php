<?php

namespace App\Http\Controllers;

use App\Models\completedJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Job; //Job Model
use App\Models\TrainerApplication;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // Show all jobs
    public function index()
    {
        $jobs = Job::where('trainer_id', null)
            ->latest()
            ->filter(request(['keywords', 'skills', 'category', 'state', 'type', 'experience', 'history', 'length']))
            ->paginate(10)
            ->withQueryString();

        return view('find-jobs.index', compact('jobs'));
    }


    //Show Specific Job at find-job overview page
    public function show(Job $job_id)
    {
        // Get the employer details
        $employer = DB::table('employers')
            ->where('id', $job_id->employer_id)
            ->first();

        // Get the total number of jobs
        $totalJobs_counter = DB::table('jobs')
            ->where('employer_id', $job_id->employer_id)
            ->count();

        return view('find-jobs.show', [
            'job' => $job_id,
            'employer' => $employer,
            'totalJobs_counter' => $totalJobs_counter
        ]);
    }

    //Show Specific Job details for Logged in Employer
    public function show_logged_in(Job $job)
    {
        // Get the employer details
        $employer = DB::table('employers')
            ->where('id', $job->employer_id)
            ->first();

        // Get the total number of jobs
        $totalJobs_counter = DB::table('jobs')
            ->where('employer_id', $job->employer_id)
            ->count();

        return view('employers.show-jobs', [
            'job' => $job,
            'employer' => $employer,
            'totalJobs_counter' => $totalJobs_counter
        ]);
    }

    // Show Specific Job Progress details for Logged in Employer
    public function show_job_progress(Job $job)
    {
        // dd($job);
        // Get the employer details
        $employer = DB::table('employers')
            ->where('id', $job->employer_id)
            ->first();

        // Get the trainer details
        $trainer = DB::table('trainers')
            ->where('id', $job->trainer_id)
            ->first();

        $job_status = DB::table('job_status_tracker')
            ->select(
                'job_status_tracker.job_id',
                'jobs.title',
                'jobs.trainer_id',
                'jobs.status AS status_from_jobs_table',
                'job_status_tracker.status AS status_from_status_tracker_table',
                'job_status_tracker.description',
                'job_status_tracker.updated_at AS updated_at_from_status_tracker_table',
                'completed_jobs.attachment_path'
            )
            ->join('jobs', 'job_status_tracker.job_id', '=', 'jobs.id')
            ->leftJoin('completed_jobs', 'jobs.id', '=', 'completed_jobs.job_id')
            ->where('job_status_tracker.job_id', $job->id)
            ->where('jobs.trainer_id', $job->trainer_id)
            ->orderBy('job_status_tracker.updated_at', 'desc')
            ->get();

        $applicant_counter = DB::table('trainer_applications')
            ->where('trainer_applications.employer_id', $job->employer_id)
            ->count();

        // Format the updated_at date using Carbon
        foreach ($job_status as $status) {
            $status->formatted_updated_at = Carbon::parse($status->updated_at_from_status_tracker_table)->format('d F Y');
        }

        $finishTime = Carbon::now('Asia/Kuala_Lumpur'); // Format as 'hours:minutes:seconds'

        return view('employers.show-jobs-progress', compact(
            'job',
            'employer',
            'trainer',
            'job_status',
            'applicant_counter',
            'finishTime'
        ));
    }

    public function show_job_applicants(Job $job, Request $request)
    {
        $applications = DB::table('trainer_applications')
            ->select(
                'trainer_applications.id',
                'trainer_applications.trainer_id',
                'trainer_applications.job_id',
                'trainer_applications.employer_id',
                'trainer_applications.description',
                'trainer_applications.created_at AS applied_time',
                'trainers.name',
                'trainers.email',
                'trainers.image',
                'trainers.hourly_rate AS rates'
            )
            ->leftJoin('trainers', 'trainers.id', '=', 'trainer_applications.trainer_id')
            ->where('trainer_applications.job_id', $job->id)
            ->where('trainer_applications.application_status', 'Applied')
            ->orderBy('trainer_applications.created_at', 'asc')
            ->paginate(10);

        return view('employers.show-jobs-applicants', compact('job', 'applications'));
    }

    public function show_detailed_applicant(Job $job, TrainerApplication $applicant_id)
    {
        // dd($applicant);
        $applications = DB::table('trainer_applications')
            ->select(
                'trainer_applications.id',
                'trainer_applications.trainer_id',
                'trainer_applications.job_id',
                'trainer_applications.employer_id',
                'trainer_applications.description',
                'trainer_applications.created_at AS applied_time',
                'trainers.name',
                'trainers.email',
                'trainers.image',
                'trainers.hourly_rate AS rates'
            )
            ->leftJoin('trainers', 'trainers.id', '=', 'trainer_applications.trainer_id')
            ->where('trainer_applications.job_id', $job->id)
            ->where('trainer_applications.application_status', 'Applied')
            ->orderBy('trainer_applications.created_at', 'asc')
            ->paginate(10);

        $selected_applicant = DB::table('trainer_applications')
            ->select(
                'trainer_applications.id',
                'trainer_applications.trainer_id',
                'trainer_applications.job_id',
                'trainer_applications.employer_id',
                'trainer_applications.description',
                'trainer_applications.created_at AS applied_time',
                'trainers.name',
                'trainers.email',
                'trainers.image',
                'trainers.hourly_rate AS rates'
            )
            ->leftJoin('trainers', 'trainers.id', '=', 'trainer_applications.trainer_id')
            ->where('trainer_applications.id', $applicant_id->id)
            ->where('trainer_applications.application_status', 'Applied')
            ->orderBy('trainer_applications.created_at', 'asc')
            ->first();

        $selected_applicant_count = DB::table('trainer_applications')
            ->where('trainer_applications.job_id', $job->id)
            ->where('trainer_applications.application_status', 'Applied')
            ->count();


        return view('employers.show-jobs-applicants', compact(
            'job',
            'applications',
            'selected_applicant',
            'selected_applicant_count'
        ));
    }


    // Show create form
    public function create_job()
    {
        return view('employers.create-job');
    }

    // Store job data
    public function store_job(Request $request)
    {
        // dd($request);
        $allowedStates = [
            'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan', 'Melaka', 'Negeri Sembilan', 'Pahang', 'Penang',
            'Perak', 'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'Others'
        ];
        $allowedCategory = [
            "Accounting & Consulting", "Admin Support", "Customer Service", "Data Science & Analytics",
            "Design & Creative", "Engineering & Architecture", "IT & Networking", "Legal", "Sales & Marketing", "Translation",
            "Web/Mobile & Software Dev", "Writing", "Others"
        ];
        $allowedType = ['Hourly', 'Fixed-Price'];
        $allowedExperience = ['Entry', 'Intermediate', 'Expert'];
        $allowedLength = ['Less than one month', '1 to 3 months', '3 to 6 months', 'More than 6 months'];

        //Validate is for what rule we want for certain file.
        //https://laravel.com/docs/10.x/validation
        $formFields = $request->validate([
            'title' => 'required',
            'state' => ['required', Rule::in($allowedStates)],
            'description' => 'required',
            'category' => ['required', Rule::in($allowedCategory)],
            'type' => ['required', Rule::in($allowedType)],
            'rate' => 'required',
            'exp_level' => ['required', Rule::in($allowedExperience)],
            'project_length' => ['required', Rule::in($allowedLength)],
            'skills' => 'required',
        ]);

        $formFields['employer_id'] = Auth::guard('employer')->id(); // Add employer_id to the form fields

        Job::create($formFields);

        // redirects the user to the specified URL
        return redirect('/employer/jobs/all-jobs')->with('success-message', 'Created job successfully!');
    }

    //Show Edit Job Form page
    public function edit_job(Job $job)
    {
        return view('employers.edit-job', ['job' => $job]);
    }

    // Store edited job data
    public function store_edited_job(Request $request, Job $job)
    {
        // dd($request);
        $allowedStates = [
            'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan', 'Melaka', 'Negeri Sembilan', 'Pahang', 'Penang',
            'Perak', 'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'Others'
        ];
        $allowedCategory = [
            "Accounting & Consulting", "Admin Support", "Customer Service", "Data Science & Analytics",
            "Design & Creative", "Engineering & Architecture", "IT & Networking", "Legal", "Sales & Marketing", "Translation",
            "Web/Mobile & Software Dev", "Writing", "Others"
        ];
        $allowedType = ['Hourly', 'Fixed-Price'];
        $allowedExperience = ['Entry', 'Intermediate', 'Expert'];
        $allowedLength = ['Less than one month', '1 to 3 months', '3 to 6 months', 'More than 6 months'];

        //Validate is for what rule we want for certain file.
        //https://laravel.com/docs/10.x/validation
        $formFields = $request->validate([
            'title' => 'required',
            'state' => ['required', Rule::in($allowedStates)],
            'description' => 'required',
            'category' => ['required', Rule::in($allowedCategory)],
            'type' => ['required', Rule::in($allowedType)],
            'rate' => 'required',
            'exp_level' => ['required', Rule::in($allowedExperience)],
            'project_length' => ['required', Rule::in($allowedLength)],
            'skills' => 'required',
        ]);

        $job->update($formFields);

        // redirects the user to the specified URL
        return back()->with('success-message', 'Job updated successfully!');
    }

    public function update_applicant_status($job_id, $trainer_id, $applicant_action)
    {
        // Modify the value of $applicant_action if needed
        if ($applicant_action === 'Reject') {
            $applicant_action = 'Rejected';
        } elseif ($applicant_action === 'Accept') {
            $applicant_action = 'Accepted';
            $opp = 'Rejected';
        }

        // Update the specific column in the trainer_applications table based on the provided parameters
        DB::table('trainer_applications')
            ->where('job_id', $job_id)
            ->where('trainer_id', $trainer_id)
            ->update(['application_status' => $applicant_action]);

        // Update the specific column in the trainer_applications table based on the provided parameters
        if (!empty($opp)) {
            DB::table('trainer_applications')
                ->where('job_id', $job_id)
                ->where('application_status', 'Applied')
                ->whereNotIn('trainer_id', [$trainer_id])
                ->update(['application_status' => $opp]);
        }



        // Redirect or perform any other actions as needed
        return back()->with('success-message', "Specialist successfully {$applicant_action}!");
    }

    public function remove_trainer($job_id, $trainer_id)
    {

        DB::table('jobs')
            ->where('id', $job_id)
            ->where('trainer_id', $trainer_id)
            ->update(['trainer_id' => null]);

        return back()->with('success-message', "Specialist successfully removed!");
    }

    public function update_job_status(Request $request, $job_id, $trainer_id)
    {
        // Validate the form fields
        $formFields = $request->validate([
            'description' => 'required',
        ]);

        // Handle the file upload (if applicable)
        if ($request->hasFile('completed_attachment')) {
            $attachment = $request->file('completed_attachment');

            // Check if the file size exceeds the limit of 8MB
            if ($attachment->getSize() > 8000000) {
                return back()->with('error-message', 'File size exceeds the limit of 8MB');
            }

            // Define the allowed file formats
            $allowedFormats = ['png', 'jpg', 'docx'];
            // Get the file format of the uploaded file
            $fileFormat = strtolower($attachment->getClientOriginalExtension());

            // Check if the file format is not in the allowed formats
            if (!in_array($fileFormat, $allowedFormats)) {
                return back()->with('error-message', 'Invalid file format. Allowed formats: PNG, JPG, DOCX');
            }

            // Store the file inside public/storage/app/public/completed_attachments
            $attachmentPath = $attachment->store('completed_attachments', 'public');
        } else {
            $attachmentPath = null;
        }

        // Create a new instance of the 'completedJob' model
        $completedJob = new completedJob();
        $completedJob->employer_id = $request->employer_id;
        $completedJob->job_id = $job_id;
        $completedJob->trainer_id = $trainer_id;
        $completedJob->description = $formFields['description'];
        $completedJob->finish_time = Carbon::now('Asia/Kuala_Lumpur');
        $completedJob->attachment_path = $attachmentPath;

        // Save the completed job to the database
        $completedJob->save();

        return back()->with('success-message', 'Job successfully updated!');
    }



    //Delete Job Data
    public function delete_job(Job $job)
    {
        $job->delete();
        return redirect('/employer/jobs/all-jobs')->with('success-message', 'Job deleted successfully');
    }

    public function search_all_jobs(Request $request)
    {
        $searchTerm = $request->input('keywords');
        // Get the authorized user's ID using the "employer" guard
        $userId = Auth::guard('employer')->id();

        // Get the employer details
        $employer_details = DB::table('employers')
            ->where('id', $userId)
            ->first();

        $jobs = Job::latest()
            ->filter(['keywords' => $searchTerm])
            ->where('employer_id', $userId) // Add a condition to filter by user ID
            ->paginate(10);

        return view('employers.all-jobs', compact(
            'employer_details',
            'jobs'
        ));
    }

    public function search_active_jobs(Request $request)
    {
        $searchTerm = $request->input('keywords');
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
            ->where(function ($query) use ($searchTerm) {
                $query->where('jobs.title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jobs.description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jobs.skills', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jobs.category', 'like', '%' . $searchTerm . '%');
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('jobs.status', $request->status);
            })
            ->orderBy('jobs.id', 'asc')
            ->paginate(10);



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
