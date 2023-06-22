@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/find-job-create.css') }}">
@endsection

@section('content')
    <div class="container">
        <header>
            <h2>
                Settings
            </h2>
            <p>Manage and customize your account preferences</p>
        </header>

        {{-- Modify it later so it redirect to Employer Jobs Posted Page --}}
        <form method="POST" action="{{ route('trainer.update_trainer_settings', ['trainer' => $trainer_details->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- CSRF : https://laravel.com/docs/10.x/csrf -->


            {{-- Username --}}
            <div class="form-input-container">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ $trainer_details->username }}"
                    autocomplete="off">
                @error('username')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-input-container">
                <label for="email">Work Email Address</label>
                <input type="email" id="email" name="email" value="{{ $trainer_details->email }}"
                    autocomplete="off">

                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-input-container">
                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="new-password">
            </div>

            {{-- Password --}}
            <div class="form-input-container">
                <label for="new-password_confirmation">Password Confirmation</label>
                <input type="password" id="confirm-password" name="new-password_confirmation">

                @error('new-password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Name --}}
            <div class="form-input-container">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $trainer_details->name }}" autocomplete="off">
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- State --}}
            <div class="form-input-container">
                <label for="state">State</label>
                <select name="state" id="state">
                    <option value=""></option>
                    <option value="Johor" {{ $trainer_details->state == 'Johor' ? 'selected' : '' }}>Johor</option>
                    <option value="Kedah" {{ $trainer_details->state == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                    <option value="Kuala Lumpur" {{ $trainer_details->state == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala
                        Lumpur
                    </option>
                    <option value="Labuan" {{ $trainer_details->state == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                    <option value="Melaka" {{ $trainer_details->state == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                    <option value="Negeri Sembilan" {{ $trainer_details->state == 'Negeri Sembilan' ? 'selected' : '' }}>
                        Negeri
                        Sembilan</option>
                    <option value="Pahang" {{ $trainer_details->state == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                    <option value="Penang" {{ $trainer_details->state == 'Penang' ? 'selected' : '' }}>Penang</option>
                    <option value="Perak" {{ $trainer_details->state == 'Perak' ? 'selected' : '' }}>Perak</option>
                    <option value="Perlis" {{ $trainer_details->state == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                    <option value="Putrajaya" {{ $trainer_details->state == 'Putrajaya' ? 'selected' : '' }}>Putrajaya
                    </option>
                    <option value="Sabah" {{ $trainer_details->state == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                    <option value="Sarawak" {{ $trainer_details->state == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                    <option value="Selangor" {{ $trainer_details->state == 'Selangor' ? 'selected' : '' }}>Selangor
                    </option>
                    <option value="Terengganu" {{ $trainer_details->state == 'Terengganu' ? 'selected' : '' }}>Terengganu
                    </option>
                    <option value="Others" {{ $trainer_details->state == 'Others' ? 'selected' : '' }}>Others</option>
                </select>

                @error('state')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contact No --}}
            <div class="form-input-container">
                <label for="contact_no">Contact Number</label>
                <input type="tel" id="contact_no" name="contact_no" value="{{ $trainer_details->contact_no }}"
                    placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">

                @error('contact_no')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hourly Rate --}}
            <div class="form-input-container">
                <label for="hourly_rate">Hourly Rate</label>
                <input type="number" id="hourly_rate" name="hourly_rate" value="{{ $trainer_details->hourly_rate }}">

                @error('hourly_rate')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div class="form-input-container">
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option value=""></option>
                    <option value="Accounting & Consulting"
                        {{ $trainer_details->category == 'Accounting & Consulting' ? 'selected' : '' }}>Accounting &
                        Consulting</option>
                    <option value="Admin Support" {{ $trainer_details->category == 'Admin Support' ? 'selected' : '' }}>
                        Admin Support</option>
                    <option value="Customer Service"
                        {{ $trainer_details->category == 'Customer Service' ? 'selected' : '' }}>Customer Service
                    </option>
                    <option value="Data Science & Analytics"
                        {{ $trainer_details->category == 'Data Science & Analytics' ? 'selected' : '' }}>Data Science
                        & Analytics</option>
                    <option value="Design & Creative"
                        {{ $trainer_details->category == 'Design & Creative' ? 'selected' : '' }}>Design & Creative
                    </option>
                    <option value="Engineering & Architecture"
                        {{ $trainer_details->category == 'Engineering & Architecture' ? 'selected' : '' }}>Engineering
                        & Architecture</option>
                    <option value="IT & Networking"
                        {{ $trainer_details->category == 'IT & Networking' ? 'selected' : '' }}>IT & Networking
                    </option>
                    <option value="Legal" {{ $trainer_details->category == 'Legal' ? 'selected' : '' }}>Legal</option>
                    <option value="Sales & Marketing"
                        {{ $trainer_details->category == 'Sales & Marketing' ? 'selected' : '' }}>Sales & Marketing
                    </option>
                    <option value="Translation" {{ $trainer_details->category == 'Translation' ? 'selected' : '' }}>
                        Translation</option>
                    <option value="Web/Mobile & Software Dev"
                        {{ $trainer_details->category == 'Web/Mobile & Software Dev' ? 'selected' : '' }}>Web/Mobile
                        & Software Dev</option>
                    <option value="Writing"{{ $trainer_details->category == 'Writing' ? 'selected' : '' }}>Writing</option>
                    <option value="Others" {{ $trainer_details->category == 'Others' ? 'selected' : '' }}>Others</option>
                </select>

                @error('category')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                        validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Specialization Title --}}
            <div class="form-input-container">
                <label for="specialization_title">Specialization Title</label>
                <textarea id="specialization_title" name="specialization_title" rows="2" maxlength="100"
                    placeholder="Give your specializtion area a title!">{{ $trainer_details->specialization_title }}</textarea>
                <p class="character-count-title">{{ strlen($trainer_details->specialization_title) }} / 100 characters</p>

                @error('specialization_title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Specialization Description --}}
            <div class="form-input-container">
                <label for="specialization_description">Specialization Description</label>
                <textarea id="specialization_description" name="specialization_description" rows="5" maxlength="255"
                    placeholder="Include anything to attract employers!">{{ $trainer_details->specialization_description }}</textarea>
                <p class="character-count-description">{{ strlen($trainer_details->specialization_title) }} / 100
                    characters</p>

                @error('specialization_description')
                    {{-- $message variable is dynamically generated by Laravel based on the validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Skills --}}
            <div class="form-input-container">
                <label for="skills_expertise">Skills Required</label>
                <input type="text" id="skills_expertise" name="skills_expertise"
                    placeholder="Example: Laravel, Backend, Postgres, etc"
                    value="{{ $trainer_details->skills_expertise }}" maxlength="255" />

                @error('skills_expertise')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                                validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- English Level --}}
            <div class="form-input-container">
                <label for="english_level">English Level</label>
                <select name="english_level" id="english_level">
                    <option value=""></option>
                    <option value="Basic" {{ $trainer_details->state == 'Basic' ? 'selected' : '' }}>Basic</option>
                    <option value="Conversational" {{ $trainer_details->state == 'Conversational' ? 'selected' : '' }}>
                        Conversational
                    </option>
                    <option value="Fluent" {{ $trainer_details->state == 'Fluent' ? 'selected' : '' }}>Fluent
                    </option>
                    <option value="Native or bilingual"
                        {{ $trainer_details->state == 'Native or bilingual' ? 'selected' : '' }}>Native or bilingual
                    </option>
                </select>

                @error('english_level')
                    {{-- $message variable is dynamically generated by Laravel based on the 
                                    validation error that occurred for the given input field. --}}
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>


            {{-- Profile Image --}}
            <div class="form-input-container">
                <div class="tw-flex tw-justify-center">
                    @if ($trainer_details->image === 'freelancer-icon.png')
                        <img class="tw-rounded tw-w-36 tw-h-36" src="/images/signup-img/freelancer-icon.png"
                            alt="">
                    @else
                        <img class="tw-rounded tw-w-36 tw-h-36" src="{{ asset('storage/' . $trainer_details->image) }}"
                            alt="">
                    @endif
                </div>

                <label for="image">Upload Profile Image</label>
                <input
                    class="tw-block tw-w-full tw-text-sm tw-text-gray-900 tw-border tw-border-gray-300 tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 focus:tw-outline-none"
                    aria-describedby="file_input_help" id="image" name="image" type="file">
                <p class="tw-mt-1 tw-text-sm tw-text-gray-500" id="file_input_help">
                    File must be in PNG, JPG format and should not exceed 8MB in size.
                </p>


                @error('image')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Button --}}
            <div class="form-submit-button-container">
                <button type="submit">
                    Update Profile
                </button>

                {{-- Modify it later so it redirect to Employer Jobs Posted Page --}}
                <a href="{{ url()->previous() }}">Back</a>

            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Get the textarea elements and character count elements
            var titleTextarea = $('#specialization_title');
            var titleCharCount = $('.character-count-title');

            var descriptionTextarea = $('#specialization_description');
            var descriptionCharCount = $('.character-count-description');

            // Set the initial character counts
            titleCharCount.text(titleTextarea.val().length + ' / 100 characters');
            descriptionCharCount.text(descriptionTextarea.val().length + ' / 255 characters');

            // Bind the input event to update the character counts
            titleTextarea.on('input', function() {
                var text = $(this).val();
                var charCount = text.length;

                titleCharCount.text(charCount + ' / 100 characters');
            });

            descriptionTextarea.on('input', function() {
                var text = $(this).val();
                var charCount = text.length;

                descriptionCharCount.text(charCount + ' / 255 characters');
            });
        });
    </script>
@endsection
