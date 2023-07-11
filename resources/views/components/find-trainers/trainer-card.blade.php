@props(['trainer', 'reviewsCount', 'averageStars']) {{-- coming from find-trainers/index.blade.php file --}}
{{-- In Laravel, "props" (short for "properties") typically 
refer to the data that is passed from a parent component to a 
child component. --}}

<div class="display-overview">
    <!-- Button, need to be modified using PHP in the future -->
    <button id="overview-button" onclick="window.location.href='/find-candidate/{{ $trainer->id }}'">
        <div class="display-overview-img">
            @if (isset($trainer->image) && file_exists(public_path('/images/find-candidate/' . $trainer->image)))
                <img src="{{ url('/images/find-candidate/' . $trainer->image) }}"
                    alt="{{ $trainer->name ?? 'Trainer' }} Profile Image" class="tw-rounded tw-w-16 tw-h-16">
            @else
                <img src="/images/signup-img/{{ $trainer->image }}"
                    alt="{{ $application->name ?? 'Trainer' }} Profile Image" class="tw-rounded tw-w-16 tw-h-16">
            @endif
            <div class="name-state">
                <h3 id="overview-name">{{ $trainer->name }}</h3>

                <h4 id="overview-state">{{ $trainer->state }}</h4>
            </div>
        </div>

        <div class="tw-flex tw-flex-row tw-justify-start tw-pt-4">
            <div class="tw-text-sm tw-font-bold tw-text-gray-900 dark:tw-text-white"> RM{{ $trainer->hourly_rate ?? 0 }}
                <span class="tw-text-gray-500">/ Hour</span>
            </div>

            <div class="tw-flex tw-items-center tw-ml-5">
                <svg aria-hidden="true" class="tw-w-5 tw-h-5 tw-text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <title>Rating star</title>
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                </svg>
                <p class="tw-ml-2 tw-text-sm tw-font-bold tw-text-gray-900 dark:tw-text-white">
                    {{ $averageStars[$trainer->id] ?? 0 }}</p>
                <span class="tw-w-1 tw-h-1 tw-mx-1.5 tw-bg-gray-500 tw-rounded-full dark:tw-bg-gray-400"></span>
                <a href="#"
                    class="tw-text-sm tw-font-medium tw-text-gray-900 tw-no-underline hover:tw-no-underline dark:tw-text-white">{{ $reviewsCount[$trainer->id] ?? 0 }}
                    reviews</a>
            </div>
        </div>

        <div class="display-overview-parapgraph tw-pt-2" id="overviewParagraph">

            @isset($trainer->specialization_description)
                <p class="tw-text-gray-500">
                    {{ Str::words(strip_tags($trainer->specialization_description), $words = 33, $end = ' ...') }}</p>
            @else
                <p class="tw-text-gray-500">No description available</p>
            @endisset

            <!-- Ratings, need to be modified using PHP in the future -->

            <!-- Ratings, need to be modified using PHP in the future -->
        </div>




    </button>

</div>
