@props(['status'])

@php
    $statusColors = [
        'On going' => 'tw-bg-on_going',
        'Need to be reviewed' => 'tw-bg-review',
        'Pending payment' => 'tw-bg-pending',
        'Completed' => 'tw-bg-completed',
    ];
    
    $statusColor = $statusColors[$status->status_from_status_tracker_table] ?? 'tw-bg-gray-500';
@endphp

<li class="tw-mb-10 tw-ml-4">
    <div
        class="tw-absolute tw-w-3 tw-h-3 tw-rounded-full tw-mt-1.5 tw--left-1.5 tw-border tw-border-white {{ $statusColor }}">
    </div>
    <time
        class="tw-mb-1 tw-text-sm tw-font-normal tw-leading-none tw-text-gray-400 dark:tw-text-gray-500">{{ $status->formatted_updated_at }}</time>
    <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900 dark:tw-text-white">
        <span class="tw-inline-flex tw-items-center">
            {{ $status->status_from_status_tracker_table }}
            {{-- If status from jobs table is not the same as status in status tracker table, it will appear checkmark --}}
            @if ($status->status_from_jobs_table != $status->status_from_status_tracker_table)
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" class="tw-ml-1">
                    <path
                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.393 7.5l-5.643 5.784-2.644-2.506-1.856 1.858 4.5 4.364 7.5-7.643-1.857-1.857z"
                        fill="green" />
                </svg>
            @endif
        </span>
    </h3>

    <p class="tw-mb-4 tw-text-base tw-font-normal tw-text-gray-500 dark:tw-text-gray-400">{{ $status->description }}</p>

    {{-- Display Job Completed button if the job is done. It will update status Pending payment in job table --}}
    @if ($status->status_from_jobs_table == $status->status_from_status_tracker_table && isset($status->trainer_id))
        @if ($status->status_from_jobs_table == 'On going')
            <button id="completed-job-btn"
                class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-900 tw-bg-white tw-border tw-border-solid tw-border-gray-200 tw-rounded-lg hover:tw-bg-gray-100 focus:tw-z-10 focus:tw-ring-4 focus:tw-outline-none focus:tw-ring-gray-200">
                Job Completed
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                    class="tw-ml-2">
                    <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z" />
                </svg>
            </button>
        @elseif ($status->status_from_jobs_table == 'Pending payment')
            <button id="pending-payment-job-btn"
                class="tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-900 tw-bg-white tw-border tw-border-solid tw-border-gray-200 tw-rounded-lg hover:tw-bg-gray-100 focus:tw-z-10 focus:tw-ring-4 focus:tw-outline-none focus:tw-ring-gray-200">
                Make Payment
                <svg fill="none" stroke="currentColor" width="18" height="18" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" class="tw-ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z">
                    </path>
                </svg>
            </button>
        @endif
    @endif


    {{-- Display Job Completed button if the job is done. It will update status Pending payment in job table --}}


    {{-- If there's no specialist, display a button for the employer to find a specialist first --}}
    @empty($status->trainer_id)
        <a href="/find-candidate" class="tw-no-underline">
            <button
                class="tw-px-5 tw-py-2 tw-border tw-border-blue-500 tw-rounded tw-cursor-pointer tw-transition tw-duration-300 tw-text-white tw-bg-gradient-to-r tw-from-blue-500 tw-to-blue-700 hover:tw-from-blue-600 hover:tw-to-blue-800 focus:tw-outline-none">Find
                a Specialist</button>
            <p class="tw-my-4 tw-text-base tw-font-normal tw-text-gray-500 dark:tw-text-gray-400">You need to hire a
                specialist first!</p>
        </a>
    @endempty


    {{-- Display Attachment File if Job is completed --}}
    @if ($status->attachment_path && $status->status_from_status_tracker_table == 'Completed')
        <a href="#"
            class="tw-inline-flex tw-items-center tw-no-underline tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-900 tw-bg-white tw-border tw-border-solid tw-border-gray-200 tw-rounded-lg tw-hover:bg-gray-100 tw-hover:text-blue-700 tw-focus:tw-z-10 tw-focus:tw-ring-4 tw-focus:tw-outline-none tw-focus:tw-ring-gray-200 tw-focus:tw-text-blue-700 dark:tw:bg-gray-800 dark:tw-text-gray-400 dark:tw-border-gray-600 dark:tw-hover:text-white dark:tw-hover:bg-gray-700 dark:tw-focus:tw-ring-gray-700">
            <svg class="tw-w-4 tw-h-4 tw-mr-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                    clip-rule="evenodd"></path>
            </svg> Download File
        </a>
    @endif

</li>
