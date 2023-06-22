@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/find-candidate-overview.css') }}">
@endsection

@section('content')
    <!-- START OF VIEWING CANDIDATE DETAILED PROFILE -->
    <div class="candidate-container" id="candidate-container">
        <div class="candidate-profile">
            <button class="back-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i> <span
                    style="margin-left: 10%">Back</span> </button>
            <div class="header-profile tw-flex tw-flex-col tw-items-center">
                @if (isset($trainer->image) && file_exists(public_path('/images/find-candidate/' . $trainer->image)))
                    <img src="{{ url('/images/find-candidate/' . $trainer->image) }}"
                        alt="{{ $trainer->name ?? 'Trainer' }} Profile Image" class="tw-rounded tw-w-36 tw-h-36">
                @else
                    <img src="/images/signup-img/{{ $trainer->image }}"
                        alt="{{ $application->name ?? 'Trainer' }} Profile Image" class="tw-rounded tw-w-36 tw-h-36">
                @endif
                <h1>{{ $trainer->name }}</h1>
                <h3>{{ $trainer->state }}</h3>

            </div>

            @isset($trainer->specialization_title)
                <div class="hr"></div>

                <div class="description-profile">
                    <h3 class="tw-font-bold">{{ $trainer->specialization_title }}</h3>
                    <p style="margin-top: 1%;">{{ $trainer->specialization_description }}</p>
                </div>
            @endisset


            <div class="hr"></div>

            <div class="category-profile">
                <h3 class="tw-font-bold">Categories</h3>
                @isset($trainer->category)
                    <button onclick="window.location.href='/find-candidate/?category={{ $trainer->category }}'">
                        <span>{{ $trainer->category }}</span> </button>
                @else
                    <p style="margin-top: 1%;color:gray;"> No categories available</p>
                @endisset
            </div>

            <div class="hr"></div>

            <div class="rate-profile">
                <h3 class="tw-font-bold">Hourly Rate</h3>
                @isset($trainer->hourly_rate)
                    <button> <span> RM {{ $trainer->hourly_rate }}</span> </button>
                @else
                    <p style="margin-top: 1%;color:gray;"> No rate available</p>
                @endisset
            </div>

            <div class="hr"></div>

            <div class="skills-profile">
                <h3 class="tw-font-bold">Skills & expertise</h3>
                @isset($trainer->skills_expertise)
                    <div class="skills-profile-container">
                        <x-find-trainers.trainer-tags :tagsCsv="$trainer->skills_expertise" /> {{-- Component for Skills tags in overview --}}
                    </div>
                @else
                    <p style="margin-top: 1%;color:gray;"> No skills & expertise available</p>
                @endisset
            </div>

            <div class="hr"></div>

            <!----- -------------------------------------------------->
            <!------------------- PROFILE RATINGS -------------------->
            <!----- -------------------------------------------------->
            <div class="star-ratings-profile">

                <h3 class="tw-font-bold">Reviews</h3>

                <div class="tw-flow-root tw-divide-y-2 tw-divide-gray-200">
                    @if ($reviews->isEmpty())
                        <p class="tw-my-5 tw-text-gray-500">No Reviews</p>
                    @else
                        @foreach ($reviews as $review)
                            <x-find-trainers.trainer-rating-comment :review="$review" />
                        @endforeach
                    @endif
                </div>


            </div>
            <!----- -------------------------------------------------->
            <!------------------- PROFILE RATINGS -------------------->
            <!----- -------------------------------------------------->

            <div class="hr"></div>

            <div class="contact-profile">
                <h3 class="tw-font-bold">Contact Information</h3>
                <p>Email: {{ $trainer->email }}</p>
                <p>Phone No : {{ $trainer->contact_no }}</p>
            </div>

            <div class="hr"></div>

            <!-- Bring to hire profile, if signed in. If not go to log in page -->
            @auth('employer')
                <div class="hire-btn-profile">
                    <button id="offer-form-btn"> Hire Now !</button>
                </div>
                <x-find-trainers.offer-job-form :jobs="$jobs" :trainer_id="$trainer->id" />
            @else
                <div class="hire-btn-profile">
                    <button> Create an Employer Account to Hire!</button>
                </div>
            @endauth



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

    {{-- Apply job form --}}
    <script>
        var offerForm = document.getElementById("offer-job-form");
        var offerFormBtn = document.getElementById("offer-form-btn");
        var cancelFormBtn = document.getElementById("cancel-offer-job-btn");

        offerFormBtn.addEventListener("click", function() {
            offerForm.classList.remove("tw-hidden");
            offerForm.classList.add("tw-flex");
        });

        cancelFormBtn.addEventListener("click", function() {
            offerForm.classList.remove("tw-flex");
            offerForm.classList.add("tw-hidden");
        })
    </script>
@endsection
