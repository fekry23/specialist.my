@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/employer-dashboard.css') }}">
@endsection

@section('content')
    <div class="big-container">
        <div class="left-container">
            <x-trainers.sidebar-nav :trainer_detail="$trainer_details" />
        </div>
        <div class="right-container">
            <div class="row1">
                <div class="dashboard-header">
                    <h1 class="tw-font-extrabold">Specialist Dashboard</h1>
                    <h2 class="tw-font-semibold">Hello, <span style="color:#87CEFA">{{ $trainer_details->name }}</span>!</h2>
                </div>
            </div>
            <div class="row1-mini">
                <div class="small-box left-border-active">
                    <div class="small-box-left">
                        <i class="fas fa-briefcase" style="color: #87CEFA;"></i>
                    </div>
                    <div class="small-box-right">
                        <p class="small-box-title tw-font-semibold">Active</p>
                        <p class="small-box-value">{{ $totalActiveJobs_counter }}</p>
                    </div>
                </div>
                <div class="small-box left-border-pending">
                    <div class="small-box-left">
                        <i class="fas fa-money-check-alt" style="color: #E6E6FA;"></i>
                    </div>
                    <div class="small-box-right">
                        <p class="small-box-title tw-font-semibold">Pending</p>
                        <p class="small-box-value">{{ $totalPendingPayment_counter }}</p>
                    </div>
                </div>
                <div class="small-box left-border-review">
                    <div class="small-box-left">
                        <i class="fas fa-file-signature" style="color: #FFC0CB;"></i>
                    </div>
                    <div class="small-box-right">
                        <p class="small-box-title tw-font-semibold">Review</p>
                        <p class="small-box-value">{{ $totalNeedReviewJobs_counter }}</p>
                    </div>
                </div>
                <div class="small-box left-border-completed">
                    <div class="small-box-left">
                        <i class="fas fa-check-square" style="color: #98FB98;"></i>
                    </div>
                    <div class="small-box-right">
                        <p class="small-box-title tw-font-semibold">Completed</p>
                        <p class="small-box-value">{{ $totalCompletedJobs_counter }}</p>
                    </div>
                </div>
            </div>
            <div class="row2">
                <div class="r2-column r2-first-column">
                    {{-- Account Summary --}}
                    <div class="account-summary">
                        <div class="r2-first-header">
                            <h3 class="tw-font-semibold	tw-text-xl">Account Summary</h3>
                        </div>
                        <div class="r2-first-content">

                            <!-- <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br/> -->
                            <div class="chart">
                                <canvas id="acquisitions"></canvas>
                            </div>

                        </div>
                    </div>
                    {{-- EOF Account Summary --}}

                    {{-- Active Jobs --}}
                    <div class="active-jobs">
                        {{-- Active Jobs Title --}}
                        <div class="r2-first-header">
                            <h3 class="tw-font-semibold	tw-text-xl">Your Active Jobs</h3>
                        </div>
                        {{-- Active Jobs Content --}}
                        <div class="r2-first-content">
                            {{-- Active Jobs Header --}}
                            <div class="r2-first-content-header">
                                <div class="id-content-header">
                                    <h4 class="tw-font-semibold">ID</h4>
                                </div>
                                <div class="title-content-header">
                                    <h4 class="tw-font-semibold">Title</h4>
                                </div>
                                <div class="trainer-content-header">
                                    <h4 class="tw-font-semibold">Specialist Name</h4>
                                </div>
                                <div class="status-content-header">
                                    <h4 class="tw-font-semibold">Status</h4>
                                </div>
                            </div>
                            {{-- Active Jobs Button --}}
                            @unless (count($active_jobs) == 0)
                                @foreach ($active_jobs as $active_job)
                                    {{-- To access compononents, use " <x-file-name/> --}}
                                    <x-trainers.brief-jobs-card :job="$active_job" /> <!-- pass active_job as prop -->
                                @endforeach
                            @else
                                <div class="no-listings-div tw-flex tw-flex-col tw-items-center tw-justify-center">
                                    <img src="/images/find-job/not-found.png" alt="" class="tw-w-24 tw-h-24 tw-mt-20">
                                    <h2 class="no-listings-p tw-font-bold">No jobs found</h2>
                                </div>
                            @endunless
                        </div>
                        {{-- Active Jobs Footer --}}
                        <div class="r2-first-footer">
                            <p class="tw-font-semibold">Total Active Jobs: {{ $totalActiveJobs_counter }}</p>
                            <a href="{{ route('trainer.active_jobs') }}">View All Active Jobs</a>
                        </div>
                    </div>
                    {{-- EOF Active Jobs --}}

                    {{-- Pending Payment --}}
                    <div class="pending-payment">
                        <div class="r2-first-header">
                            <h3 class="tw-font-semibold	tw-text-xl">Your Pending Payment</h3>
                        </div>
                        <div class="r2-first-content">
                            {{-- Pending Payment Header --}}
                            <div class="r2-first-content-header">
                                <div class="id-content-header">
                                    <h4 class="tw-font-semibold">ID</h4>
                                </div>
                                <div class="title-content-header">
                                    <h4 class="tw-font-semibold">Title</h4>
                                </div>
                                <div class="trainer-content-header">
                                    <h4 class="tw-font-semibold">Specialist Name</h4>
                                </div>
                                <div class="status-content-header">
                                    <h4 class="tw-font-semibold">Status</h4>
                                </div>
                            </div>
                            {{-- Pending Payment Button --}}
                            @unless (count($pendingPayment_jobs) == 0)
                                @foreach ($pendingPayment_jobs as $pendingPayment_job)
                                    {{-- To access compononents, use " <x-file-name/> --}}
                                    <x-trainers.brief-jobs-card :job="$pendingPayment_job" /> <!-- pass active_job as prop -->
                                @endforeach
                            @else
                                <div class="no-listings-div tw-flex tw-flex-col tw-items-center tw-justify-center">
                                    <img src="/images/find-job/not-found.png" alt="" class="tw-w-24 tw-h-24 tw-mt-20">
                                    <h2 class="no-listings-p tw-font-bold">No jobs found</h2>
                                </div>
                            @endunless
                        </div>
                        <div class="r2-first-footer">
                            <p class="tw-font-semibold">Total Pending Payment: {{ $totalPendingPayment_counter }}</p>
                            <a href="{{ route('trainer.active_jobs') }}">View All Pending Payment</a>
                        </div>
                    </div>
                    {{-- EOF Pending Payment --}}
                </div>
            </div>



        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript">
        var xValues = ["Active Jobs", "Payment needed to be made", "Jobs needed to be reviewed", "Completed Jobs"];
        var yValues = [{{ $totalActiveJobs_counter }}, {{ $totalPendingPayment_counter }},
            {{ $totalNeedReviewJobs_counter }}, {{ $totalCompletedJobs_counter }}
        ];
        console.log(yValues);
        var barColors = [
            "#87CEFA", //Soft blue
            "#E6E6FA", //Pale purple
            "#FFC0CB", //Light pink
            "#98FB98" //Pale green
        ];

        new Chart("acquisitions", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                title: {
                    display: false,
                    text: "World Wide Wine Production 2018"
                }
            }
        });
    </script>

    {{-- Toggle Dropdown Script --}}
    <script type="text/javascript">
        var jobsLink = document.getElementById("jobs-link");
        var jobsDropdown = document.getElementById("jobs-dropdown");

        // Get the current URL pathname
        var currentPath = window.location.pathname;

        // Regular expression pattern to match "/trainer/jobs" URLs
        var pattern = /^\/trainer\/jobs\/[^?]*($|\?)/;


        // Toggle display and class based on the match result
        function toggleDropdown() {
            jobsDropdown.style.display = jobsDropdown.style.display === "none" ? "block" : "none";
            jobsLink.classList.toggle("open");
        }

        // Check if the current path matches the pattern
        if (pattern.test(currentPath)) {
            // The current URL matches "/trainer/jobs/*"
            toggleDropdown();
        }

        jobsLink.addEventListener("click", function() {
            toggleDropdown();
        });
    </script>

    <script src="{{ asset('js/index_employer_dashboard.js') }}"></script>
@endsection
