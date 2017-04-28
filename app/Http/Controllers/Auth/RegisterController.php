<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'passport_id' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'zip' => 'required|max:255',
            'country_id' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|alpha_num|max:255|unique:users,username',
            'password' => 'required|min:6|confirmed',
        ],
        [
            'name.required' => 'First Name is required.',
            'last_name.required' => 'Sur Name is required.',
            'passport_id.required' => 'IC/Passport Number is required.',
            'phone.required' => 'Mobile Number is required.',
            'address.required' => 'Address is required.',
            'state.required' => 'State is required.',
            'city.required' => 'City is required.',
            'zip.required' => 'Zip Code is required.',
            'country_id.required' => 'Country is required.',
            'email.required' => 'Email is required.',
            'username.required' => 'User Name is required.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $oUser = new User;
        $oUser->title = $data['title'];
        $oUser->name = $data['name']. ' '.$data['last_name'];
        $oUser->username = $data['username'];
        $oUser->email = $data['email'];
        $oUser->phone = $data['phone'];
        $oUser->passport_id = $data['passport_id'];
        $oUser->address = $data['address'];
        $oUser->state = $data['state'];
        $oUser->city = $data['city'];
        $oUser->zip = $data['zip'];
        $oUser->country_id = $data['country_id'];
        $oUser->password = bcrypt($data['password']);
        $oUser->status = true;
        $oUser->other_info = '';
        $oUser->company_name = '';
        if($oUser->save()){
            $oUser->roles()->attach(3);
        }

        return $oUser;

        return User::create([
            'title' => $data['title'],
            'name' => $data['first_name']. ' '.$data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'passport_id' => $data['passport_id'],
            'address' => $data['address'],
            'state' => $data['state'],
            'city' => $data['city'],
            'zip' => $data['zip'],
            'country_id' => $data['country_id'],
            'other_info' => '',
            'company_name' => '',
            'status' => true,
        ]);
    }
}
