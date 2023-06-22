@props(['review'])

<article class="tw-py-3">
    <div class="tw-flex tw-items-center tw-mb-4 tw-space-x-4">
        <img class="tw-w-10 tw-h-10 tw-rounded-full" src="/images/signup-img/freelancer-icon.png" alt="">
        <div class="tw-space-y-1 tw-font-medium dark:tw-text-white">
            <p>{{ $review->employer_name }} <time datetime="2014-08-16 19:00"
                    class="tw-block tw-text-sm tw-text-gray-500 dark:tw-text-gray-400">Joined on
                    {{ $review->created_at }}</time></p>
        </div>
    </div>
    <div class="tw-flex tw-items-center tw-mb-1">
        {{-- Yellow Star --}}
        @for ($i = 0; $i < $review->rating_value; $i++)
            <svg aria-hidden="true" class="tw-w-5 tw-h-5 tw-text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <title>{{ $review->rating_value }} star</title>
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
        @endfor
        {{-- Gray Star --}}
        @for ($i = 0; $i < 5 - $review->rating_value; $i++)
            <svg aria-hidden="true" class="tw-w-5 tw-h-5 tw-text-gray-300" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <title>{{ $review->rating_value }} star</title>
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
        @endfor
        <h3 class="tw-ml-2 tw-text-sm tw-font-semibold tw-text-gray-900 tw-dark:text-white">{{ $review->review_title }}
        </h3>
    </div>
    <p class="tw-mb-2 tw-text-gray-500 tw-dark:text-gray-400">{{ $review->review_description }}
    </p>
</article>
