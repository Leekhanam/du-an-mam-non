<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\ResetForm;
use Illuminate\Support\Str;

class QuenMatKhauController extends Controller
{
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
