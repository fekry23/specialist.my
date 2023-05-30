@props(['employer_detail'])

<div class="left-nav-items">
    <ul>
        <li class="employer-container">
            <img src="/images/signup-img/freelancer-icon.png" alt="">
            <h3>{{ $employer_detail->name }}</h3>
            <h5>{{ $employer_detail->email }}</h6>
        </li>
        <hr>
        <li class="{{ request()->is('employer/dashboard/*') ? 'active' : '' }}" style="margin-top: 2rem"><a
                href="/employer/dashboard/{{ $employer_detail->id }}"><i class="fas fa-home"></i>Dashboard</a></li>
        <li>
            <a href="javascript:void(0);" id="jobs-link"><i class="fas fa-briefcase"></i>Jobs</a>
            <ul id="jobs-dropdown" style="display: none;">
                <li class="{{ request()->is('employer/jobs/all-jobs*') ? 'active' : '' }}"><a
                        href="{{ url('/employer/jobs/all-jobs') }}">All
                        Jobs</a></li>
                <li class="{{ request()->is('employer/jobs/active-jobs*') ? 'active' : '' }}"><a
                        href="{{ url('/employer/jobs/active-jobs') }}">Active Jobs</a></li>
                <li class="{{ request()->is('employer/jobs/pending-jobs*') ? 'active' : '' }}"><a href="#">Pending
                        Payment</a></li>
                <li class="{{ request()->is('employer/jobs/review-jobs*') ? 'active' : '' }}"><a href="#">Review
                        Jobs</a></li>
                <li class="{{ request()->is('employer/jobs/completed-jobs*') ? 'active' : '' }}"><a
                        href="{{ url('employer/jobs/completed-jobs/') }}">Completed Jobs</a></li>
            </ul>
        </li>

        <li class="{{ request()->is('employer/chat/*') ? 'active' : '' }}"><a href=""><i
                    class="fas fa-comments"></i>Chat</a></li>
        <li class="{{ request()->is('employer/settings/*') ? 'active' : '' }}"><a href=""><i
                    class="fas fa-user-cog"></i>Settings</a></li>
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