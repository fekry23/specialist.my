@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/employer-active-jobs.css') }}">
@endsection

@section('content')
    <div class="tw-flex">
        {{-- Side Bar Navigation --}}
        <div class="left-container">
            <x-trainers.sidebar-nav :trainer_detail="$trainer" />
        </div>

        {{-- Main content --}}
        <div class="tw-flex tw-flex-col tw-p-12 tw-min-w-[85%]">
            {{-- Header --}}
            <div class="tw-block">
                <div
                    class="tw-w-full tw-bg-white tw-rounded tw-border-l-4 tw-mb-4 tw-border-blue-300 tw-py-[2%] tw-pr-[0%] tw-pl-[1%] ">
                    <h1 class="tw-text-5xl tw-pb-1"> Job <span style="color:#87CEFA"> Applications</span> </h1>
                    <h2>Manage Your Job Applications: Track Applications Status</h2>
                </div>
            </div>
            <!-- Search and Data table container -->
            <div class="tw--my-2 tw-py-2 tw-overflow-x-auto sm:tw--mx-6 sm:tw-px-6 lg:tw--mx-8 lg:tw-px-8">
                {{-- Main container to hold the DIV for filters and create job button --}}
                <div
                    class="tw-flex tw-justify-between tw-items-center tw-align-middle tw-rounded-tl-lg tw-rounded-tr-lg tw-inline-block tw-w-full tw-py-4 tw-overflow-hidden tw-bg-white tw-shadow-lg tw-px-12">


                    {{-- Filter divs --}}
                    <div class="tw-flex">
                        {{-- search bar --}}
                        <form action="{{ route('trainer.search_applications_for_trainer') }}" method="GET"
                            class="tw-flex tw-w-full">
                            <label for="keywords"
                                class="tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 tw-sr-only">Search</label>
                            <div class="tw-flex">
                                <div class="tw-relative">
                                    <div
                                        class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3 tw-pointer-events-none">
                                        <svg aria-hidden="true" class="tw-w-5 tw-h-5 tw-text-gray-500 tw-dark:text-gray-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path tw-stroke-linecap="round" tw-stroke-linejoin="round" tw-stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="keywords"
                                        class="tw-block tw-w-96 tw-p-4 tw-pl-10 tw-text-sm tw-text-gray-900 tw-border tw-border-gray-300 tw-rounded-lg tw-bg-gray-50 focus:tw-ring-blue-500 focus:tw-border-blue-500"
                                        placeholder="Search by title, category, and other keywords"
                                        value="{{ request()->get('keywords') }}">
                                </div>

                                <div class="tw-ml-4">
                                    <select name="status"
                                        class="tw-w-48 tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-block tw-w-full tw-p-4">
                                        <option value="">Choose a status</option>
                                        <option value="Applied"
                                            {{ request()->get('status') == 'Applied' ? 'selected' : '' }}>Applied</option>
                                        <option value="Accepted"
                                            {{ request()->get('status') == 'Accepted' ? 'selected' : '' }}>Accepted
                                        </option>
                                        <option value="Offered"
                                            {{ request()->get('status') == 'Offered' ? 'selected' : '' }}>Offered
                                        </option>
                                        <option value="Rejected"
                                            {{ request()->get('status') == 'Rejected' ? 'selected' : '' }}>Rejected
                                        </option>
                                    </select>
                                </div>


                                <div class="tw-flex tw-ml-4  tw-items-center">
                                    <button type="submit"
                                        class="tw-text-white tw-bg-blue-700 hover:tw-bg-blue-800 focus:tw-ring-4 focus:tw-outline-none focus:tw-ring-blue-300 tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-py-2">Apply</button>

                                    <a href="{{ url('/trainer/jobs/active-jobs') }}" id="reset-link">
                                        <button
                                            class="tw-text-gray-800 tw-bg-white tw-border tw-border-gray-800 hover:tw-bg-gray-800 hover:tw-text-white focus:tw-ring-4 focus:tw-outline-none focus:tw-ring-red-100 tw-font-medium tw-rounded-lg tw-text-sm tw-px-4 tw-py-2 tw-ml-2">
                                            Reset</button>
                                    </a>


                                </div>
                            </div>
                        </form>


                    </div>


                    {{-- Apply Job button div --}}
                    <div>
                        <a href="/find-job">
                            <button
                                class="tw-px-5 tw-py-2 tw-border tw-border-blue-500 tw-rounded tw-cursor-pointer tw-transition tw-duration-300 tw-text-white tw-bg-gradient-to-r tw-from-blue-500 tw-to-blue-700 hover:tw-from-blue-600 hover:tw-to-blue-800 focus:tw-outline-none">Apply
                                Job</button>
                        </a>

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
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-left tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-1/12">
                                    ID</th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-left tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-5/12">
                                    Title</th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-left tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-5/12">
                                    Description</th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-center tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-2/12">
                                    Status</th>
                                <th
                                    class="tw-px-6 tw-py-3 tw-border-b-2 tw-border-gray-300 tw-text-center tw-leading-4 tw-text-blue-500 tw-tracking-wider tw-w-2/12">
                                    Action</th>
                            </tr>
                        </thead>



                        {{-- Table content --}}
                        <tbody class="tw-bg-white">
                            @if ($applications->isEmpty())
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
                                @foreach ($applications as $application)
                                    @php
                                        // For every even number, apply gray background
                                        $rowClass = $loop->iteration % 2 === 1 ? 'tw-bg-gray-100' : '';
                                    @endphp
                                    {{-- To access components, use "<x-file-name/>" --}}
                                    <tr class="tw-border-b-4 {{ $rowClass }}">
                                        <x-trainers.applications-table-row :application="$application" />
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="tw-mt-6 tw-p-4">
                        {{ $applications->links('pagination::tailwind') }}
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

    {{-- Reset Filters --}}
    <script>
        document.getElementById('reset-link').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = window.location.pathname;
        });
    </script>
@endsection
