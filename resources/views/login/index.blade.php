@extends('layout')

@section('styles')
    <link rel="stylesheet" href="css/login.css" />
@endsection

@section('content')
    <div class="content">
        <div class="login-form-container" id="signin-form">

            <h1 id="login-header">Log in to Specialist.my</h1>
            <img src="images/signup-img/login-icon.png" alt=""> </button>

            <form method="POST" id="login-form" action="{{ url('/login/authenticate') }}">
                @csrf
                <select name="user" id="user" form="login-form">
                    <option value="">Select a user</option>
                    <option value="employer">Employer</option>
                    <option value="trainer">Trainer</option>
                </select>

                {{-- Email --}}
                <div class="form-input-container">
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Email Address" autocomplete="off">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-input-container">
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                        placeholder="Password">
                    <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i><br><br>
                    @error('new-password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" id="login-user"> Log in </button>
                <div class="login-container">
                    <p> Don't have a Specialist.my account? <a href="{{ url('/register') }}">Signup</a></p>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
