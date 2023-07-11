@props(['application'])

<li class="tw-py-3 sm:tw-py-4">
    <a href="{{ route('employer.show_detailed_applicant', ['job' => $application->job_id, 'applicant_id' => $application->id]) }}"
        class="tw-flex tw-items-center tw-space-x-4 tw-w-full">
        <div class="tw-flex-shrink-0">
            @if (isset($application->image) && file_exists(public_path('/images/find-candidate/' . $application->image)))
                <img src="{{ url('/images/find-candidate/' . $application->image) }}"
                    alt="{{ $application->name ?? 'Trainer' }} Profile Image" class="tw-w-8 tw-h-8 tw-rounded-full">
            @else
                <img src="/images/signup-img/freelancer-icon.png"
                    alt="{{ $application->name ?? 'Trainer' }} Profile Image" class="tw-w-8 tw-h-8 tw-rounded-full">
            @endif
        </div>
        <div class="tw-flex-1 tw-min-w-0">
            <p class="tw-text-sm tw-font-medium tw-text-gray-900 tw-truncate dark:tw-text-white tw-text-left">
                {{ $application->name }}
            </p>
            <p class="tw-text-sm tw-text-gray-500 tw-truncate dark:tw-text-gray-400 tw-text-left">
                {{ $application->email }}
            </p>
        </div>
        <div class="tw-inline-flex tw-items-center tw-text-base tw-font-semibold tw-text-gray-900 dark:tw-text-white">
            RM {{ $application->rates ?? 0 }}
        </div>
    </a>
</li>
