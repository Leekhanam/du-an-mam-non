<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;
use Hash;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $email = $request->username;
    	$password = $request->password;
    	$remember = $request->has("remember") ? true : false;

    	if(Auth::attempt([
            "email" => $email,
            "password" => $password,
            'role' => 1,
            "active" => 1,]
            ,$remember)){
    		 return redirect('/');
        }else{
    		 return redirect()->back()->with('message','Tài khoản hoặc mật khẩu không chính xác!');
        }
        
    }
}
