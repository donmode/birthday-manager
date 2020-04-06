<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validate = [
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'phone1' => ['required','numeric', 'min:13', 'unique:users'],
            'birthday' => ['required',  'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'max:255'],
        ];
        if($data['middlename']){
            $validate['middlename'] = ['string', 'max:50'];
        }
        if($data['phone2']){
            $validate['phone2'] = ['numeric', 'min:13'];
        }
        $customMessage = [
        "firstname.required" => "First Name is required",
        "lastname.required" => "Last Name is required",
        "address.required" => "Address is required",
        "phone1.required" => "Primary Phone Number is required",
        "firstname.string" => "First Name must be string",
        "lastname.string" => "Last Name must be string",
        "middlename.string" => "Middle Name must be string",
        "phone1.numeric" => "Primary Phone Number must be numeric",
        "email.required" => "Email address is required",
        "email.unique" => "Email address is already taken",
        "phone1.unique" => "Primary Phone Number is already taken",
        "phone2.unique" => "Alternative Phone Number is already taken",
        "phone2.numeric" => "Alternative Phone Number must be numeric",
        "firstname.min" => "First Name must be more than 50",
        "middlename.min" => "Middle Name must be more than 50",
        "last.min" => "Last Name must be more than 255",
        "address.min" => "Address must be more than 50",
        "phone1.min" => "Primary Phone Number must be 13 or more",
        "phone2.min" => "Alternative Phone Number must be 13 or more",
        ];
        return Validator::make($data, $validate, $customMessage);
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
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'middlename' => $data['middlename'],
            'address' => $data['address'],
            'phone1' => $data['phone1'],
            'phone2' => $data['phone2'],
            'birthday' => $data['birthday'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
