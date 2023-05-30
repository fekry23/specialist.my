@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
@endsection

@section('content')
    <div class="content">
        <!-- Choose Type of User -->
        <div class="choose-method-container" id="choose-method-container">
            <h1>Sign up as a employer or trainer</h1>
            <div class="left-container">
                <button id="employer" data-user-type="employer">
                    <img src="/images/signup-img/hiring-icon.png" alt="">
                    <h2>I'm a employer, hiring for a project</h2>
                </button>
            </div>
            <div class="right-container">
                <button id="trainer" data-user-type="trainer">
                    <img src="/images/signup-img/freelancer-icon.png" alt="">
                    <h2>I'm a trainer, looking for work</h2>
                </button>
            </div>
            <div class="button-container">
                <button id="create-account" class="create-account" disabled> Create Account
                </button>
            </div>
            <div class="login-container">
                <p>Already have an account? <a href="{{ url('/login') }}">Login</a></p>
            </div>
        </div>
        <!-- end of choosing Type of User -->
    @endsection

    @section('scripts')
        <script src="{{ asset('js/signup/signup-index.js') }}"></script>
    @endsection
