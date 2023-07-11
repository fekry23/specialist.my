@extends('layout')

@section('styles')
@endsection

@section('content')
    {{-- Container Div --}}
    <div class="tw-container tw-mx-auto tw-px-4 tw-py-8">

        {{-- Header Div --}}
        <div class="tw-container tw-mx-auto tw-pt-8 tw-px-4 tw-bg-white">
            <x-trainers.jobs-breadcrumb :previous_page="'Active Job Listings'" :current_page="'Job Progress'" />
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
                        <x-trainers.progress-information :status="$status" :completed_job_details="$completed_job_details" :review_details="$review_details" />
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

                </div>

                {{-- Specialist Details --}}
                <div class="tw-flex tw-items-center">

                    <div class="tw-rounded-full tw-overflow-hidden tw-mr-4">
                        @if ($employer->profile_picture === 'freelancer-icon.png')
                            <img class="tw-rounded tw-w-36 tw-h-36" src="/images/signup-img/freelancer-icon.png"
                                alt="">
                        @else
                            <img class="tw-rounded tw-w-36 tw-h-36"
                                src="{{ asset('storage/' . $employer->profile_picture) }}" alt="">
                        @endif
                    </div>
                    <div>
                        <h2 class="tw-text-lg tw-font-semibold tw-text-gray-900">{{ $employer->company_name ?? 'N/A' }}
                        </h2>
                        <p class="tw-text-sm tw-text-gray-500">{{ $employer->name ?? 'N/A' }}</p>
                        <div class="tw-mt-2">
                            <span class="tw-text-xs tw-text-gray-400">Location:</span>
                            <span class="tw-text-sm tw-text-gray-600">{{ $employer->state ?? 'N/A' }}</span>
                        </div>
                        <div class="tw-mt-2">
                            <span class="tw-text-xs tw-text-gray-400">Email:</span>
                            <span class="tw-text-sm tw-text-gray-600">{{ $employer->email ?? 'N/A' }}</span>
                        </div>
                        <div class="tw-mt-2">
                            <span class="tw-text-xs tw-text-gray-400">Contact No:</span>
                            <span class="tw-text-sm tw-text-gray-600">{{ $employer->contact_no ?? 'N/A' }}</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
