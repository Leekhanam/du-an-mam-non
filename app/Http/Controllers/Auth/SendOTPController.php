<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SendOTPController extends Controller
{
    public function send(Request $request)
    {
        $email = $request->email;
        $checkUser = User::where('email', $email)->first();
        if($checkUser){
            $ma_otp = random_int(0,9).random_int(0,9).random_int(0,9).
            random_int(0,9).random_int(0,9).random_int(0,9);
            $now  = Carbon::now();
            $checkUser->time_code = $now->addMinutes(30);
            $checkUser->ma_otp      = $ma_otp;
            $checkUser->token       = Str::random(60).md5(time());
            $checkUser->save();

            $HostDomain = config('common.HostDomain_servesms');
            $key        = config('common.key_servesms');
            $devices    = config('common.devices_servesms');
            $number     = $checkUser->phone_number;
            $Api_SMS    = $HostDomain .'key=' . $key .'&number=' . $number .'&message='. 
                          $ma_otp . '+l%C3%A0+m%C3%A3+x%C3%A1c+nh%E1%BA%ADn+c%E1%BB%A7a+b%E1%BA%A1n&devices=' . $devices;
            
            $response   = Http::get($Api_SMS);
            $result     = $response->json();
            return $result;
        }
        return "NG";
    }

    public function checkOTP(Request $request)
    {
        $email = $request->email;
        $ma_otp = $request->ma_otp;
        $checkUser = User::where('email', $email)
                    ->where('ma_otp', $ma_otp)
                    ->first();
        if(!$checkUser){
            return response()->json(['token' => ""], Response::HTTP_OK);
        }
        return response()->json(['email' => $email, 'token' => $checkUser->token], Response::HTTP_OK);
    }

    public function resetOTP(Request $request)
    {
        $email = $request->email;
        $checkUser = User::where('email', $email)->first();
        $ma_otp = random_int(0,9).random_int(0,9).random_int(0,9).
                  random_int(0,9).random_int(0,9).random_int(0,9);
        $checkUser->ma_otp= $ma_otp;
        $checkUser->save();
        return 'reset mã OTP thành công';
    }
}
