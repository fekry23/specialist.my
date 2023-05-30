@props(['job', 'trainer'])

<div id="confirm-popup"
    class="tw-fixed tw-inset-0 tw-hidden tw-items-center tw-justify-center tw-bg-gray-50 tw-bg-opacity-50">
    <div class="tw-w-full md:tw-w-1/3 tw-mx-auto">
        <div class="tw-flex tw-flex-col tw-p-5 tw-rounded-lg tw-shadow tw-bg-white">
            <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                <div class="tw-inline-block tw-p-4 tw-bg-cyan-50 tw-rounded-full">
                    <svg class="tw-w-12 tw-h-12 tw-fill-current tw-text-cyan-500" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M12 5.99L19.53 19H4.47L12 5.99M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v4h2v-4z" />
                    </svg>
                </div>
                <h2 class="tw-mt-2 tw-font-semibold tw-text-gray-800">Are you sure?
                </h2>
                <p class="tw-mt-2 tw-text-sm tw-text-gray-600 tw-leading-relaxed">Do you really want to remove
                    {{ $trainer->name }}? This process cannot be undone.</p>
            </div>

            {{-- Button div --}}
            <div class="tw-flex tw-items-center tw-mt-3 tw-justify-center">
                {{-- Cancel Div --}}
                <div>
                    <button id="cancel-btn"
                        class="tw-flex-1 tw-px-4 tw-py-2 tw-bg-gray-100 hover:tw-bg-gray-200 tw-text-gray-800 tw-text-sm tw-font-medium tw-rounded-md">
                        Cancel
                    </button>
                </div>
                {{-- Agree Div --}}
                <div>
                    <form method="POST" action="/employer/jobs/{{ $job->id }}/remove-trainer/{{ $trainer->id }}">
                        @csrf
                        @method('PUT')
                        <button id="agree-btn" type="submit"
                            class="tw-px-4 tw-py-2 tw-ml-2 tw-bg-cyan-50 hover:tw-bg-cyan-100 tw-text-cyan-500 tw-text-sm tw-font-medium tw-rounded-md">
                            Agree
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
