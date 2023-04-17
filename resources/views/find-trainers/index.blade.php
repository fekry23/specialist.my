@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/find-candidate.css') }}">
    <link href="{{ asset('css/tagify.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- start section('content') || THIS IS THE CONTENT --}}
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
                <small>Maximum 3 tags</small>
            </div>
            <hr>
            <!-- End of Category Filter -->
            <!-- Location Filter -->
            <div class="locationRow">
                <p class="sub-header">Location</p>
                <div class="locationContent">
                    <input name='tags-select-state-mode' class='selectOneMode' placeholder="Please select" />
                    <small>Maximum 1 Location</small>
                </div>
            </div>
            <hr>
            <!-- End of Location Filter -->
            <!-- Hourly Rate Filter -->
            <div class="hourlyRateRow">
                <p class="sub-header">Hourly Rate</p>
                <div class="hourlyRateContent">
                    <input type="checkbox" id="rate0" name="rate" value="any">
                    <label for="rate0">Any hourly rate</label><br>
                    <input type="checkbox" id="rate1" name="rate" value="0-5">
                    <label for="rate1">RM 5 and below</label><br>
                    <input type="checkbox" id="rate2" name="rate" value="6-10">
                    <label for="rate2">RM 6 - RM 10</label><br>
                    <input type="checkbox" id="rate3" name="rate" value="11-15">
                    <label for="rate3">RM 11 - RM 15</label><br>
                    <input type="checkbox" id="rate4" name="rate" value="16">
                    <label for="rate4">RM 16 & above</label><br>
                </div>
            </div>
            <hr>
            <!-- End of Hourly Rate Filter -->
            <!-- English Level Filter -->
            <div class="EnglishRow">
                <p class="sub-header">English Level</p>
                <div class="EnglishContent">
                    <input type="checkbox" id="level0" name="level" value="any">
                    <label for="level0">Any level</label><br>
                    <input type="checkbox" id="level1" name="level" value="basic">
                    <label for="level1">Basic</label><br>
                    <input type="checkbox" id="level2" name="level" value="conversational">
                    <label for="level2">Conversational</label><br>
                    <input type="checkbox" id="level3" name="level" value="fluent">
                    <label for="level3">Fluent</label><br>
                    <input type="checkbox" id="level4" name="level" value="native">
                    <label for="level4">Native or bilingual</label><br>
                </div>
            </div>
            <hr>
            <!-- End of English Level Filter -->
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

            <!-- START OF VIEWING CANDIDATE OVERVIEW PROFILE -->
            <div id="c2-row2" class="c2-row2">
                @unless (count($trainers) == 0)
                    @foreach ($trainers as $trainer)
                        {{-- To access compononents, use " <x-file-name/> --}}
                        <x-trainer-card :trainer="$trainer" /> <!-- pass job as prop -->
                    @endforeach
                @else
                    <div class="no-listings-div">
                        <img src="images/find-job/not-found.png" alt="">
                        <h2 class="no-listings-p">No jobs found</h2>
                    </div>
                @endunless
            </div>
            <!-- END OF VIEWING CANDIDATE OVERVIEW PROFILE -->
        </div>

    </div>
@endsection
{{-- end section('content') || THIS IS END OF CONTENT --}}

@section('scripts')
    <script src="{{ asset('https://code.jquery.com/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/find-candidate.js') }}"></script>
@endsection
