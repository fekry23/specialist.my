@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

{{-- start section('content') || THIS IS THE CONTENT --}}
@section('content')
    <div class="content">
        <!-- First row -->
        <div class="first-row">
            <!-- Search Bar -->
            <div class="search-bar">
                <form>
                    <select id="category">
                        <option value="candidate">Candidate</option>
                        <option value="jobs">Jobs</option>
                    </select>
                    <br>
                    <input type="search" id="keywords" placeholder="Enter keywords...">
                    <br>
                    <input type="search" id="location" name="myStates" placeholder="Area, city or town">
                    <br>
                    <button type="submit">Search</button>
                </form>
            </div>
            <!-- end of search bar -->
        </div>
        <!-- end of first row -->
        <!-- Reference : https://stackoverflow.com/questions/13556744/how-to-save-recent-searches-with-javascript -->
        <div class="search-history">
            <p style="font-weight: bolder;">Search History</p>
            <div class="vl"></div>
        </div>
        <!-- Second Row -->
        <div class="second-row">
            <div class="big-box">
                <p class="title">Browse candidates by categories</p>
                <p class="subtitle">Looking for work? <a href="find-job.php">Browse Jobs</a></p>
                <div class="small-box"><button type="button" onclick="">Development & IT</button></div>
                <div class="small-box"><button type="button" onclick="">Design & Creative</button></div>
                <div class="small-box"><button type="button" onclick="">Sales & Marketing</button></div>
                <div class="small-box"><button type="button" onclick="">Writing & Translation</button></div>
                <div class="small-box"><button type="button" onclick="">Admin & Customer Support</button></div>
                <div class="small-box"><button type="button" onclick="">Finance & Accounting</button></div>
                <div class="small-box"><button type="button" onclick="">Engineering & Architecture</button></div>
                <div class="small-box"><button type="button" onclick="">Legal</button></div>
            </div>
        </div>
        <!-- End of second row -->
        <!-- Third row -->
        <div class="third-row">
            <div class="left-container">
                <div class="img-container">
                    <p style="color:white;">For Clients</p>
                    <img src="images/homepage-img/row3-left-container.jpg" alt="">
                </div>
                <div class="wordings-container">
                    <p>Hiring a freelancer is like finding a needle in a haystack - but worth the effort!</p>
                    <div class="wordings-container-button">
                        <button type="button" onclick=""> Post a job <br> and hire an expert </button>
                        <button type="button" onclick="window.location = 'find-candidate.php'">Browse talent</button>
                    </div>
                </div>
            </div>
            <div class="right-container">
                <div class="img-container">
                    <p style="color: white;">For Specialist</p>
                    <img src="images/homepage-img/row3-right-container.jpg" alt="">
                </div>
                <div class="wordings-container">
                    <p>Find your dream job as a freelancer and control when, where, and how you work on Specialist.my!</p>
                    <div class="wordings-container-button">
                        <button type="button" onclick=""> Create and <br> update your profile </button>
                        <button type="button" onclick="window.location = 'find-job.php'">Browse jobs</button>
                    </div>
                </div>
            </div>
            <!-- End of third row -->
        </div>
    </div>
@endsection
{{-- end section('content') || THIS IS END OF CONTENT --}}

@section('scripts')
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
