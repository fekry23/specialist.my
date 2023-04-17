<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Specialist.my</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @yield('styles')
</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="menu-icon">
            <span class="fas fa-bars"></span>
            <!-- The link with class="icon" is used to open and close the topnav on small screens.-->
        </div>
        <div class="logo">
            <a href="/">Specialist.my</a>

        </div>



        <div class="nav-items">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ url('/find-candidate') }}">Find Candidate</a></li>
                <li><a href="{{ url('find-job') }}">Find Jobs</a></li>
                <li><a href="" class="login-link"><i class="fas fa-sign-in-alt" style="color: #eaf0fb;"></i>
                        &nbsp Login</a></li>
            </ul>
        </div>



        <div class="cancel-icon">
            <span><i class="far fa-window-close"></i></span>
        </div>
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

</body>

</html>

@yield('scripts')
<script src="{{ asset('https://code.jquery.com/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/footer.js') }}"></script>
