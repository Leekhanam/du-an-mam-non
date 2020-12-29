<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        return Validator::make($data, [
            'name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'min:6','max:100'],
            'email' => ['required','unique:users,email','email'],
            'username' => ['required','min:6', 'max:100'],
            'password' => ['required', 'min:8', 'confirmed'],
            'agree' => ['required']
        ],[
            'name.required' => 'Vui lòng nhập Họ và tên',
            'name.regex' => 'Vui lòng nhập Họ và tên hợp lệ',
            'name.min' => 'Vui lòng nhập Họ và tên hợp lệ từ 6 đến 100 ký tự',
            'name.max' => 'Vui lòng nhập Họ và tên hợp lệ từ 6 đến 100 ký tự',

            'email.required' => 'Vui lòng nhập Email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',

            'username.required' => 'Vui lòng nhập Username',
            'username.min' => 'Vui lòng nhập Username từ 6 đến 100 ký tự',
            'username.max' => 'Vui lòng nhập Username từ 6 đến 100 ký tự',

            'password.required' => 'Vui lòng nhập Password',
            'password.min' => 'Vui lòng nhập Password trên 6 ký tự',
            'password.confirmed' => 'Password không khớp',

            'agree.required' => 'Chấp nhận điều khoản'
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
        $token = Str::random(60).md5(time());
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'token' => $token,
            'time_code' => Carbon::now()
        ]);
    
        $email = $user->email;
        $url = route('password.reset',['token' => $token,'email' => $data['email']]);
        $send_data=[
            'route' => $url,
            'title' => "Tài khoản được đăng ký thành công !"
        ];
        Mail::send('auth.email_dang_ky', $send_data, function($message) use ($email){
	        $message->to($email, 'Reset password')->subject('New Account Susses!');
        });

        return $user;
    }
}
