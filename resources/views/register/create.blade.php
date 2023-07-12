@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
@endsection

@section('content')
    <div class="tw-container tw-py-16 tw-mx-auto">
        <!-- start of sign up form -->
        <div class="user-signup-form" id="user-signup-form">
            <button type="button" id="back-button">
                <img src="/images/signup-img/left-arrow-icon.png" alt=""> </button>
            <h1 id="signup-header" class="tw-font-bold tw-text-3xl" style="width: 100%;text-align:center;padding:3% 3%;">
            </h1>
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



                <div id="popover-password" class="tw-ml-16 tw-pl-2">
                    <p><span id="result"></span></p>
                    <div class="progress">
                        <div id="password-strength" class="progress-bar" role="progressbar" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        </div>
                    </div>
                    <ul class="list-unstyled tw-text-left tw-w-96 ">
                        <li class="">
                            <span class="low-upper-case">
                                <i class="fas fa-circle" aria-hidden="true"></i>
                                &nbsp;Lowercase &amp; Uppercase
                            </span>
                        </li>
                        <li class="">
                            <span class="one-number">
                                <i class="fas fa-circle" aria-hidden="true"></i>
                                &nbsp;Number (0-9)
                            </span>
                        </li>
                        <li class="">
                            <span class="eight-character">
                                <i class="fas fa-circle" aria-hidden="true"></i>
                                &nbsp;Atleast 8 Character
                            </span>
                        </li>
                    </ul>
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
                </div><br>

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

    <script>
        let state = false;
        let password = document.getElementById("new-password");
        let passwordStrength = document.getElementById("password-strength");
        let lowUpperCase = document.querySelector(".low-upper-case i");
        let number = document.querySelector(".one-number i");
        let specialChar = document.querySelector(".one-special-char i");
        let eightChar = document.querySelector(".eight-character i");

        password.addEventListener("keyup", function() {
            let pass = document.getElementById("new-password").value;
            checkStrength(pass);
        });

        function checkStrength(password) {
            let strength = 0;

            //If password contains both lower and uppercase characters
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                strength += 1;
                lowUpperCase.classList.remove('fa-circle');
                lowUpperCase.classList.add('fa-check');
            } else {
                lowUpperCase.classList.add('fa-circle');
                lowUpperCase.classList.remove('fa-check');
            }
            //If it has numbers and characters
            if (password.match(/([0-9])/)) {
                strength += 1;
                number.classList.remove('fa-circle');
                number.classList.add('fa-check');
            } else {
                number.classList.add('fa-circle');
                number.classList.remove('fa-check');
            }
            //If password is greater than 7
            if (password.length > 7) {
                strength += 1;
                eightChar.classList.remove('fa-circle');
                eightChar.classList.add('fa-check');
            } else {
                eightChar.classList.add('fa-circle');
                eightChar.classList.remove('fa-check');
            }

            // If value is less than 2
            if (strength < 1) {
                passwordStrength.classList.remove('progress-bar-warning');
                passwordStrength.classList.remove('progress-bar-success');
                passwordStrength.classList.add('progress-bar-danger');
                passwordStrength.style = 'width: 10%';
            } else if (strength == 2) {
                passwordStrength.classList.remove('progress-bar-success');
                passwordStrength.classList.remove('progress-bar-danger');
                passwordStrength.classList.add('progress-bar-warning');
                passwordStrength.style = 'width: 60%';
            } else if (strength == 3) {
                passwordStrength.classList.remove('progress-bar-warning');
                passwordStrength.classList.remove('progress-bar-danger');
                passwordStrength.classList.add('progress-bar-success');
                passwordStrength.style = 'width: 100%';
            }
        }
    </script>
@endsection
