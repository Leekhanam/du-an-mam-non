<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;
use Hash;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    protected $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }

    public function viewFormRegister()
    {
        return view('auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $request['password'] = bcrypt(md5(time().$request->email));
        $this->AuthService->create($request);
        $url = route('auth.register');
        $data=[
            'route'=>$url,
            'title'=>"Tài khoản được đăng ký thành công"
        ];

        Mail::send('auth.email_dang_ky', $data, function($message){
	        $message->to('phucnvph07307@fpt.edu.vn', 'Visitor')->subject('Visitor Feedback!');
        });
        
    

    }

    public function profile()
    {
        $auth = Auth::user();
        return view('auth.profile',compact('auth'));
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function uploadAvatar(Request $request)
    {
        $user = Auth::user();
        $user->avatar = $request->avatar;
        $user->save();
        return 'upload avatar thành công';
    }
}
