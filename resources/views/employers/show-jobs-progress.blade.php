@extends('layout')

@section('styles')
@endsection

@section('content')
    {{-- Container Div --}}
    <div class="tw-container tw-mx-auto tw-px-4 tw-py-8">

        {{-- Header Div --}}
        <div class="tw-container tw-mx-auto tw-pt-8 tw-px-4 tw-bg-white">
            <x-employers.jobs-breadcrumb :previous_page="'Active Job Listings'" :current_page="'Job Progress'" />
            <h1
                class="tw-mb-4 tw-text-3xl tw-font-extrabold tw-text-gray-900 tw-dark:text-white tw-md:text-5xl tw-lg:text-6xl">
                <span
                    class="tw-text-transparent tw-bg-clip-text tw-bg-gradient-to-r tw-to-emerald-600 tw-from-sky-400">{{ $job->title }}</span>
                Progress Tracking.
            </h1>
            <p class="tw-text-lg tw-font-normal tw-text-gray-500 tw-lg:text-xl tw-dark:text-gray-400">
                Track and monitor the progress of your posted jobs to ensure successful outcomes.
            </p>
        </div>

        {{-- Main Content Div --}}
        <div class="tw-container tw-mx-auto tw-px-4 tw-bg-white tw-py-8">

            {{-- Progress Div --}}
            <div class="tw-container tw-mx-auto">
                {{-- Header Div --}}
                <div class="tw-container tw-flex tw-items-center tw-justify-between">
                    {{-- Progress Header --}}
                    <h1
                        class="tw-mb-4 tw-text-3xl tw-font-extrabold tw-text-gray-900 tw-dark:text-white tw-md:text-5xl tw-lg:text-6xl">
                        Progress
                    </h1>
                </div>

                {{-- Progress Details --}}
                <ol
                    class="tw-list-none tw-relative tw-border-l tw-border-y-0 tw-border-r-0 tw-border-solid tw-border-gray-200 dark:tw-border-gray-700">
                    @foreach ($job_status as $status)
                        {{-- To access compononents, use " <x-file-name/> --}}
                        <x-employers.progress-information :status="$status" :completed_job_details="$completed_job_details" :review_details="$review_details" />
                        <!-- pass active_job as prop -->
                    @endforeach
                </ol>
            </div>

            {{-- Job Information Div --}}
            <div class="tw-container tw-mx-auto">
                {{-- Header Div --}}
                <div class="tw-container tw-flex tw-items-center tw-justify-between">
                    {{-- Progress Header --}}
                    <h1
                        class="tw-mb-4 tw-text-3xl tw-font-extrabold tw-text-gray-900 tw-dark:text-white tw-md:text-5xl tw-lg:text-6xl">
                        Job Information
                    </h1>
                </div>

                <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                    <div>
                        <p class="tw-text-gray-600">Job Category:</p>
                        <p class="tw-text-gray-900 tw-font-semibold">{{ $job->category }}</p>
                    </div>
                    <div>
                        <p class="tw-text-gray-600">Job Type:</p>
                        <p class="tw-text-gray-900 tw-font-semibold">{{ $job->type }}</p>
                    </div>
                    <div>
                        <p class="tw-text-gray-600">
                            @if ($job->type == 'Hourly')
                                Hourly Rate:
                            @else
                                Fixed-Price:
                            @endif
                        </p>
                        <p class="tw-text-gray-900 tw-font-semibold">RM {{ $job->rate }}</p>
                    </div>
                    <div>
                        <p class="tw-text-gray-600">Experience Level:</p>
                        <p class="tw-text-gray-900 tw-font-semibold">{{ $job->exp_level }}</p>
                    </div>
                    <div>
                        <p class="tw-text-gray-600">Project Length:</p>
                        <p class="tw-text-gray-900 tw-font-semibold">{{ $job->project_length }}</p>
                    </div>
                    <div>
                        <p class="tw-text-gray-600">Skills Required:</p>
                        <p class="tw-text-gray-900 tw-font-semibold">{{ $job->skills }}</p>
                    </div>
                </div>
            </div>

            {{-- Specialist Information Div --}}
            <div class="tw-container tw-mx-auto tw-pt-8">
                {{-- Header Div --}}
                <div class="tw-container tw-flex tw-items-center tw-justify-between">
                    {{-- Progress Header --}}
                    <h1
                        class="tw-mb-4 tw-text-3xl tw-font-extrabold tw-text-gray-900 tw-dark:text-white tw-md:text-5xl tw-lg:text-6xl">
                        Specialist Information
                    </h1>

                    {{-- 3 Buttons --}}
                    <div class="tw-inline-flex tw-rounded-md tw-shadow-sm" role="group">
                        {{-- If there;s no trainer/specialist currently in charge --}}
                        @empty($trainer)
                            <a href="{{ route('employer.show_job_applicants', ['job' => $job->id]) }}">
                                <button type="button"
                                    class="tw-px-5 tw-py-2 tw-bg-specialist tw-border-specialist tw-border tw-text-white tw-rounded-lg tw-transition tw-duration-300 tw-cursor-pointer hover:tw-bg-white hover:tw-text-specialist focus:tw-outline-none">
                                    Applicants
                                    <span
                                        class="tw-inline-flex tw-items-center tw-justify-center tw-w-min tw-h-4 tw-px-2 tw-text-xs tw-font-semibold tw-text-blue-800 tw-bg-blue-200 tw-rounded-full tw-flex-grow-0">
                                        {{ $applicant_counter }}
                                    </span>
                                </button>
                            </a>
                        @endempty

                        {{-- If there's a trainer/specialist currently in charge --}}
                        @isset($trainer)
                            <button type="button"
                                class="tw-px-5 tw-py-2 tw-cursor-pointer tw-bg-specialist tw-border-specialist tw-border tw-text-white {{ $trainer && $trainer->id ? 'tw-rounded-l-lg' : '' }} tw-transition tw-duration-300 hover:tw-bg-white hover:tw-text-specialist focus:tw-outline-none">
                                Message Specialist
                            </button>

                            <button type="button" id="remove-btn"
                                class="tw-px-5 tw-py-2 tw-bg-specialist tw-border-specialist tw-border tw-text-white tw-rounded-r-lg {{ $completed_job_details ? 'tw-opacity-50 tw-cursor-not-allowed' : 'tw-transition tw-duration-300 tw-opacity-100 tw-cursor-pointer hover:tw-bg-white hover:tw-text-specialist focus:tw-outline-none' }} "
                                {{ $completed_job_details ? 'disabled' : '' }}>
                                Remove Specialist
                            </button>
                        @endisset
                    </div>
                </div>

                {{-- Specialist Details --}}
                <div class="tw-flex tw-items-center">

                    <div class="tw-rounded-full tw-overflow-hidden tw-mr-4">
                        @if (isset($trainer->image) && file_exists(public_path('/images/find-candidate/' . $trainer->image)))
                            <img src="{{ url('/images/find-candidate/' . $trainer->image) }}"
                                alt="{{ $trainer->name ?? 'Trainer' }} Profile Image" class="tw-rounded tw-w-36 tw-h-36">
                        @else
                            <div class="tw-w-36 tw-h-36 tw-bg-gray-300"></div>
                        @endif
                    </div>
                    <div>
                        <h2 class="tw-text-lg tw-font-semibold tw-text-gray-900">{{ $trainer->name ?? 'N/A' }}</h2>
                        <p class="tw-text-sm tw-text-gray-500">{{ $trainer->specialization_title ?? 'N/A' }}</p>
                        <div class="tw-mt-2">
                            <span class="tw-text-xs tw-text-gray-400">Location:</span>
                            <span class="tw-text-sm tw-text-gray-600">{{ $trainer->state ?? 'N/A' }}</span>
                        </div>
                        <div class="tw-mt-2">
                            <span class="tw-text-xs tw-text-gray-400">Hourly Rate:</span>
                            <span class="tw-text-sm tw-text-gray-600">RM {{ $trainer->hourly_rate ?? 'N/A' }}</span>
                        </div>
                        <div class="tw-mt-2">
                            <span class="tw-text-xs tw-text-gray-400">Category:</span>
                            <span class="tw-text-sm tw-text-gray-600">{{ $trainer->category ?? 'N/A' }}</span>
                        </div>
                        <div class="tw-mt-2">
                            <span class="tw-text-xs tw-text-gray-400">Skills & Expertise:</span>
                            <span class="tw-text-sm tw-text-gray-600">{{ $trainer->skills_expertise ?? 'N/A' }}</span>
                        </div>
                        <div class="tw-mt-2">
                            <span class="tw-text-xs tw-text-gray-400">English Level:</span>
                            <span class="tw-text-sm tw-text-gray-600">{{ $trainer->english_level ?? 'N/A' }}</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- Confirmation Popup --}}
    @isset($trainer)
        <x-employers.remove-specialist-popup :job="$job" :trainer="$trainer" />
    @endisset

    {{-- Confirmation Popup --}}
    @isset($trainer)
        <x-employers.completed-job-form :job="$job" :trainer="$trainer" :employer="$employer" :finishTime="$finishTime" />
    @endisset
@endsection

@section('scripts')
    {{-- Confirmation Popup --}}
    <script>
        var removeBtn = document.getElementById("remove-btn");
        var confirmPopup = document.getElementById("confirm-popup");
        var removeCancel = document.getElementById("cancel-btn");

        removeBtn.addEventListener("click", function() {
            confirmPopup.classList.remove("tw-hidden");
            confirmPopup.classList.add("tw-flex");
        });

        removeCancel.addEventListener("click", function() {
            confirmPopup.classList.remove("tw-flex");
            confirmPopup.classList.add("tw-hidden");
        });
    </script>

    {{-- Complete job form --}}
    <script>
        var completedForm = document.getElementById("completed-job-form");
        var completedFormBtn = document.getElementById("completed-job-btn");
        var cancelFormBtn = document.getElementById("cancel-completed-job-btn");

        completedFormBtn.addEventListener("click", function() {
            completedForm.classList.remove("tw-hidden");
            completedForm.classList.add("tw-flex");
        });

        cancelFormBtn.addEventListener("click", function() {
            completedForm.classList.remove("tw-flex");
            completedForm.classList.add("tw-hidden");
        })
    </script>
@endsection
