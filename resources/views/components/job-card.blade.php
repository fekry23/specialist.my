@props(['job'])
{{-- In Laravel, "props" (short for "properties") typically 
refer to the data that is passed from a parent component to a 
child component. --}}

<!-- START OVERVIEW -->
<div class="display-overview">
    <!-- Button, need to be modified using PHP in the future -->
    <button id="overview-button" onclick="window.location.href='/find-job/{{ $job->id }}'">
        <div class="display-overview-title">
            <div class="name-state">
                <h3 id="overview-title">{{ $job->title }}</h3>

                <h4 id="overview-state">{{ $job->state }}</h4>
            </div>
        </div>

        <!-- Filter Display, need to be modified using PHP in the future -->
        <div class="display-filter">
            <p>{{ $job->category }}</p>
            <p>|</p>
            <p>{{ $job->type }}</p>
            <p>|</p>
            <p>{{ $job->exp_level }} Level</p>
            <p>|</p>
            <p>{{ $job->created_at->diffForHumans() }}</p> {{-- diffForHumans() from carbon (https://github.com/briannesbitt/Carbon) --}}
        </div>
        <!-- Filter Display, need to be modified using PHP in the future -->

        <div class="display-overview-parapgraph">
            <!-- Description, need to be modified using PHP in the future -->
            <p>{{ $job->description }}</p>
            <!-- Description, need to be modified using PHP in the future -->
        </div>


        <div class="display-skills">
            <x-job-tags :tagsCsv="$job->skills" />
        </div>
    </button>
</div>
<!-- END OVERVIEW -->
