<?php

namespace App\Http\Controllers;

use App\Models\Trainer; //Trainer Model
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    // Show all trainers
    public function index()
    {
        return view('find-trainers.index', [ //folderName.fileName

            //latest get the latest data first
            //filter according to the requested tag
            //get the data
            'trainers' => Trainer::latest()->filter(request(['keywords', 'category', 'state', 'rate', 'level']))->get()
        ]);
    }

    //Show single job
    public function show(Trainer $id)
    {
        return view('find-trainers.show', [
            'trainer' => $id
        ]); //view('nama file', [apa yang kita nak passkan kat file tu])
    }
}
