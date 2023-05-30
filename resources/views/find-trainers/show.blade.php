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
            <div class="header-profile">
                @if (isset($trainer->image) && file_exists(public_path('/images/find-candidate/' . $trainer->image)))
                    <img src="{{ url('/images/find-candidate/' . $trainer->image) }}"
                        alt="{{ $trainer->name ?? 'Trainer' }} Profile Image" class="tw-rounded tw-w-36 tw-h-36">
                @else
                    <div class="tw-w-36 tw-h-36 tw-bg-gray-300"></div>
                @endif
                <h1>{{ $trainer->name }}</h1>
                <h3>{{ $trainer->state }}</h3>

            </div>

            <div class="hr"></div>

            <div class="description-profile">
                <h3>{{ $trainer->specialization_title }}</h3>
                <p style="margin-top: 1%;">{{ $trainer->specialization_description }}</p>
            </div>

            <div class="hr"></div>

            <div class="category-profile">
                <h3>Categories</h3>
                <button onclick="window.location.href='/find-candidate/?category={{ $trainer->category }}'">
                    <span>{{ $trainer->category }}</span> </button>
            </div>

            <div class="hr"></div>

            <div class="rate-profile">
                <h3>Hourly Rate</h3>
                <button> <span> RM {{ $trainer->hourly_rate }}</span> </button>
            </div>

            <div class="hr"></div>

            <div class="skills-profile">
                <h3>Skills & expertise</h3>
                <div class="skills-profile-container">
                    <x-find-trainers.trainer-tags :tagsCsv="$trainer->skills_expertise" /> {{-- Component for Skills tags in overview --}}
                </div>
            </div>

            <div class="hr"></div>

            <!----- -------------------------------------------------->
            <!------------------- PROFILE RATINGS -------------------->
            <!----- -------------------------------------------------->
            <div class="star-ratings-profile">

                <h3>Ratings</h3>

            </div>
            <!----- -------------------------------------------------->
            <!------------------- PROFILE RATINGS -------------------->
            <!----- -------------------------------------------------->

            <div class="hr"></div>

            <div class="contact-profile">
                <h3>Contact Information</h3>
                <p>Email: {{ $trainer->email }}</p>
                <p>Phone No : {{ $trainer->contact_no }}</p>
            </div>

            <div class="hr"></div>

            <!-- Bring to hire profile, if signed in. If not go to log in page -->
            <div class="hire-btn-profile">
                <button> Hire Now !</button>
            </div>


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
