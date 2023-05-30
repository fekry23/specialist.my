<?php

namespace App\Observers;

use App\Models\activeJob;
use App\Models\completedJob;
use Illuminate\Support\Facades\DB;

class activeJobObserver
{
    /**
     * Handle the activeJob "created" event.
     */
    public function created(activeJob $activeJob): void
    {
        //
    }

    /**
     * Handle the activeJob "updated" event.
     */
    public function updated(activeJob $activeJob): void
    {

        $jobId = $activeJob->job_id;

        // Check if the completed job exists for the given job ID
        $completedJobExists = completedJob::where('job_id', $jobId)->exists();

        if ($activeJob->status === 'Completed' && $completedJobExists) {
            // Delete the active job
            $activeJob->delete();
        }
    }

    /**
     * Handle the activeJob "deleted" event.
     */
    public function deleted(activeJob $activeJob): void
    {
        //
    }

    /**
     * Handle the activeJob "restored" event.
     */
    public function restored(activeJob $activeJob): void
    {
        //
    }

    /**
     * Handle the activeJob "force deleted" event.
     */
    public function forceDeleted(activeJob $activeJob): void
    {
        //
    }
}
