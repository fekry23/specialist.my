@props(['job'])


@php
    $statusColors = [
        'On going' => 'tw-bg-on_going',
        'Need to be reviewed' => 'tw-bg-review',
        'Pending payment' => 'tw-bg-pending',
        'Completed' => 'tw-bg-completed',
    ];
    
    $statusColor = $statusColors[$job->status] ?? 'tw-bg-gray-500';
@endphp

<td class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-border-b tw-border-gray-500">
    <div class="tw-flex tw-items-center">
        <div>
            <div class="tw-text-sm tw-leading-5 tw-text-gray-800">#{{ $job->job_id }}</div>
        </div>
    </div>
</td>
<td class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-border-b tw-border-gray-500 tw-w-2/5">
    <div class="tw-text-sm tw-leading-5 tw-text-blue-900">{{ $job->title }}</div>
</td>
<td
    class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-border-b tw-text-blue-900 tw-border-gray-500 tw-text-sm tw-leading-5">
    <div class="tw-flex tw-items-center">
        @if ($job->image)
            <img class="tw-w-10 tw-h-10 tw-rounded-full" src="{{ url('/images/find-candidate/' . $job->image) }}"
                alt="">
        @endif
        <p class="tw-ml-2">{{ $job->name }}</p>
    </div>
</td>
<td
    class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-text-center tw-border-b tw-text-blue-900 tw-border-gray-500 tw-text-sm tw-leading-5">
    <span class="tw-relative tw-inline-block tw-px-3 tw-py-1 tw-font-semibold tw-rounded-full {{ $statusColor }}">
        <span aria-hidden class="tw-absolute tw-inset-0 tw-rounded-full tw-opacity-50"></span>
        <span class="tw-relative tw-text-xs">{{ $job->status }}</span>
    </span>

</td>
<td class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-text-center tw-border-b tw-border-gray-500 tw-text-sm tw-leading-5">
    {{-- Show applicants button if there's no specialist hired --}}
    @if ($job->status == 'On going' && !$job->name)
        <a href="{{ route('employer.show_job_applicants', ['job' => $job->id]) }}" class="tw-no-underline">
            <button type="button"
                class="tw-px-5 tw-py-2 tw-bg-white tw-border-blue-500 tw-border tw-text-blue-500 tw-rounded tw-transition tw-duration-300 {{ $job && $job->name ? 'tw-cursor-not-allowed tw-opacity-50' : 'tw-cursor-pointer hover:tw-bg-blue-700 hover:tw-text-white focus:tw-outline-none' }}"
                {{ $job && $job->name ? 'disabled' : '' }}>
                Applicants
                <span
                    class="tw-inline-flex tw-items-center tw-justify-center tw-w-min tw-h-4 tw-px-2 tw-text-xs tw-font-semibold tw-text-blue-800 tw-bg-blue-200 tw-rounded-full tw-flex-grow-0">
                    {{ $job->applicant_counter }}
                </span>
            </button>
        </a>
        {{-- Pending Payment Button --}}
    @elseif($job->status == 'Pending payment' && $job->name)
        <a href="{{ url('/employer/jobs/' . $job->job_id . '/' . $job->rate . '/payment') }}" class="tw-no-underline">
            <button type="button"
                class="tw-px-5 tw-py-2 tw-bg-white tw-border-blue-500 tw-border tw-text-blue-500 tw-rounded tw-transition tw-duration-300 tw-cursor-pointer hover:tw-bg-blue-700 hover:tw-text-white focus:tw-outline-non">
                Make Payment
            </button>
        </a>
        {{-- Review Button --}}
    @elseif($job->status == 'Need to be reviewed' && $job->name)
        <a href="" class="tw-no-underline">
            <button type="button"
                class="tw-px-5 tw-py-2 tw-bg-white tw-border-blue-500 tw-border tw-text-blue-500 tw-rounded tw-transition tw-duration-300 tw-cursor-pointer hover:tw-bg-blue-700 hover:tw-text-white focus:tw-outline-non">
                Give Review
            </button>
        </a>
    @endif

    <a href="/employer/jobs/{{ $job->job_id }}/progress" class="tw-no-underline">
        <button
            class="tw-px-5 tw-py-2 tw-cursor-pointer tw-bg-white tw-border-blue-500 tw-border tw-text-blue-500 tw-rounded tw-transition tw-duration-300 hover:tw-bg-blue-700 hover:tw-text-white focus:tw-outline-none">View
            Progress</button>
    </a>
</td>
