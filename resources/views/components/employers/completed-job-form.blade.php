@props(['job', 'trainer', 'employer', 'finishTime'])

<div id="completed-job-form"
    class="tw-fixed tw-inset-0 tw-hidden tw-items-center tw-justify-center tw-bg-gray-50 tw-bg-opacity-50">
    <div class="tw-max-w-2xl tw-px-4 tw-py-8 tw-mx-auto lg:tw-py-16">
        <div class="tw-flex tw-flex-col tw-p-5 tw-rounded-lg tw-shadow tw-bg-white">
            <h2 class="tw-mb-4 tw-text-xl tw-font-bold tw-text-gray-900 dark:tw-text-white">Update Job Status</h2>
            <form method="POST" action="/employer/jobs/{{ $job->id }}/update-job-status/{{ $trainer->id }}"
                enctype="multipart/form-data">
                @csrf
                <div class="tw-grid tw-gap-4 tw-mb-4 sm:tw-grid-cols-2 sm:tw-gap-6 sm:tw-mb-5">
                    {{-- Job Title --}}
                    <div class="tw-col-span-2">
                        <label for="title"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Job
                            Title</label>
                        <input type="text" name="title" id="title"
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500"
                            value="{{ $job->title }}" disabled>
                    </div>
                    <div class="tw-w-full">
                        <label for="employer-name"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Employer
                            Name</label>
                        <input type="text" name="employer-name" id="employer-name"
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500"
                            value="{{ $employer->name }}" disabled>
                        <input type="hidden" id="employer_id" name="employer_id" value="{{ $employer->id }}">

                    </div>
                    <div class="tw-w-full">
                        <label for="trainer-name"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Trainer
                            Name</label>
                        <input type="text" name="trainer-name" id="trainer-name"
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500"
                            value="{{ $trainer->name }}" disabled>
                    </div>
                    <div class="tw-w-full">
                        <label for="job-type"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Job
                            Type</label>
                        <input type="text" name="job-type" id="job-type"
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500"
                            value="{{ $job->type }}" disabled>
                    </div>
                    <div class="tw-w-full">
                        <label for="job-rate"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Job
                            Rate</label>
                        <input type="text" name="job-rate" id="job-rate"
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500"
                            value="{{ $job->rate }}" disabled>
                    </div>

                    <div class="tw-col-span-2">
                        <label for="finish_time"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Time
                            Completed</label>
                        <div class="tw-relative tw-max-w-sm">
                            <div
                                class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3 tw-pointer-events-none">
                                <svg aria-hidden="true" class="tw-w-5 tw-h-5 tw-text-gray-500 dark:tw-text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="finish_time"
                                class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring-blue-500 focus:tw-border-blue-500 tw-block tw-w-full tw-pl-10 tw-p-2.5 tw-dark:bg-gray-700 tw-dark:border-gray-600 tw-dark:placeholder-gray-400 tw-dark:text-white tw-dark:focus:ring-blue-500 tw-dark:focus:border-blue-500"
                                value="{{ $finishTime }}" disabled>
                        </div>

                    </div>



                    <div class="tw-col-span-2">
                        <label for="description"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Description</label>
                        <textarea id="description" name="description" rows="8"
                            class="tw-block tw-px-5 tw-py-2.5 tw-w-full tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300 tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500"
                            placeholder="Write a description for the completed job here...">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="tw-col-span-2">
                        <label class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white"
                            for="completed_attachment">Upload file for proof</label>
                        <input
                            class="tw-block tw-w-full tw-text-sm tw-text-gray-900 tw-border tw-border-gray-300 tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 focus:tw-outline-none"
                            aria-describedby="file_input_help" id="completed_attachment" name="completed_attachment"
                            type="file">
                        <p class="tw-mt-1 tw-text-sm tw-text-gray-500" id="file_input_help">
                            File must be in PNG, JPG, or DOCX format and should not exceed 8MB in size.
                        </p>


                        @error('completed_attachment')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="tw-flex tw-items-center tw-space-x-4">
                    <button type="submit"
                        class="tw-px-5 tw-py-2.5 tw-bg-cyan-50 hover:tw-bg-cyan-100 tw-text-cyan-500 tw-text-sm tw-font-medium tw-rounded-md">
                        Update Job Status
                    </button>
                    <button type="button" id="cancel-completed-job-btn"
                        class="tw-text-gray-900 tw-inline-flex tw-items-center hover:tw-text-white tw-border tw-border-gray-300 hover:tw-bg-gray-300 hover:tw-text-white tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
