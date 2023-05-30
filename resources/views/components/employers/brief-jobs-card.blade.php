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

<a href="/employer/jobs/{{ $job->id }}" class="tw-no-underline">
    <button class="button-content" style="border-left: 4px solid {{ $status_color }}">
        <div class="id-content">
            <p>{{ $job->job_id }}</p>
        </div>
        <div class="title-content">
            <p>{{ $job->title }}</p>
        </div>
        <div class="trainer-content">
            <img src="{{ url('/images/find-candidate/' . $job->image) }}" alt="">
            <p>{{ $job->name }}</p>
        </div>
        <div class="status-content">
            <div class="status-content-color" style="background-color: {{ $status_color }};"></div>
            <p>{{ $job->status }}</p>
        </div>
    </button>
</a>
