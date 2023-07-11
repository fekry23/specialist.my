@extends('layout')

@section('styles')
@endsection

@section('content')
    {{-- Container Div --}}
    <div class="tw-container tw-flex tw-mx-auto tw-px-4 tw-py-8 tw-h-screen">

        <!-- Left Container Content -->
        <div class="tw-w-1/3">
            {{-- Job Applicants card --}}
            <div
                class="tw-w-full tw-max-w-md tw-p-4 tw-bg-white tw-border tw-border-solid tw-border-gray-200 tw-rounded-lg tw-shadow sm:tw-p-8 dark:tw-bg-gray-800 dark:tw-border-gray-700">
                <div class="tw-flex tw-items-center tw-justify-between tw-mb-4">
                    <h5 class="tw-text-xl tw-font-bold tw-leading-none tw-text-gray-900 dark:tw-text-white">Latest Applicants
                    </h5>
                </div>
                <div class="tw-flow-root">
                    <ul role="list" class="tw-divide-y tw-divide-gray-200 dark:tw-divide-gray-700">
                        @if ($applications->isEmpty())
                            <div class="tw-flex tw-flex-col tw-items-center">
                                <img src="/images/find-job/not-found.png" alt="" class="tw-w-96 tw-h-96 tw-mt-20">
                                <h2 class="tw-text-center tw-text-xl tw-font-semibold tw-mt-4">No Applicants</h2>
                            </div>
                        @else
                            @foreach ($applications as $application)
                                <x-employers.job-applicants-card :application="$application" />
                            @endforeach
                        @endif
                    </ul>
                    <div class="tw-mt-6 tw-p-4">
                        {{ $applications->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>

        </div>
        <!-- Right Container Content -->
        <div class="tw-w-2/3">

            {{-- Job Applicants card --}}
            <div
                class="tw-flex-none tw-w-full tw-p-4 tw-bg-white tw-border tw-border-solid tw-border-gray-200 tw-rounded-lg tw-shadow sm:tw-p-8">
                <x-employers.jobs-breadcrumb :previous_page="'Active Job Listings'" :current_page="'Specialist Applicants'" />

                <h1
                    class="tw-mb-4 tw-text-3xl tw-font-extrabold tw-text-gray-900 tw-dark:text-white tw-md:text-5xl tw-lg:text-6xl">
                    <span
                        class="tw-text-transparent tw-bg-clip-text tw-bg-gradient-to-r tw-to-emerald-600 tw-from-sky-400">{{ $job->title }}</span>
                    Specialist Applications.
                </h1>
                <p class="tw-text-lg tw-font-normal tw-text-gray-500 tw-lg:text-xl tw-dark:text-gray-400">
                    Explore Specialist Applicants: Find Your Ideal Fit for the Job
                </p>

                @isset($selected_applicant)
                    {{-- Action Button --}}
                    <div class="tw-flex tw-justify-between tw-pt-4 tw-pb-8">
                        {{-- Left button --}}
                        <div>
                            <a href="/find-candidate/{{ $selected_applicant->trainer_id }}">
                                <button type="button"
                                    class="tw-px-5 tw-py-2 tw-cursor-pointer tw-bg-blue-500 tw-border tw-border-blue-500 tw-text-white tw-transition tw-duration-300 hover:tw-bg-white hover:tw-text-blue-500 focus:tw-outline-none">
                                    View Profile
                                </button>
                            </a>
                        </div>

                        {{-- Right button --}}
                        <div class="tw-flex">
                            <button type="button" id="approve-btn"
                                class="tw-px-5 tw-py-2 tw-cursor-pointer tw-bg-green-500 tw-border tw-border-green-500 tw-text-white tw-transition tw-duration-300 hover:tw-bg-white hover:tw-text-green-500 focus:tw-outline-none">
                                Approve
                            </button>
                            <button type="button" id="reject-btn"
                                class="tw-px-5 tw-py-2 tw-cursor-pointer tw-bg-red-400 tw-border tw-border-red-400 tw-text-white tw-transition tw-duration-300 hover:tw-bg-white hover:tw-text-red-400 focus:tw-outline-none">
                                Reject
                            </button>
                        </div>
                    </div>





                    {{-- Image Div --}}
                    <div class="tw-flex tw-justify-center tw-pb-8">
                        @if (isset($selected_applicant->image) &&
                                file_exists(public_path('/images/find-candidate/' . $selected_applicant->image)))
                            <img src="{{ url('/images/find-candidate/' . $selected_applicant->image) }}"
                                alt="{{ $selected_applicant->name ?? 'Trainer' }} Profile Image"
                                class="tw-rounded tw-w-44 tw-h-44 tw-mx-auto">
                        @else
                            <img src="/images/signup-img/freelancer-icon.png"
                                alt="{{ $selected_applicant->name ?? 'Trainer' }} Profile Image"
                                class="tw-rounded tw-w-44 tw-h-44 tw-mx-auto">
                        @endif
                    </div>

                    {{-- Name --}}
                    <div class="tw-flex tw-justify-center tw-pb-8">
                        <h2 class="tw-text-4xl tw-font-bold dark:tw-text-white">
                            {{ $selected_applicant->name }}
                        </h2>
                    </div>

                    {{-- Application Information --}}
                    <div class="grid tw-grid-cols-4 tw-gap-4">
                        <div class="tw-col-span-1">
                            <h2 class="tw-text-lg tw-font-bold tw-mb-2">Job ID Applied</h2>
                            <p class="tw-text-gray-700 tw-font-medium">{{ $selected_applicant->job_id }}</p>
                        </div>
                        <div class="tw-col-span-4">
                            <h2 class="tw-text-lg tw-font-bold tw-mb-2">Application Description</h2>
                            <p class="tw-text-gray-800">{{ $selected_applicant->description }}</p>
                        </div>
                        <div class="tw-col-span-4">
                            <h2 class="tw-text-lg tw-font-bold tw-mb-2">Applied Time</h2>
                            <p class="tw-text-gray-700">{{ $selected_applicant->applied_time }}</p>
                        </div>
                    </div>
                @endisset
            </div>

        </div>

        {{-- Confirmation Popup --}}
        @isset($selected_applicant)
            <div id="approve-popup"
                class="tw-fixed tw-inset-0 tw-hidden tw-items-center tw-justify-center tw-bg-gray-50 tw-bg-opacity-50">
                <x-employers.applicants-confirmation-popup :applicant_action="'Accept'" :selected_applicant="$selected_applicant" />
            </div>

            <div id="reject-popup"
                class="tw-fixed tw-inset-0 tw-hidden tw-items-center tw-justify-center tw-bg-gray-50 tw-bg-opacity-50">
                <x-employers.applicants-confirmation-popup :applicant_action="'Reject'" :selected_applicant="$selected_applicant" />
            </div>
        @endisset
    </div>
@endsection

@section('scripts')
    {{-- Confirmation Popup --}}
    <script>
        // Function to show the popup element
        function showPopup(popup) {
            popup.classList.remove("tw-hidden");
            popup.classList.add("tw-flex");
        }

        // Function to hide the popup element
        function hidePopup(popup) {
            popup.classList.remove("tw-flex");
            popup.classList.add("tw-hidden");
        }

        // Event delegation to handle click events
        document.addEventListener("click", function(event) {
            // Check if the clicked element has the "approve-btn" or "reject-btn" ID
            if (event.target.id === "approve-btn") {
                showPopup(document.getElementById("approve-popup"));
            } else if (event.target.id === "reject-btn") {
                showPopup(document.getElementById("reject-popup"));
            } else if (event.target.id === "cancel-btn") {
                hidePopup(document.getElementById("approve-popup"));
                hidePopup(document.getElementById("reject-popup"));
            }
        });
    </script>
@endsection
