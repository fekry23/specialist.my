@props(['trainer']) {{-- coming from find-trainers/index.blade.php file --}}
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
                <div class="tw-w-36 tw-h-36 tw-bg-gray-300"></div>
            @endif
            <div class="name-state">
                <h3 id="overview-name">{{ $trainer->name }}</h3>

                <h4 id="overview-state">{{ $trainer->state }}</h4>
            </div>
        </div>

        <div class="display-overview-parapgraph">

            <!-- Description, need to be modified using PHP in the future -->
            <p>{{ $trainer->specialization_description }}</p>
            <!-- Description, need to be modified using PHP in the future -->

            <!-- Ratings, need to be modified using PHP in the future -->

            <!-- Ratings, need to be modified using PHP in the future -->
        </div>
    </button>

</div>
