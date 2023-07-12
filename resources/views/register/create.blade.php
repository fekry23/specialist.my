@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
@endsection

@section('content')
    <div class="content">
        <!-- start of sign up form -->
        <div class="user-signup-form" id="user-signup-form">
            <button type="button" id="back-button">
                <img src="/images/signup-img/left-arrow-icon.png" alt=""> </button>
            <h1 id="signup-header" style="width: 100%;text-align:center;padding:3% 3%;"></h1>
            <form method="POST" action="/users" id="user-signup-form">
                @csrf

                <input type="hidden" id="user-type" name="user-type" value="">
                {{-- Username --}}
                <div class="form-input-container">
                    <input type="text" id="username" name="username" placeholder="Username"
                        value="{{ old('username') }}" autocomplete="off">
                    @error('username')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- First Name --}}
                <div class="form-input-container">
                    <input type="text" id="fname" name="fname" placeholder="First name" value="{{ old('fname') }}"
                        autocomplete="off">
                    @error('fname')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Last Name --}}
                <div class="form-input-container">
                    <input type="text" id="lname" name="lname" placeholder="Last name" value="{{ old('lname') }}"
                        autocomplete="off">

                    @error('lname')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-input-container">
                    <input type="email" id="email" name="email" placeholder="Work email address"
                        value="{{ old('email') }}" autocomplete="off">

                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-input-container">
                    <input type="password" id="new-password" name="new-password" placeholder="Password">
                    <input type="password" id="confirm-password" name="new-password_confirmation"
                        placeholder="Confirm Password">

                    @error('new-password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Location --}}
                <div class="form-input-container">
                    <select id="location" name="location">
                        <option value="">Select a state...</option>
                        <option value="Johor" @if (old('location') == 'Johor') selected @endif>Johor</option>
                        <option value="Kedah" @if (old('location') == 'Kedah') selected @endif>Kedah</option>
                        <option value="Kelantan" @if (old('location') == 'Kelantan') selected @endif>Kelantan</option>
                        <option value="Kuala Lumpur" @if (old('location') == 'Kuala Lumpur') selected @endif>Kuala Lumpur</option>
                        <option value="Labuan" @if (old('location') == 'Labuan') selected @endif>Labuan</option>
                        <option value="Melaka" @if (old('location') == 'Melaka') selected @endif>Malacca</option>
                        <option value="Negeri Sembilan" @if (old('location') == 'Negeri Sembilan') selected @endif>Negeri Sembilan
                        </option>
                        <option value="Pahang" @if (old('location') == 'Pahang') selected @endif>Pahang</option>
                        <option value="Penang" @if (old('location') == 'Penang') selected @endif>Penang</option>
                        <option value="Perak" @if (old('location') == 'Perak') selected @endif>Perak</option>
                        <option value="Perlis" @if (old('location') == 'Perlis') selected @endif>Perlis</option>
                        <option value="Putrajaya" @if (old('location') == 'Putrajaya') selected @endif>Putrajaya</option>
                        <option value="Sabah" @if (old('location') == 'Sabah') selected @endif>Sabah</option>
                        <option value="Sarawak" @if (old('location') == 'Sarawak') selected @endif>Sarawak</option>
                        <option value="Selangor" @if (old('location') == 'Selangor') selected @endif>Selangor</option>
                        <option value="Terengganu" @if (old('location') == 'Terengganu') selected @endif>Terengganu</option>
                    </select>

                    @error('location')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div><br><br>

                <div class="form-submit-button-container">
                    <button id="submit-user"> Create my account </button>
                </div>

                <div class="login-container">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <!-- end of sign up form -->
@endsection

@section('scripts')
    <script src="{{ asset('js/signup/signup-create.js') }}"></script>
@endsection
