<div id="apply-job-form"
    class="tw-fixed tw-inset-0 tw-hidden tw-items-center tw-justify-center tw-bg-gray-50 tw-bg-opacity-50">
    <div class="tw-w-96 tw-px-4 tw-py-8 tw-mx-auto lg:tw-py-16">
        <div class="tw-flex tw-flex-col tw-p-5 tw-rounded-lg tw-shadow tw-bg-white">
            <h2 class="tw-mb-4 tw-text-xl tw-font-bold tw-text-gray-900 dark:tw-text-white">Apply Job</h2>
            <form method="POST" action="/trainer/jobs/job-applications/{{ $job->id }}/apply">
                @csrf
                <div class="tw-grid tw-gap-4 tw-mb-4 sm:tw-grid-cols-2 sm:tw-gap-6 sm:tw-mb-5">
                    {{-- Job Title --}}
                    <div class="tw-col-span-2">
                        <label for="description"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Description</label>
                        <textarea id="description" name="description" rows="8"
                            class="tw-block tw-px-5 tw-py-2.5 tw-w-full tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300 tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500"
                            placeholder="Write a description for the job application here..." required>{{ old('description') }}</textarea>

                        @error('description')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="tw-flex tw-items-center tw-space-x-4">
                    <button type="submit"
                        class="tw-px-5 tw-py-2.5 tw-bg-cyan-50 hover:tw-bg-cyan-100 tw-text-cyan-500 tw-text-sm tw-font-medium tw-rounded-md">
                        Apply
                    </button>
                    <button type="button" id="cancel-apply-job-btn"
                        class="tw-text-gray-900 tw-inline-flex tw-items-center hover:tw-text-white tw-border tw-border-gray-300 hover:tw-bg-gray-300 hover:tw-text-white tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
