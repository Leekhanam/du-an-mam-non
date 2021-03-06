<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class HocSinh extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nam_hoc_moi = DB::table('nam_hoc')->where('type', 1)->first();
        $url = file_get_contents("https://raw.githubusercontent.com/duyet/vietnamese-namedb/master/uit_member.json");
        $json_ten = json_decode($url);
        // dd($json_ten[1]);
        function CovertVn($str){
            $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|� �|ặ|ẳ|ẵ)/", 'a', $str);
            $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
            $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
            $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|� �|ợ|ở|ỡ)/", 'o', $str);
            $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
            $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
            $str = preg_replace("/(đ)/", 'd', $str);
            $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|� �|Ặ|Ẳ|Ẵ)/", 'A', $str);
            $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
            $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
            $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|� �|Ợ|Ở|Ỡ)/", 'O', $str);
            $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
            $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
            $str = preg_replace("/(Đ)/", 'D', $str);
            $str = preg_replace("/( )/", '_', $str);
            return $str;
        }
        $lop_hoc_moi = DB::table('lop_hoc')
        ->join('khoi', 'khoi.id', '=', 'lop_hoc.khoi_id')
        ->select('lop_hoc.*', 'khoi.nam_hoc_id')
        ->where('khoi.nam_hoc_id', $nam_hoc_moi->id)->get();
        
        $tuoi = 19;
        $length = 5;
        $ngay_vao_truong = 20;
        foreach ($lop_hoc_moi as $key) {
            
            if($key->type == 1){
                $length = $length+3;
                $tuoi = $tuoi - 1;
                $ngay_vao_truong = $ngay_vao_truong - 1;
            }
            // $ten_hs = $json_ten[$rand]->full_name;  
            // $username = CovertVn($ten_hs);
            
            for ($i=0; $i <$length ; $i++) { 
                $rand1 = rand(10000,99999);
                $rand = rand(1,1000);
                $rand_ma = rand(100,9999);
                     $id_hoc_sinh = DB::table('users')->insertGetId([
                        'name' => $json_ten[$rand]->full_name,
                        'username' => 'coolkids'.$tuoi.$rand_ma,
                        'avatar' => "",
                        'email' => 'coolkids'.$tuoi.$rand_ma.'@gmail.com',
                        'password' => Hash::make('1234567890'),
                        'time_code' => Carbon::now(),
                        'role' => 3,
                        'active' => 1,
                        'phone_number' => '03766'.$rand1
                        
                ]);
                    DB::table('hoc_sinh')->insert([
                    'user_id' => $id_hoc_sinh,
                    'ma_hoc_sinh' => 'HS'.$tuoi.$rand_ma,
                    'lop_id' => $key->id,
                    'ten' => $json_ten[$rand]->full_name,
                    'gioi_tinh' => rand(0,1),
                    'ngay_sinh' => '20'.$tuoi.'-0'.rand(1,9).'-'.rand(10,28),
                    'dan_toc' => 'Kinh',
                    'ngay_vao_truong' => '20'.$ngay_vao_truong.'-09'.'-09',
                    'noi_sinh' => 'Hà Nội',
                    'ten_cha' => $json_ten[rand(1,100)]->full_name,
                    'ngay_sinh_cha' => '1982-05-'.rand(10,30),
                    'cmtnd_cha' => rand(10000, 99999),
                    'dien_thoai_cha' => '0915950738',
                    'ten_me' => $json_ten[rand(1,100)]->full_name,
                    'ngay_sinh_me' => '1992-05-'.rand(10,30),
                    'cmtnd_me' => rand(10000, 99999),
                    'dien_thoai_me' => '0376671343',
                    'dien_thoai_dang_ki' => '03766'.$rand1,
                    'email_dang_ky' => 'coolkids'.$tuoi.$rand_ma.'@gmail.com',
                    'ho_khau_thuong_tru_matp' => '01',
                    'ho_khau_thuong_tru_maqh' => '001',
                    'ho_khau_thuong_tru_xaid' => '00001',
                    'ho_khau_thuong_tru_so_nha' => 'so 20',
                    'noi_o_hien_tai_matp' => '02',
                    'noi_o_hien_tai_maqh' => '027',
                    'noi_o_hien_tai_xaid' => '00775',
                    'noi_o_hien_tai_so_nha' => 'Số 48',
                    'type' => 1
                ]);
                
                
            }
        }
    }
}