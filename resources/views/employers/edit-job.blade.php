@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/find-job-create.css') }}">
@endsection

@section('content')
    <div class="container">
        <header>
            <h2>
                Edit Job
            </h2>
            <p>Edit: {{ $job->title }}</p>
        </header>

        {{-- Modify it later so it redirect to Employer Jobs Posted Page --}}
        <form method="POST" action="/employer/jobs/{{ $job->id }}/edit/store">
            @csrf
            @method('PUT')
            <!-- CSRF : https://laravel.com/docs/10.x/csrf -->
            {{-- Tittle --}}
            <div class="form-input-container">
                <label for="title">Job Title</label>
                <input type="text" name="title" value="{{ $job->title }}" />

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
                    <option value="Johor" {{ $job->state == 'Johor' ? 'selected' : '' }}>Johor</option>
                    <option value="Kedah" {{ $job->state == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                    <option value="Kuala Lumpur" {{ $job->state == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                    <option value="Labuan" {{ $job->state == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                    <option value="Melaka" {{ $job->state == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                    <option value="Negeri Sembilan" {{ $job->state == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri
                        Sembilan
                    </option>
                    <option value="Pahang" {{ $job->state == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                    <option value="Penang" {{ $job->state == 'Penang' ? 'selected' : '' }}>Penang</option>
                    <option value="Perak" {{ $job->state == 'Perak' ? 'selected' : '' }}>Perak</option>
                    <option value="Perlis" {{ $job->state == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                    <option value="Putrajaya" {{ $job->state == 'Putrajaya' ? 'selected' : '' }}>Putrajaya</option>
                    <option value="Sabah" {{ $job->state == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                    <option value="Sarawak" {{ $job->state == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                    <option value="Selangor" {{ $job->state == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                    <option value="Terengganu" {{ $job->state == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                    <option value="Others" {{ $job->state == 'Others' ? 'selected' : '' }}>Others</option>
                </select>

            </div>

            {{-- Description --}}
            <div class="form-input-container">
                <label for="description">Job Description</label>
                <textarea name="description" rows="10" placeholder="Include tasks, requirements, salary, etc">{{ $job->description }}</textarea>


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
                    <option value="Accounting & Consulting"
                        {{ $job->category == 'Accounting & Consulting' ? 'selected' : '' }}>Accounting & Consulting
                    </option>
                    <option value="Admin Support" {{ $job->category == 'Admin Support' ? 'selected' : '' }}>Admin Support
                    </option>
                    <option value="Customer Service" {{ $job->category == 'Customer Service' ? 'selected' : '' }}>Customer
                        Service</option>
                    <option value="Data Science & Analytics"
                        {{ $job->category == 'Data Science & Analytics' ? 'selected' : '' }}>Data Science & Analytics
                    </option>
                    <option value="Design & Creative" {{ $job->category == 'Design & Creative' ? 'selected' : '' }}>Design
                        & Creative</option>
                    <option value="Engineering & Architecture"
                        {{ $job->category == 'Engineering & Architecture' ? 'selected' : '' }}>Engineering & Architecture
                    </option>
                    <option value="IT & Networking" {{ $job->category == 'IT & Networking' ? 'selected' : '' }}>IT &
                        Networking</option>
                    <option value="Legal" {{ $job->category == 'Legal' ? 'selected' : '' }}>Legal</option>
                    <option value="Sales & Marketing" {{ $job->category == 'Sales & Marketing' ? 'selected' : '' }}>Sales &
                        Marketing</option>
                    <option value="Translation" {{ $job->category == 'Translation' ? 'selected' : '' }}>Translation
                    </option>
                    <option value="Web/Mobile & Software Dev"
                        {{ $job->category == 'Web/Mobile & Software Dev' ? 'selected' : '' }}>Web/Mobile & Software Dev
                    </option>
                    <option value="Writing" {{ $job->category == 'Writing' ? 'selected' : '' }}>Writing</option>
                    <option value="Others" {{ $job->category == 'Others' ? 'selected' : '' }}>Others</option>
                </select>

            </div>

            {{-- Job Type --}}
            <div class="form-input-container">
                <label for="type">Job Type</label>
                <select name="type" id="type">
                    <option value="Hourly" {{ $job->type == 'Hourly' ? 'selected' : '' }}>Hourly</option>
                    <option value="Fixed-Price" {{ $job->type == 'Fixed-Price' ? 'selected' : '' }}>Fixed-Price</option>
                </select>

            </div>

            {{-- Rate --}}
            <div class="form-input-container">
                <label for="rate">Rate</label>
                <input type="number" name="rate" placeholder="Example: 5, 10, 100, etc" value="{{ $job->rate }}" />

                @error('rate')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                                validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Experience Level --}}
            <div class="form-input-container">
                <label for="exp_level">Experience Level</label>
                <select name="exp_level" id="exp_level">
                    <option value="Entry" {{ $job->exp_level == 'Entry' ? 'selected' : '' }}>Entry</option>
                    <option value="Intermediate" {{ $job->exp_level == 'Intermediate' ? 'selected' : '' }}>Intermediate
                    </option>
                    <option value="Expert" {{ $job->exp_level == 'Expert' ? 'selected' : '' }}>Expert</option>
                </select>

            </div>

            {{-- Project Length --}}
            <div class="form-input-container">
                <label for="project_length">Project Length</label>
                <select name="project_length" id="project_length">
                    <option value="Less than one month"
                        {{ $job->project_length == 'Less than one month' ? 'selected' : '' }}>Less than one month</option>
                    <option value="1 to 3 months" {{ $job->project_length == '1 to 3 months' ? 'selected' : '' }}>1 to 3
                        months</option>
                    <option value="3 to 6 months" {{ $job->project_length == '3 to 6 months' ? 'selected' : '' }}>3 to 6
                        months</option>
                    <option value="More than 6 months"
                        {{ $job->project_length == 'More than 6 months' ? 'selected' : '' }}>More than 6 months</option>
                </select>

            </div>

            {{-- Skills --}}
            <div class="form-input-container">
                <label for="skills">Skills Required</label>
                <input type="text" name="skills" placeholder="Example: Laravel, Backend, Postgres, etc"
                    value="{{ $job->skills }}" />

                @error('skills')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                                validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button --}}
            <div class="form-submit-button-container">
                <button type="submit">
                    Update Job
                </button>

                {{-- Modify it later so it redirect to Employer Jobs Posted Page --}}
                <a href="{{ route('employer.show_logged_in', ['job' => $job]) }}"> Back </a>

            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection