@props(['application'])


@php
    $statusColors = [
        'Applied' => 'tw-bg-blue-500 tw-text-white',
        'Accepted' => 'tw-bg-green-500 tw-text-white',
        'Offered' => 'tw-bg-yellow-500 tw-text-white', // You can choose an appropriate class for the offered status color
        'Rejected' => 'tw-bg-red-500 tw-text-white',
    ];
    
    $statusColor = $statusColors[$application->application_status] ?? 'tw-bg-gray-500';
@endphp

<td class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-border-b tw-border-gray-500">
    <div class="tw-flex tw-items-center">
        <div>
            <div class="tw-text-sm tw-leading-5 tw-text-gray-800">#{{ $application->id }}</div>
        </div>
    </div>
</td>
<td class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-border-b tw-border-gray-500">
    <div class="tw-text-sm tw-leading-5 tw-text-blue-900">{{ $application->job_title }}</div>
</td>
<td class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-border-b tw-border-gray-500">
    <div class="tw-text-sm tw-leading-5 tw-text-blue-900">{{ $application->description }}</div>
</td>
<td
    class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-text-center tw-border-b tw-text-blue-900 tw-border-gray-500 tw-text-sm tw-leading-5">
    <span class="tw-relative tw-inline-block tw-px-3 tw-py-1 tw-font-semibold tw-rounded-full {{ $statusColor }}">
        <span aria-hidden class="tw-absolute tw-inset-0 tw-rounded-full tw-opacity-50"></span>
        <span class="tw-relative tw-text-xs">{{ $application->application_status }}</span>
    </span>

</td>
<td class="tw-px-6 tw-py-4 tw-whitespace-no-wrap tw-text-center tw-border-b tw-border-gray-500 tw-text-sm tw-leading-5">

    <a href="/find-job/{{ $application->job_id }}" class="tw-no-underline">
        <button
            class="tw-px-5 tw-py-2 tw-cursor-pointer tw-bg-white tw-border-blue-500 tw-border tw-text-blue-500 tw-rounded tw-transition tw-duration-300 hover:tw-bg-blue-700 hover:tw-text-white focus:tw-outline-none tw-w-32">View
            Job</button>
    </a>

    @if ($application->application_status == 'Applied' || $application->application_status == 'Rejected')
        <form method="POST" action="/trainer/jobs/job-applications/{{ $application->id }}/withdraw">
            @csrf
            @method('DELETE')
            <button
                class="tw-px-5 tw-py-2 tw-mt-2 tw-cursor-pointer tw-bg-white tw-border-blue-500 tw-border tw-text-blue-500 tw-rounded tw-transition tw-duration-300 hover:tw-bg-blue-700 hover:tw-text-white focus:tw-outline-none tw-w-32">Withdraw</button>
        </form>
    @endif

    @if ($application->application_status == 'Offered')
        <form method="POST" action="/trainer/jobs/job-applications/{{ $application->id }}/accept">
            @csrf
            @method('PUT')
            <button
                class="tw-px-5 tw-py-2 tw-mt-2 tw-cursor-pointer tw-bg-white tw-border-blue-500 tw-border tw-text-blue-500 tw-rounded tw-transition tw-duration-300 hover:tw-bg-blue-700 hover:tw-text-white focus:tw-outline-none tw-w-32">Accept</button>
        </form>

        <form method="POST" action="/trainer/jobs/job-applications/{{ $application->id }}/reject">
            @csrf
            @method('PUT')
            <button
                class="tw-px-5 tw-py-2 tw-mt-2 tw-cursor-pointer tw-bg-red-600 tw-text-white hover:tw-bg-white hover:tw-text-red-600  tw-font-semibold tw-border tw-border-gray-400 tw-rounded tw-transition tw-duration-300 focus:tw-outline-none tw-w-32">Reject</button>
        </form>
    @endif

</td>
