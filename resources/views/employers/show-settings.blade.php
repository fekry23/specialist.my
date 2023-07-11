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
        <form method="POST" action="{{ route('employer.update_employer_settings', ['employer' => $employer_details->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- CSRF : https://laravel.com/docs/10.x/csrf -->


            {{-- Username --}}
            <div class="form-input-container">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ $employer_details->username }}"
                    autocomplete="off">
                @error('username')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-input-container">
                <label for="email">Work Email Address</label>
                <input type="email" id="email" name="email" value="{{ $employer_details->email }}"
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
                <input type="text" id="name" name="name" value="{{ $employer_details->name }}"
                    autocomplete="off">
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- State --}}
            <div class="form-input-container">
                <label for="state">State</label>
                <select name="state" id="state">
                    <option value=""></option>
                    <option value="Johor" {{ $employer_details->state == 'Johor' ? 'selected' : '' }}>Johor</option>
                    <option value="Kedah" {{ $employer_details->state == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                    <option value="Kuala Lumpur" {{ $employer_details->state == 'Kuala Lumpur' ? 'selected' : '' }}>Kuala
                        Lumpur
                    </option>
                    <option value="Labuan" {{ $employer_details->state == 'Labuan' ? 'selected' : '' }}>Labuan</option>
                    <option value="Melaka" {{ $employer_details->state == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                    <option value="Negeri Sembilan" {{ $employer_details->state == 'Negeri Sembilan' ? 'selected' : '' }}>
                        Negeri
                        Sembilan</option>
                    <option value="Pahang" {{ $employer_details->state == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                    <option value="Penang" {{ $employer_details->state == 'Penang' ? 'selected' : '' }}>Penang</option>
                    <option value="Perak" {{ $employer_details->state == 'Perak' ? 'selected' : '' }}>Perak</option>
                    <option value="Perlis" {{ $employer_details->state == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                    <option value="Putrajaya" {{ $employer_details->state == 'Putrajaya' ? 'selected' : '' }}>Putrajaya
                    </option>
                    <option value="Sabah" {{ $employer_details->state == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                    <option value="Sarawak" {{ $employer_details->state == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                    <option value="Selangor" {{ $employer_details->state == 'Selangor' ? 'selected' : '' }}>Selangor
                    </option>
                    <option value="Terengganu" {{ $employer_details->state == 'Terengganu' ? 'selected' : '' }}>Terengganu
                    </option>
                    <option value="Others" {{ $employer_details->state == 'Others' ? 'selected' : '' }}>Others</option>
                </select>

                @error('state')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contact No --}}
            <div class="form-input-container">
                <label for="contact_no">Contact Number</label>
                <input type="tel" id="contact_no" name="contact_no" value="{{ $employer_details->contact_no }}"
                    placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">

                @error('contact_no')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gender --}}
            <div class="form-input-container">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option value=""></option>
                    <option value="Male" {{ $employer_details->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $employer_details->gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>

                @error('gender')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Company Name --}}
            <div class="form-input-container">
                <label for="company_name">Company Name</label>
                <input type="text" id="company_name" name="company_name" value="{{ $employer_details->company_name }}">

                @error('company_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- Profile Image --}}
            <div class="form-input-container">
                <div class="tw-flex tw-justify-center">
                    @if ($employer_details->profile_picture === 'freelancer-icon.png')
                        <img class="tw-rounded tw-w-36 tw-h-36" src="/images/signup-img/freelancer-icon.png" alt="">
                    @else
                        <img class="tw-rounded tw-w-36 tw-h-36"
                            src="{{ asset('storage/' . $employer_details->profile_picture) }}" alt="">
                    @endif
                </div>

                <label for="profile_picture">Upload Profile Image</label>
                <input
                    class="tw-block tw-w-full tw-text-sm tw-text-gray-900 tw-border tw-border-gray-300 tw-rounded-lg tw-cursor-pointer tw-bg-gray-50 focus:tw-outline-none"
                    aria-describedby="file_input_help" id="profile_picture" name="profile_picture" type="file">
                <p class="tw-mt-1 tw-text-sm tw-text-gray-500" id="file_input_help">
                    File must be in PNG, JPG format and should not exceed 8MB in size.
                </p>


                @error('profile_picture')
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
@endsection
