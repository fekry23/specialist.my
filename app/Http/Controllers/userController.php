<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Database\Query\Builder;

class userController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function create(Request $request)
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        // dd($request);

        $allowedStates = [
            'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan', 'Melaka', 'Negeri Sembilan', 'Pahang', 'Penang',
            'Perak', 'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'Others'
        ];

        // dd($request->all());
        //Validate is for what rule we want for certain file.
        //https://laravel.com/docs/10.x/validation
        $formFields = $request->validate([
            'username' => 'required|string|max:255|unique:' . ($request->input('user-type') === 'employer' ? 'employers' : 'trainers') . ',username',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . ($request->input('user-type') === 'employer' ? 'employers' : 'trainers') . ',email',
            'new-password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
            ],
            'location' => ['required', Rule::in($allowedStates)],
        ], [
            'username.required' => 'Please enter your username.',
            'username.unique' => 'The :attribute is already in use.',
            'fname.required' => 'Please enter your first name.',
            'lname.required' => 'Please enter your last name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The :attribute is already in use.',
            'new-password.required' => 'Please enter a password.',
            'new-password.min' => 'Your password must be at least 8 min characters long.',
            'new-password.regex' => 'Your password must contain at least one lowercase letter, one uppercase letter, and one number.',
            'new-password.confirmed' => 'Please confirm your password.',
            'location.in' => 'Please select a valid location.',
        ]);

        //Combine fname and lname to one name
        $formFields['name'] = $request->input('fname') . ' ' . $request->input('lname');

        // dd($request->input('new-password'));
        $user = null; // declare the variable outside the if statement
        if ($request->input('user-type') === 'employer' || $request->input('user-type') === 'trainer') {
            $model = '\App\Models\\' . ucfirst($request->input('user-type'));
            $user = new $model([
                'username' => $formFields['username'],
                'name' => $formFields['name'],
                'email' => $formFields['email'],
                'state' => $formFields['location']
            ]);
            $user->password = Hash::make($formFields['new-password']);
            $user->save();
        }

        // // Retrieve the currently authenticated user's ID...
        // $id = Auth::id();

        // dd($id);
        // Attempt to log in the user...
        $guard = $request->input('user-type');
        // dd(route($guard . '.dashboard', ['id' => $id]));
        if (Auth::guard($guard)->attempt(['email' => $formFields['email'], 'password' => $formFields['new-password']])) {
            $id = Auth::guard($guard)->id();
            // dd($id);
            return redirect()->route($guard . '.dashboard', ['id' => $id])
                ->with('success-message', 'Logged in successfully!');
        } else {
            dd('Auth attempt failed!'); // add this line
            return redirect('/register/' . $guard)->with('error-message', 'Failed to login!');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success-message', 'You have been logged out!');
    }

    public function login()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => [
                'required',
                'email',
                'exists:' . ($request->input('user') === 'employer' ? 'employers' : 'trainers') . ',email'
            ],
            'password' => 'required',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'The email address is not registered as a ' . $request->input('user') . '.',
            'password.required' => 'Please enter a password.',
        ]);

        $guard = $request->input('user');
        if (Auth::guard($guard)->attempt(['email' => $formFields['email'], 'password' => $formFields['password']])) {
            $request->session()->regenerate();

            $id = Auth::guard($guard)->id();
            // dd(Auth::guard('trainer')->check());
            // dd(route($request->input('user') . '.dashboard', ['id' => $id]));
            return redirect()->route($guard . '.dashboard', ['id' => $id])
                ->with('success-message', 'Logged in successfully!');
        } else {
            return back()->with('error-message', 'Failed to login!')
                ->withErrors(['email' => 'The email address and password do not match.']);
        }
    }
}
