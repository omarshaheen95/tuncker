<?php

namespace App\Http\Controllers\SchoolAuth;

use App\School;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/school/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('school.guest');
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
            'email' => 'required|email|max:255|unique:schools',
            'password' => 'required|min:6|confirmed',
            'ar_delegate' => 'required',
            'en_delegate' => 'required',
            'ar_address' => 'required',
            'en_address' => 'required',
            'phone' => 'required',
            'ar_name' => 'required|max:255',
            'en_name' => 'required|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return School
     */
    protected function create(array $data)
    {
        $active_to = Carbon::now()->addDays(5);
        return School::create([
            'ar_name' => $data['ar_name'],
            'en_name' => $data['en_name'],
            'ar_delegate' => $data['ar_delegate'],
            'en_delegate' => $data['en_delegate'],
            'ar_address' => $data['ar_address'],
            'en_address' => $data['en_address'],
            'url' => $data['url'],
            'active_to' => $active_to,
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('school.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('school');
    }
}
