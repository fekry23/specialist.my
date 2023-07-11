@props(['jobs', 'trainer_id'])

<div id="offer-job-form"
    class="tw-fixed tw-inset-0 {{ $errors->any() ? 'tw-flex' : 'tw-hidden' }} tw-items-center tw-justify-center tw-bg-gray-50 tw-bg-opacity-50">
    <div class="tw-max-w-2xl tw-px-4 tw-py-8 tw-mx-auto lg:tw-py-16">
        <div class="tw-flex tw-w-[32rem] tw-flex-col tw-p-5 tw-rounded-lg tw-shadow tw-bg-white">
            <h2 class="tw-mb-4 tw-text-xl tw-font-bold tw-text-gray-900 dark:tw-text-white">Offer a Job</h2>
            <form method="POST" action="/employer/jobs/offer">
                @csrf
                <div class="tw-grid tw-gap-4 tw-mb-4 sm:tw-grid-cols-2 sm:tw-gap-6 sm:tw-mb-5">
                    {{-- Select a job --}}
                    <div class="tw-col-span-2">
                        <label for="job_id"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Select
                            a Job</label>
                        <select name="job_id" id="job_id"
                            class="tw-bg-gray-50 tw-border tw-border-gray-300 tw-text-gray-900 tw-text-sm tw-rounded-lg tw-focus:tw-ring-primary-600 tw-focus:tw-border-primary-600 tw-block tw-w-full tw-p-2.5 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500">
                            <option value="" selected>Choose a job</option>
                            @foreach ($jobs as $job)
                                <option value="{{ $job->id }}">{{ $job->id }} - {{ $job->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="tw-col-span-2">
                        <label for="description"
                            class="tw-block tw-mb-2 tw-text-sm tw-font-medium tw-text-gray-900 dark:tw-text-white">Description</label>
                        <textarea id="description" name="description" rows="8"
                            class="tw-block tw-px-5 tw-py-2.5 tw-w-full tw-text-sm tw-text-gray-900 tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-300 tw-focus:tw-ring-primary-500 tw-focus:tw-border-primary-500 dark:tw-bg-gray-700 dark:tw-border-gray-600 dark:tw-placeholder-gray-400 dark:tw-text-white dark:tw-focus:tw-ring-primary-500 dark:tw-focus:tw-border-primary-500"
                            placeholder="Write a description for the offer here..." required>{{ old('description') }}</textarea>

                        @error('description')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="hidden" name="trainer_id" value="{{ $trainer_id }}">
                </div>
                <div class="tw-flex tw-items-center tw-space-x-4">
                    <button type="submit"
                        class="tw-px-5 tw-py-2.5 tw-bg-cyan-50 hover:tw-bg-cyan-100 tw-text-cyan-500 tw-text-sm tw-font-medium tw-rounded-md">
                        Offer
                    </button>
                    <button type="button" id="cancel-offer-job-btn"
                        class="tw-text-gray-900 tw-inline-flex tw-items-center hover:tw-text-white tw-border tw-border-gray-300 hover:tw-bg-gray-300 hover:tw-text-white tw-font-medium tw-rounded-lg tw-text-sm tw-px-5 tw-py-2.5 tw-text-center">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
