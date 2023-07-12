@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/find-job.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tagify.css') }}" type="text/css" />
@endsection

@section('content')
    <div class="content">
        <div class="column1">
            <h3>Filter by</h3>
            <hr>
            <!-- Category Filter -->
            <div class="categoryRow">
                <p class="sub-header">Category</p>
                <div class="categoryContent">
                    <input name='input-category-dropdown' class='input-category-dropdown' placeholder='Categories tags'
                        value=''>
                </div>
                <small>Maximum 3 categories</small>
            </div>
            <hr>
            <!-- End of Category Filter -->
            <!-- Location Filter -->
            <div class="locationRow">
                <p class="sub-header">Location</p>
                <div class="locationContent">
                    <input name='tags-select-state-mode' class='selectOneMode' placeholder="Please select" />
                </div>
            </div>
            <hr>
            <!-- End of Location Filter -->
            <!-- Job Type Filter -->
            <div class="jobTypeRow">
                <p class="sub-header">Job type</p>
                <div class="jobTypeContent">
                    <input type="checkbox" id="type0" name="type" value="Hourly">
                    <label for="type0">Hourly</label><br>
                    <input type="checkbox" id="type1" name="type" value="Fixed-Price">
                    <label for="type1">Fixed-Price</label><br>
                </div>
            </div>
            <hr>
            <!-- End of Job Type Filter -->

            <!-- Job Type Filter -->
            <div class="experienceRow">
                <p class="sub-header">Experience Level</p>
                <div class="experienceContent">
                    <input type="checkbox" id="experience0" name="experience" value="Entry">
                    <label for="experience0">Entry</label><br>
                    <input type="checkbox" id="experience1" name="experience" value="Intermediate">
                    <label for="experience1">Intermediate</label><br>
                    <input type="checkbox" id="experience2" name="experience" value="Expert">
                    <label for="experience2">Expert</label><br>
                </div>
            </div>
            <hr>
            <!-- End of Job Type Filter -->

            <!-- Client History Filter -->
            <div class="clientHistoryRow">
                <p class="sub-header">Client history</p>
                <div class="clientHistoryContent">
                    <input type="checkbox" id="history0" name="history" value="No hires">
                    <label for="history0">No hires</label><br>
                    <input type="checkbox" id="history1" name="history" value="1-9">
                    <label for="history1">1 to 9 hires</label><br>
                    <input type="checkbox" id="history2" name="history" value="10">
                    <label for="history2">10+ hires</label><br>
                </div>
            </div>
            <hr>
            <!-- End of Client History Filter -->

            <!-- Project Length Filter -->
            <div class="projectLengthRow">
                <p class="sub-header">Project length</p>
                <div class="projectLengthContent">
                    <input type="checkbox" id="length0" name="length" value="Less than one month">
                    <label for="length0">Less than one month</label><br>
                    <input type="checkbox" id="length1" name="length" value="1 to 3 months">
                    <label for="length1">1 to 3 months</label><br>
                    <input type="checkbox" id="length2" name="length" value="3 to 6 months">
                    <label for="length2">3 to 6 months</label><br>
                    <input type="checkbox" id="length3" name="length" value="More than 6 months">
                    <label for="length3">More than 6 months</label><br>
                </div>
            </div>
            <hr>
            <div class="resetRow">
                <button onclick="window.location.href='/find-job'"> Reset </button>
            </div>
            <!-- End of Project Length Filter -->
        </div>

        <div class="column2">
            <!-- Search Bar -->
            <div class="c2-row1">

                <input type="search" id="search-input" placeholder="Enter keywords...">
                <button id="search-btn">Search</button>

            </div>
            <hr>
            <!-- end of search bar -->
            <div id="c2-row1-mini" class="c2-row1-mini">

            </div>

            <hr>
            <!-- START OF VIEWING CANDIDATE OVERVIEW PROFILE -->
            <div id="c2-row2" class="c2-row2">
                @unless (count($jobs) == 0)
                    @foreach ($jobs as $job)
                        {{-- To access compononents, use " <x-file-name/> --}}
                        <x-job-card :job="$job" /> <!-- pass job as prop -->
                    @endforeach
                @else
                    <div class="no-listings-div">
                        <img src="images/find-job/not-found.png" alt="">
                        <h2 class="no-listings-p">No jobs found</h2>
                    </div>
                @endunless
                {{-- Paginate --}}
                <div class="c2-row2-mini">
                    <div class="tw-mt-6 tw-p-4">
                        {{ $jobs->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
            <!-- END OF VIEWING CANDIDATE OVERVIEW PROFILE -->


        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('https://code.jquery.com/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/find-job.js') }}"></script>
@endsection
