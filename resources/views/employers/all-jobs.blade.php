@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/employer-active-jobs.css') }}">
@endsection

@section('content')
    <div class="tw-flex">
        {{-- Side Bar Navigation --}}
        <div class="left-container">
            <x-employers.sidebar-nav :employer_detail="$employer_details" />
        </div>

        {{-- Main content --}}
        <div class="tw-flex tw-flex-col tw-p-12 tw-min-w-[85%]">
            {{-- Header --}}
            <div class="tw-block">
                <div
                    class="tw-w-full tw-bg-white tw-rounded tw-border-l-4 tw-mb-4 tw-border-blue-300 tw-py-[2%] tw-pr-[0%] tw-pl-[1%] ">
                    <h1 class="tw-text-5xl tw-pb-1">All <span style="color:#87CEFA"> Jobs Listings </span></h1>
                    <h2>Explore Your Job Listings: All Jobs in One Place</span>!</h2>
                </div>
            </div>
            <!-- Search and Data table container -->
            <div class="tw--my-2 tw-py-2 tw-overflow-x-auto sm:tw--mx-6 sm:tw-px-6 lg:tw--mx-8 lg:tw-px-8">
                {{-- Main container for combination of search bar and data table --}}
                <div
                    class="tw-align-middle tw-rounded-tl-lg tw-rounded-tr-lg tw-inline-block tw-w-full tw-py-4 tw-overflow-hidden tw-bg-white tw-shadow-lg tw-px-12">
                    <!-- Main container for the search bar and button -->
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <!-- Input container with search icon -->
                        <div class="tw-inline-flex tw-rounded tw-w-7/12 tw-h-12 tw-bg-transparent">
                            {{-- Search Request --}}
                            <form action="{{ route('employer.search_all_jobs') }}" method="GET"
                                class="tw-inline-flex tw-border tw-rounded tw-w-7/12 tw-h-12 tw-bg-transparent">
                                <div class="tw-flex tw-flex-wrap tw-items-stretch tw-w-full tw-h-full tw-mb-6 tw-relative">
                                    <div class="tw-flex">
                                        <!-- Search icon container (wrapped in anchor tag) -->
                                        <a href="javascript:void(0);" onclick="this.closest('form').submit();"
                                            class="tw-flex tw-items-center tw-leading-normal tw-bg-transparent tw-rounded tw-rounded-r-none tw-border tw-border-r-0 tw-border-none lg:tw-px-3 tw-py-2 tw-whitespace-no-wrap tw-text-grey-dark tw-text-sm">
                                            <svg width="18" height="18" class="tw-w-4 lg:tw-w-auto"
                                                viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z"
                                                    stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                    <!-- Search input field -->
                                    <input type="text" name="keywords"
                                        class="tw-flex-shrink tw-flex-grow tw-flex-auto tw-leading-normal tw-tracking-wide tw-w-px tw-flex-1 tw-border tw-border-none tw-border-l-0 tw-rounded tw-rounded-l-none tw-px-3 tw-relative focus:tw-outline-none tw-text-xxs lg:tw-text-xs lg:tw-text-base tw-text-gray-500 tw-font-thin"
                                        placeholder="Search by title, description, category, skills">
                                </div>
                            </form>

                        </div>
                        <div>
                            <a href="/employer/jobs/create">
                                <button
                                    class="tw-px-5 tw-py-2 tw-border tw-border-blue-500 tw-rounded tw-cursor-pointer tw-transition tw-duration-300 tw-text-white tw-bg-gradient-to-r tw-from-blue-500 tw-to-blue-700 hover:tw-from-blue-600 hover:tw-to-blue-800 focus:tw-outline-none">
                                    Create Job
                                </button>

                            </a>

                        </div>
                    </div>
                </div>


                {{-- Table container --}}
                <div
                    class="tw-min-h-screen tw-h-auto tw-align-middle tw-inline-block tw-min-w-full tw-shadow tw-overflow-hidden tw-bg-white tw-shadow-dashboard tw-px-8 tw-pt-3 tw-rounded-bl-lg tw-rounded-br-lg">
                    {{-- Data table --}}
                    <table id="active-jobs-table" class="tw-min-w-full">
                        {{-- Table header --}}
                        <thead>
                            <tr>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-left tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-1/10">
                                    ID
                                </th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-left tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-4/10">
                                    Title
                                </th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-left tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-3/10">
                                    Category
                                </th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-center tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-1/10">
                                    Created at
                                </th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-center tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-1/10">
                                    Updated at
                                </th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-center tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-1/10">
                                </th>
                            </tr>
                        </thead>

                        {{-- Table content --}}
                        <tbody class="tw-bg-white">
                            @if ($jobs->isEmpty())
                                <tr>
                                    <td colspan="5" class="tw-text-center">
                                        <!-- Use colspan="5" to span across all columns -->
                                        <div class="tw-flex tw-flex-col tw-items-center">
                                            <img src="/images/find-job/not-found.png" alt=""
                                                class="tw-w-96 tw-h-96 tw-mt-20">
                                            <h2 class="tw-text-center tw-text-xl tw-font-semibold tw-mt-4">No jobs found
                                            </h2>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($jobs as $job)
                                    @php
                                        // For every even number, apply gray background
                                        $rowClass = $loop->iteration % 2 === 1 ? 'tw-bg-gray-100' : '';
                                    @endphp
                                    {{-- To access components, use "<x-file-name/>" --}}
                                    <tr class="tw-border-b-4 {{ $rowClass }}">
                                        <x-employers.all-jobs-table-row :job="$job" />
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="tw-mt-6 tw-p-4">
                        {{ $jobs->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Toggle Dropdown Script --}}
    <script type="text/javascript">
        var jobsLink = document.getElementById("jobs-link");
        var jobsDropdown = document.getElementById("jobs-dropdown");

        // Get the current URL pathname
        var currentPath = window.location.pathname;

        // Regular expression pattern to match "/employer/jobs" URLs
        var pattern = /^\/employer\/jobs\/[^?]*($|\?)/;


        // Toggle display and class based on the match result
        function toggleDropdown() {
            jobsDropdown.style.display = jobsDropdown.style.display === "none" ? "block" : "none";
            jobsLink.classList.toggle("open");
        }

        // Check if the current path matches the pattern
        if (pattern.test(currentPath)) {
            // The current URL matches "/employer/jobs/*"
            toggleDropdown();
        }

        jobsLink.addEventListener("click", function() {
            toggleDropdown();
        });
    </script>

    {{-- Delete Confirmation Popup --}}
    <script>
        var deleteBtn = document.getElementById("delete-btn");
        var deletePopup = document.getElementById("delete-popup");
        var deleteCancel = document.getElementById("cancel-btn");

        deleteBtn.addEventListener("click", function() {
            deletePopup.classList.remove("tw-hidden");
            deletePopup.classList.add("tw-flex");
        });

        deleteCancel.addEventListener("click", function() {
            deletePopup.classList.remove("tw-flex");
            deletePopup.classList.add("tw-hidden");
        });
    </script>
@endsection
