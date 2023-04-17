<?php

namespace App\Http\Controllers;

use App\Models\Job; //Job Model
use Illuminate\Http\Request;

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
}
