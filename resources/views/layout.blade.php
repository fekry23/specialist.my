<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Specialist.my</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="/">
                <h3>Specialist.my</h3>
            </a>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/find-candidate') }}">Find Candidate</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/find-job') }}">Find Jobs</a></li>

            @auth('employer')
                <li class="nav-item"><a class="nav-link"
                        href="{{ url('/employer/dashboard', Auth::guard('employer')->id()) }}">Employer Dashboard</a></li>
            @elseif(auth('trainer')->check())
                <li class="nav-item"><a class="nav-link"
                        href="{{ url('/trainer/dashboard', Auth::guard('trainer')->id()) }}">Trainer Dashboard</a></li>
            @else
                <li class="nav-item"><a class="nav-link register-link" href="{{ url('/register') }}"><i
                            class="fas fa-user-plus"></i>&nbsp;Register</a></li>
                <li class="nav-item"><a class="nav-link login-link" href="{{ url('/login') }}"><i
                            class="fas fa-sign-in-alt"></i>&nbsp;Login</a></li>
            @endauth


            @auth('employer', 'trainer')
                <li class="nav-item">
                    <form class="tw-inline" method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                            class="tw-text-black tw-bg-white tw-border-transparent hover:tw-text-light-blue-200 tw-text-lg tw-cursor-pointer">
                            <i class="fas fa-sign-out-alt tw-text-lg"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            @endauth
        </ul>

    </nav>


    <!-- end of navigation bar -->

    <main>
        {{-- VIEW OUTPUT --}}
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div>
            <p>Copyright © 2023 - All right reserved by Fekry Saharudin</p>
        </div>
    </footer>
    <!-- End of Footer -->

    <x-flash-message />

</body>


</html>

@yield('scripts')
<script src="//unpkg.com/alpinejs" defer></script>
<script src="{{ asset('https://code.jquery.com/jquery-3.5.1.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/footer.js') }}"></script>
