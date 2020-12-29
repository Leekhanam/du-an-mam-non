<?php

namespace App\Repositories;

use App\Repositories\BaseModelRepository;
use App\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Jobs\jobSmS;

class AccountRepository extends BaseModelRepository
{
    protected $model;
    public function __construct(
        User $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel()
    {
        return User::class;
    }

    public function getAllSchool($params = [])
    {
        $keyword = $params['keyword'];
        $data = $this->model::where('role', $params['role'])
                            ->where('active', '!=', 0);
        if (isset($params['keyword']) && $params['keyword'] != null) {
            $data->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('username', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        if (isset($params['active']) && $params['active'] != null) {
            $data->where('active', $params['active']);
        }
        return $data->paginate($params['page_size']);
    }

    public function KhoaTaiKhoan($id_user)
    {
        return $this->model::where('id',$id_user)->update(['active'=>2]);
    }
    public function storeAcount( $data ){
        $token = Str::random(60).md5(time());
        $now  = Carbon::now();
        $time_code = $now->addMinutes(1440);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['email'],
            'password' => Hash::make($data['email']),
            'token' => $token,
            'role' => $data['role'],
            'time_code' => $time_code,
            'phone_number' => $data['phone_number']
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

    public function storeAcountGV( $data ){
        $token = Str::random(60).md5(time());
        $now  = Carbon::now();
        $time_code = $now->addMinutes(1440);
        $password =  Str::random(10);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['email'],
            'avatar' => $data['anh'],
            'password' => Hash::make($password),
            'token' => $token,
            'role' => $data['role'],
            'time_code' => $time_code,
            'phone_number' => $data['phone_number']
        ]);
    
        $email = $user->email;
        $url = config('common.SERVE_HOST_GV') . '/mat-khau-reset?token=' . $token . '&email=' . $email;
        $send_data=[
            'route' => $url,
            'title' => "Tài khoản được đăng ký thành công !"
        ];
        Mail::send('auth.email_dang_ky', $send_data, function($message) use ($email){
	        $message->to($email, 'Reset password')->subject('New Account Susses!');
        });

        $params = [
            'number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => $password
        ];
        jobSmS::dispatch($params);

        return $user;
    }

    public function getAccountHocSinh()
    {
        return $this->model::where('role', 3)
        ->where('active', 1)
        ->get();
    }

    public function updateAccountGiaoVien($id, $params)
    {
        return $this->model::where('id', $id)
        ->update($params);
    }

}
