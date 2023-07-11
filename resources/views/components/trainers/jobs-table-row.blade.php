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
        @if ($job->profile_picture === 'freelancer-icon.png')
            <img class="tw-w-10 tw-h-10 tw-rounded-full" src="{{ url('/images/signup-img/' . $job->profile_picture) }}"
                alt="">
        @else
            <img class="tw-w-10 tw-h-10 tw-rounded-full" src="{{ asset('storage/' . $job->profile_picture) }}"
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

    <a href="/trainer/jobs/{{ $job->job_id }}/progress" class="tw-no-underline">
        <button
            class="tw-px-5 tw-py-2 tw-cursor-pointer tw-bg-white tw-border-blue-500 tw-border tw-text-blue-500 tw-rounded tw-transition tw-duration-300 hover:tw-bg-blue-700 hover:tw-text-white focus:tw-outline-none">View
            Progress</button>
    </a>
</td>
