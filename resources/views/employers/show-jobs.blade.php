@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/employer-show-jobs.css') }}">
@endsection

@section('content')
    <!-- START OF VIEWING CANDIDATE DETAILED PROFILE -->
    <div class="job-container" id="job-container">
        <div class="job-profile">
            <button class="back-btn" onclick="window.location.href = '{{ route('employer.all_jobs') }}'">
                <i class="fas fa-arrow-left"></i>
                <span style="margin-left: 10%">Back</span>
            </button>

            <div class="header-profile">

                <!-- Title and State, need to be modified using PHP in the future -->
                <h1>{{ $job->title }}</h1>
                <h3>{{ $job->state }}</h3>
                <!-- Title and State, need to be modified using PHP in the future -->

            </div>

            <div class="hr"></div>

            <!-- Description, need to be modified using PHP in the future -->
            <div class="description-profile">
                <h3>Description</h3>
                <p style="margin-top: 1%;">{{ $job->description }}</p>
            </div>
            <!-- Description, need to be modified using PHP in the future -->

            <div class="hr"></div>

            <!-- Categories, need to be modified using PHP in the future -->
            <div class="category-profile">
                <h3>Category</h3>
                <button>
                    <span>{{ $job->category }}</span> </button>
            </div>
            <!-- Categories, need to be modified using PHP in the future -->

            <div class="hr"></div>

            <!-- Filter, need to be modified using PHP in the future -->
            <div class="filter-profile">

                <div class="small-container">
                    <p class="upper-filter"><i class="bi bi-tag"></i>RM {{ $job->rate }}</p>
                    <p class="lower-filter">{{ $job->type }}</p>
                </div>

                <div class="small-container">
                    <p class="upper-filter"><i class="bi bi-person-up"></i>{{ $job->exp_level }}</p>
                    <p class="lower-filter">Experience Level</p>
                </div>

                <div class="small-container">
                    <p class="upper-filter"><i class="bi bi-hourglass"></i> {{ $job->project_length }}</p>
                    <p class="lower-filter">Project Length</p>
                </div>

            </div>
            <!-- Filter, need to be modified using PHP in the future -->

            <div class="hr"></div>

            <!-- Skills and expertise, need to be modified using PHP in the future -->
            <div class="skills-profile">
                <h3>Skills & Expertise</h3>
                <div class="skills-profile-container">
                    <x-job-tags :tagsCsv="$job->skills" /> {{-- Component for Skills tags in overview --}}
                </div>
            </div>
            <!-- Skills and expertise, need to be modified using PHP in the future -->

            <div class="hr"></div>

            <!-- contact, need to be modified using PHP in the future -->
            <div class="contact-profile">

                <div class="header">
                    <h3>About the client</h3>
                </div>
                <div class="parent-small-container">
                    <div class="small-container">
                        <p class="upper-filter"><i class="bi bi-geo-alt"></i></i> {{ $employer->state }}</p>
                        <p class="lower-filter">State</p>
                    </div>
                    <div class="small-container">
                        <p class="upper-filter"><i class="bi bi-briefcase"></i> {{ $totalJobs_counter }}</p>
                        <p class="lower-filter">Jobs Posted</p>
                    </div>
                    <div class="small-container">
                        <p class="upper-filter"><i class="bi bi-person-vcard"></i>
                            {{ \Carbon\Carbon::parse($employer->created_at)->diffForHumans() }}</p>
                        <p class="lower-filter">Member Since</p>
                    </div>
                </div>

            </div>
            <!-- contact, need to be modified using PHP in the future -->


            <div class="hr"></div>

            <!-- Bring to hire profile, if signed in. If not go to log in page -->
            <a href="/employer/jobs/{{ $job->id }}/edit" class="tw-no-underline">
                <div class="apply-btn-profile">
                    <button> Edit posting</button>
                </div>
            </a>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // This code uses the window.history.back() method to go back one step in the browser history when the button is clicked. This will restore the previous URL.
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
