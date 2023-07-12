@props(['previous_page', 'current_page'])

<nav class="tw-flex tw-pb-4" aria-label="Breadcrumb">
    <ol class="tw-list-none tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-3">
        <li class="tw-inline-flex tw-items-center">
            <a href="{{ route('trainer.dashboard', ['id' => auth()->id()]) }}"
                class="tw-inline-flex tw-no-underline tw-items-center tw-text-sm tw-font-medium tw-text-gray-700 tw-hover:text-blue-600 dark:tw:text-gray-400 dark:tw:hover:text-white">
                <svg aria-hidden="true" class="tw-w-4 tw-h-4 tw-mr-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                    </path>
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <div class="tw-flex tw-items-center">
                <svg aria-hidden="true" class="tw-w-6 tw-h-6 tw-text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                @if ($previous_page === 'Active Job Listings')
                    <a href="{{ route('trainer.active_jobs') }}"
                        class=" tw-no-underline tw-ml-1 tw-text-sm tw-font-medium tw-text-gray-700 tw-hover:text-blue-600 md:tw-ml-2 dark:tw:text-gray-400 dark:tw:hover:text-white">{{ $previous_page }}</a>
                @elseif($previous_page === 'Completed Job Listings')
                    <a href="{{ route('trainer.completed_jobs') }}"
                        class=" tw-no-underline tw-ml-1 tw-text-sm tw-font-medium tw-text-gray-700 tw-hover:text-blue-600 md:tw-ml-2 dark:tw:text-gray-400 dark:tw:hover:text-white">{{ $previous_page }}</a>
                @endif

            </div>
        </li>
        <li aria-current="page">
            <div class="tw-flex tw-items-center">
                <svg aria-hidden="true" class="tw-w-6 tw-h-6 tw-text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>

                <span class="tw-ml-1 tw-text-sm tw-font-medium tw-text-gray-500 md:tw-ml-2 dark:tw:text-gray-400">
                    {{ $current_page }}</span>


            </div>
        </li>
    </ol>
</nav>
