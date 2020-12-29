<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;

class giao_vienTableSeeder extends Seeder
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
                $limit = 3;
                for ($i = 0; $i < $limit; $i++) {
                    $data = [
                        'lop_id' => $lop->id,
                        'ten' => $faker->name,
                        'ma_gv' => 'GV'. $faker->numberBetween($min = 1000, $max = 9000),
                        'gioi_tinh' => rand(0 , 1),
                        'email' => $faker->email,
                        'dien_thoai' => '0376671'.rand(100,999),
                        'ngay_sinh' => $faker->date($format = 'Y-m-d', $max = 'now'),
                        'anh' => $faker->imageUrl($width = 640, $height = 480),
                        'dan_toc' => 1,
                        'trinh_do' =>  'Đại Học',
                        'chuyen_mon' => 'Đại Học',
                        'noi_dao_tao' => $faker->city,
                        'nam_tot_nghiep' => Carbon::now()->year,
                        'user_id' => null,
                        'type' => 1
                    ];
                    $userId = DB::table('users')->insertGetId([
                        'name' => $data['ten'],
                        'username' => $data['ma_gv'],
                        'avatar' => $data['anh'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['ma_gv']),
                        'time_code' => Carbon::now(),
                        'role' => 2,
                        'active' => 1
                        ]);
                    $data['user_id'] = $userId;
                    DB::table('giao_vien')->insert($data);
                }
            }
        }
    }
}
