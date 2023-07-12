@props(['trainer_detail'])

<div class="left-nav-items tw-w-52">
    <ul>
        <li class="employer-container">
            @if ($trainer_detail->image === 'freelancer-icon.png')
                <img class="tw-rounded tw-w-36 tw-h-auto tw-max-w-full" src="/images/signup-img/freelancer-icon.png"
                    alt="">
            @else
                <img class="tw-rounded tw-w-36 tw-h-auto tw-max-w-full"
                    src="{{ asset('storage/' . $trainer_detail->image) }}" alt="">
            @endif
            <h3>{{ $trainer_detail->name }}</h3>
            <h5>{{ $trainer_detail->email }}</h6>
        </li>
        <hr>
        <li class="{{ request()->is('trainer/dashboard/*') ? 'active' : '' }}" style="margin-top: 2rem"><a
                href="/trainer/dashboard/{{ $trainer_detail->id }}"><i class="fas fa-home"></i>Dashboard</a></li>
        <li>
            <a href="javascript:void(0);" id="jobs-link"><i class="fas fa-briefcase"></i>Jobs</a>
            <ul id="jobs-dropdown" style="display: none;">
                <li class="{{ request()->is('trainer/jobs/job-applications*') ? 'active' : '' }}"><a
                        href="{{ url('trainer/jobs/job-applications/') }}">Job Applications</a></li>
                <li class="{{ request()->is('trainer/jobs/active-jobs*') ? 'active' : '' }}"><a
                        href="{{ url('/trainer/jobs/active-jobs') }}">Active Jobs</a></li>
                <li class="{{ request()->is('trainer/jobs/completed-jobs*') ? 'active' : '' }}"><a
                        href="{{ url('trainer/jobs/completed-jobs/') }}">Completed Jobs</a></li>
            </ul>
        </li>

        <li class="{{ request()->is('trainer/settings/*') ? 'active' : '' }}"><a
                href="{{ route('trainer.show_settings_page', ['trainer_id' => $trainer_detail->id]) }}">
                <i class="fas fa-user-cog"></i>Settings</a></li>
        <li>
            <form class="tw-inline" method="POST" action="/logout">
                @csrf
                <button type="submit"
                    class="tw-text-black tw-bg-white tw-border-transparent hover:tw-text-light-blue-200 tw-text-base tw-cursor-pointer">
                    <i class="fas fa-sign-out-alt tw-mr-4 tw-text-[1.2rem]"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>
