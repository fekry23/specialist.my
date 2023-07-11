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
                <form id="searchForm" action="" onsubmit="return validateForm()">
                    <select id="category" onchange="redirectSearchBar()">
                        <option class="tw-text-gray-500" value="">Select an option</option>
                        <option value="candidate">Candidate</option>
                        <option value="jobs">Jobs</option>
                    </select>
                    <br>
                    <input type="search" id="keywords" name="keywords" placeholder="Enter keywords...">
                    <br>
                    <select id="state" name="state">
                        <option class="tw-text-gray-500" value="">Select a state...</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Melaka">Malacca</option>
                        <option value="Negeri Sembilan">Negeri Sembilan
                        </option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Putrajaya">Putrajaya</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                    </select> <br>
                    <button type="submit">Search</button>
                </form>
            </div>
            <!-- end of search bar -->
        </div>
        <!-- end of first row -->
        <!-- Reference : https://stackoverflow.com/questions/13556744/how-to-save-recent-searches-with-javascript -->
        <div class="search-history">
            {{-- <p style="font-weight: bolder;">Search History</p>
            <div class="vl"></div> --}}
        </div>
        <!-- Second Row -->
        <div class="second-row">
            <div class="big-box">
                <p class="title">Browse candidates by categories</p>
                <p class="subtitle">Looking for work? <a href="/find-job">Browse Jobs</a></p>
                <div class="small-box"><button type="button" onclick="filterJobs('Development & IT')">Development &
                        IT</button></div>
                <div class="small-box"><button type="button" onclick="filterJobs('Design & Creative')">Design &
                        Creative</button></div>
                <div class="small-box"><button type="button" onclick="filterJobs('Sales & Marketing')">Sales &
                        Marketing</button></div>
                <div class="small-box"><button type="button" onclick="filterJobs('Writing & Translation')">Writing &
                        Translation</button></div>
                <div class="small-box"><button type="button" onclick="filterJobs('Admin & Customer Support')">Admin &
                        Customer Support</button></div>
                <div class="small-box"><button type="button" onclick="filterJobs('Finance & Accounting')">Finance &
                        Accounting</button></div>
                <div class="small-box"><button type="button" onclick="filterJobs('Engineering & Architecture')">Engineering
                        & Architecture</button></div>
                <div class="small-box"><button type="button" onclick="filterJobs('Legal')">Legal</button></div>
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
                        <button type="button"
                            onclick="redirectToEmployerDashboard('{{ Auth::guard('employer')->check() }}')">
                            Post a job <br> and hire an expert </button>
                        <button type="button" onclick="window.location = '/find-candidate'">Browse talent</button>
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
                        <button type="button"
                            onclick="redirectToTrainerDashboard('{{ Auth::guard('trainer')->check() }}')">
                            Create and <br> update your profile </button>
                        <button type="button" onclick="window.location = '/find-job'">Browse jobs</button>
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
    <script>
        function filterJobs(category) {
            // Perform any necessary filtering based on the selected category
            // For example, you can redirect to the /find-job page with the category as a query parameter
            window.location.href = '/find-job?category=' + encodeURIComponent(category);
        }
    </script>

    <script>
        function redirectSearchBar() {
            var category = document.getElementById("category").value;
            var baseURL = ''; // Replace with your desired URL

            if (category === 'candidate') {
                baseURL = '/find-candidate';
            } else if (category === 'jobs') {
                baseURL = '/find-job';
            }

            var form = document.getElementById('searchForm');
            form.action = baseURL;
        }
    </script>

    <script>
        function validateForm() {
            var category = document.getElementById("category").value;
            if (category === "") {
                alert("Please select a category.");
                return false; // Prevent form submission
            }
            // Additional validation or form handling can be added here
            return true; // Allow form submission
        }
    </script>

    <script>
        function redirectToEmployerDashboard(guard) {
            if (guard) {
                window.location = '/employer/dashboard/{{ Auth::guard('employer')->id() }}';
            } else {
                alert('Please logout your Trainer Account first.');
            }
        }

        function redirectToTrainerDashboard(guard) {
            if (guard) {
                window.location = '/employer/dashboard/{{ Auth::guard('trainer')->id() }}';
            } else {
                alert('Please logout your Employer Account first.');
            }
        }
    </script>
@endsection
