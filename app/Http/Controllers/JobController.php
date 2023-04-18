<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job; //Job Model
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    // Show all jobs
    public function index()
    {
        return view('find-jobs.index', [ //folderName.fileName

            //latest get the latest data first
            //filter according to the requested tag
            //get the data
            'jobs' => Job::latest()->filter(request(['keywords', 'skills', 'category', 'state', 'type', 'experience', 'history', 'length']))->get()
        ]);
    }

    //Show single job
    public function show(Job $id)
    {
        return view('find-jobs.show', [
            'job' => $id
        ]); //view('nama file', [apa yang kita nak passkan kat file tu])
    }

    // Show create form
    public function create()
    {
        return view('find-jobs.create');
    }

    // Store job data
    public function store(Request $request)
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
            'experience' => ['required', Rule::in($allowedExperience)],
            'length' => ['required', Rule::in($allowedLength)],
            'skills' => 'required',
        ]);

        Job::create($formFields);

        // redirects the user to the specified URL
        return redirect('/find-job');
    }
}
