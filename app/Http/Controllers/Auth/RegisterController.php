<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Role;
use App\Models\UssdPin;
use App\Models\Wallet;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
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

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'phone_number' => 'required|unique:users',
            'gender' => 'required',
            'dob' => 'required|date_format:Y-m-d',
            'password' => 'required|confirmed|min:6',
        ]);

        $request['role_id']= 3;
        $request['password'] = Hash::make($request->password);

        $user = User::create($request->all());

        Wallet::create([
            'user_id'=> $user->id,
            'account'=> "1000241300$user->id",
        ]);

        $year = Carbon::parse($request->dob)->format("Y");
        UssdPin::create([
            'user_id'=> $user->id,
            'phone_number'=> $user->phone_number,
            'pin'=>$year,
        ]);

        Point::create([
            'user_id'=> $user->id,
        ]);

        return redirect(route('login'))->withSuccess('User account created successful!');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
