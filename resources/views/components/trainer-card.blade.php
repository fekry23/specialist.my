@props(['trainer'])
{{-- In Laravel, "props" (short for "properties") typically 
refer to the data that is passed from a parent component to a 
child component. --}}

<div class="display-overview">
    <!-- Button, need to be modified using PHP in the future -->
    <button id="overview-button" onclick="window.location.href='/find-candidate/{{ $trainer->id }}'">
        <div class="display-overview-img">
            <img id="overview-img" src="/images/find-candidate/candidate-profile.png" alt="">
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
