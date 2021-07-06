<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\StaticContent;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm ()
    {
        $staticcontent = StaticContent::all(); 
        return view('auth.register', compact('staticcontent'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['max:50', 'required', 'regex:/^[A-Za-z][A-Za-z ]{1,49}$/'],
            'contact_number' => ['max:20', 'required', 'regex:/[+0-9]{1,20}$/'],
            'profession' => ['max:25', 'required', 'regex:/^[A-Za-z][A-Za-z ]{1,24}$/'],
            'institution' => ['max:50', 'required', 'regex:/^[A-Za-z0-9][A-Za-z0-9 ]{1,49}$)/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'full_name' => $data['full_name'],
            'contact_number' => $data['contact_number'],
            'profession' => $data['profession'],
            'institution' => $data['institution'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
