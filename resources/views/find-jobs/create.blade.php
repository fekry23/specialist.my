@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/find-job-create.css') }}">
@endsection

@section('content')
    <div class="container">
        <header>
            <h2>
                Create a Job
            </h2>
            <p>Post a job to find a specialist</p>
        </header>

        {{-- Modify it later so it redirect to Employer Jobs Posted Page --}}
        <form method="POST" action="/find-job">
            @csrf
            <!-- CSRF : https://laravel.com/docs/10.x/csrf -->
            {{-- Tittle --}}
            <div class="form-input-container">
                <label for="title">Job Title</label>
                <input type="text" name="title" />

                @error('title')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                    validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- State --}}
            <div class="form-input-container">
                <label for="state">State</label>
                <select name="state" id="state">
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Putrajaya">Putrajaya</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            {{-- Description --}}
            <div class="form-input-container">
                <label for="description">Job Description</label>
                <textarea name="description" rows="10" placeholder="Include tasks, requirements, salary, etc"></textarea>

                @error('description')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                                validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div class="form-input-container">
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option value="Accounting & Consulting">Accounting & Consulting</option>
                    <option value="Admin Support">Admin Support</option>
                    <option value="Customer Service">Customer Service</option>
                    <option value="Data Science & Analytics">Data Science & Analytics</option>
                    <option value="Design & Creative">Design & Creative</option>
                    <option value="Engineering & Architecture">Engineering & Architecture</option>
                    <option value="IT & Networking">IT & Networking</option>
                    <option value="Legal">Legal</option>
                    <option value="Sales & Marketing">Sales & Marketing</option>
                    <option value="Translation">Translation</option>
                    <option value="Web/Mobile & Software Dev">Web/Mobile & Software Dev</option>
                    <option value="Writing">Writing</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            {{-- Job Type --}}
            <div class="form-input-container">
                <label for="type">Job Type</label>
                <select name="type" id="type">
                    <option value="Hourly">Hourly</option>
                    <option value="Fixed-Price">Fixed-Price</option>
                </select>
            </div>

            {{-- Hourly Rate --}}
            <div class="form-input-container">
                <label for="rate">Hourly Rate</label>
                <input type="number" name="rate" placeholder="Example: 5, 10, 100, etc" />

                @error('rate')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                                validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Experience Level --}}
            <div class="form-input-container">
                <label for="experience">Experience Level</label>
                <select name="experience" id="experience">
                    <option value="Entry">Entry</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Expert">Expert</option>
                </select>
            </div>

            {{-- Project Length --}}
            <div class="form-input-container">
                <label for="length">Project Length</label>
                <select name="length" id="length">
                    <option value="Less than one month">Less than one month</option>
                    <option value="1 to 3 months">1 to 3 months</option>
                    <option value="3 to 6 months">3 to 6 months</option>
                    <option value="More than 6 months">More than 6 months</option>
                </select>
            </div>

            {{-- Skills --}}
            <div class="form-input-container">
                <label for="skills">Skills Required</label>
                <input type="text" name="skills" placeholder="Example: Laravel, Backend, Postgres, etc" />

                @error('skills')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                                validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button --}}
            <div class="form-submit-button-container">
                <button>
                    Create Job
                </button>

                {{-- Modify it later so it redirect to Employer Jobs Posted Page --}}
                <a href="/find-job"> Back </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
