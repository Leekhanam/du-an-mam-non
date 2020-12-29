<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\ResetForm;
use Illuminate\Support\Str;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {

        $token = $request->token;
        $email= $request->email;
      
        $checkUser = User::where([
            "token" => $token,
            "email" => $email
        ])->first();
        if($checkUser){
           return view('auth.passwords.reset',['token'=>$token,'email'=>$email]);
        }else{
            return view('auth.passwords.time_expired_email',['thongbao'=> 'Lỗi xác thực không thành công']);      
        }
    }

    public function reset(ResetForm $request)
    {
        $token = $request->token;
        $email= $request->email;

        $checkUser = User::where([
            "token" => $token,
            "email" => $email
        ])->first();

        $now  = Carbon::now();
        $time_code = Carbon::parse($checkUser ? $checkUser->time_code : Carbon::now());
        $now = strtotime($now);
        $time_code = strtotime($time_code);
        $kq = $time_code - $now;

        if(!$checkUser || $kq < 0){
         return redirect()->back()->with('message','Lỗi xác thực không thành công');
        };

        $token = Str::random(60).md5(time());
        $checkUser->token = $token;
        $checkUser->password = Hash::make($request->password);
        $checkUser->email_verified_at = Carbon::now();
        $checkUser->save();
        Auth::logout();
        return redirect()->route('login')->with('success_password','Đổi mật khẩu thành công, Vui lòng đăng nhập lại');
    }


     
}
