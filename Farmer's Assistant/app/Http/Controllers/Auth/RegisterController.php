<?php

namespace App\Http\Controllers\Auth;
use App\customer; //customer model
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\SystemUser;


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
    protected $redirectTo = '/home';

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
        //validating fields
        return Validator::make($data, [
            'firstname' => 'required|string|min:4',
            'email' => 'required|email|string|unique:users|unique:customers',
            'address' => 'required|string',
            'tp' => 'required|unique:users|regex:/^[0]{1}[0-9]{9}$/',
            'password' => 'string|required|min:6|confirmed'
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    //put data into db
    protected function create(array $data)
    {
        //put the data in to the users table
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' =>2,
        ]);

        //put the data in to the users table
        $customer = customer::create([
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'address' => $data['address'],
            'tp' => $data['tp'],
            //'username' =>$data['username'],
            'id' => $user->id, //using the systemUser table id 
        ]);

        return $user;
    }

}//RegisterController class
