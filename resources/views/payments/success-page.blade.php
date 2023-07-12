@extends('layout')

@section('styles')
@endsection

@section('content')
    <div class="tw-flex tw-justify-center tw-items-center tw-h-screen">
        <div class="tw-max-w-lg tw-h-80 tw-p-6 tw-bg-white tw-border tw-border-gray-200 tw-rounded-lg tw-shadow">
            <a href="/employer/jobs/completed-jobs">
                <h5 class="tw-mb-2 tw-text-2xl tw-font-bold tw-tracking-tight tw-text-gray-900 tw-dark:text-white">Payment
                    successful</h5>
            </a>
            <div class="tw-h-24">
                <p class="tw-mb-3 tw-font-normal tw-text-gray-700 tw-dark:text-gray-400">
                    Congratulations! Your payment has been successfully processed.</p>
            </div>

            <a href="/employer/jobs/completed-jobs"
                class="tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-text-center tw-text-white tw-bg-blue-700 tw-rounded-lg tw-hover:bg-blue-800 tw-focus:ring-4 tw-focus:outline-none tw-focus:ring-blue-300 tw-dark:bg-blue-600 tw-dark:hover:bg-blue-700 tw-dark:focus:ring-blue-800">
                Go to Completed Jobs
                <svg aria-hidden="true" class="tw-w-4 tw-h-4 tw-ml-2 tw--mr-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
