<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;

class hoc_sinhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $faker = Faker\Factory::create();
        
        $ListKhoi = DB::table('khoi')->where('nam_hoc_id',125)->get();
        foreach($ListKhoi as $khoi){
            $ListLop = DB::table('lop_hoc')->where('khoi_id', $khoi->id)->get();
            foreach($ListLop as $lop){
                $limit = 10;
                for ($i = 0; $i < $limit; $i++) {
                    $data = [
                        'lop_id' => $lop->id,
                        'ten' => $faker->name,
                        'ma_hoc_sinh' => 'PH'. $faker->numberBetween($min = 1000, $max = 9000),
                        'gioi_tinh' => rand(0 , 1),
                        'ten_thuong_goi' => $faker->name,
                        'avatar' => $faker->imageUrl($width = 640, $height = 480),
                        'ngay_sinh' => $faker->date($format = 'Y-m-d', $max = 'now'),
                        'dan_toc' => 1,
                        'ngay_vao_truong' =>  $faker->date($format = 'Y-m-d', $max = 'now'),
                        'doi_tuong_chinh_sach_id' => 1,
                        'noi_sinh' => $faker->city,
                        'hoc_sinh_khuyet_tat' => 1,
                        'ten_cha' => $faker->name($gender = 'female'),
                        'ngay_sinh_cha' => '1990-01-01',
                        'cmtnd_cha' => $faker->creditCardNumber,
                        'dien_thoai_cha' => '0376671'.rand(100,999),
                        'ten_me' => $faker->name($gender = 'male'),
                        'ngay_sinh_me' =>'1990-01-01',
                        'cmtnd_me' => $faker->creditCardNumber,
                        'dien_thoai_me' => '0376671'.rand(100,999),
                        'dien_thoai_dang_ki' =>'0376671'.rand(100,999),
                        'email_dang_ky' => $faker->email,
                        'user_id' => null,
                        'type' => 1
                    ];
                    $userId = DB::table('users')->insertGetId([
                        'name' => $data['ten'],
                        'username' => $data['ma_hoc_sinh'],
                        'avatar' => $data['avatar'],
                        'email' => $data['email_dang_ky'],
                        'password' => Hash::make($data['ma_hoc_sinh']),
                        'time_code' => Carbon::now(),
                        'role' => 3,
                        'active' => 1
                        ]);
                    $data['user_id'] = $userId;
                    DB::table('hoc_sinh')->insert($data);
                }
            }
        }
    }
}
