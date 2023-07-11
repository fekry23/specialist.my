@props(['job'])

@php
    $status_color = '';
    switch ($job->status) {
        case 'On going':
            $status_color = '#87CEFA'; //Soft blue
            break;
        case 'Need to be reviewed':
            $status_color = '#E6E6FA'; //Pale purple
            break;
        case 'Pending payment':
            $status_color = '#FFC0CB'; //Light pink
            break;
        case 'Completed':
            $status_color = '#98FB98'; //Pale green
            break;
        default:
            break;
    }
@endphp

<a href="/trainer/jobs/{{ $job->id }}/progress" class="tw-no-underline">
    <button class="button-content" style="border-left: 4px solid {{ $status_color }}">
        <div class="id-content">
            <p>{{ $job->job_id }}</p>
        </div>
        <div class="title-content">
            <p>{{ $job->title }}</p>
        </div>
        <div class="trainer-content">
            @if ($job->profile_picture === 'freelancer-icon.png')
                <img class="tw-rounded tw-w-24" src="/images/signup-img/freelancer-icon.png" alt="">
            @else
                <img class="tw-rounded tw-w-24" src="{{ asset('storage/' . $job->profile_picture) }}" alt="">
            @endif
            <p>{{ $job->name }}</p>
        </div>
        <div class="status-content">
            <div class="status-content-color" style="background-color: {{ $status_color }};"></div>
            <p>{{ $job->status }}</p>
        </div>
    </button>
</a>
