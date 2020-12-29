<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemDanhDen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
       $nam_hoc_moi = DB::table('nam_hoc')->where('type', 1)->first();
       $lop_hoc_moi = DB::table('lop_hoc')
        ->join('khoi', 'khoi.id', '=', 'lop_hoc.khoi_id')
        ->select('lop_hoc.*')
        ->where('khoi.nam_hoc_id', $nam_hoc_moi->id)->get();
        for($i = 1; $i< 19; $i++){
            if($i == 5 ||  $i == 12 ||  $i == 19 || $i == 28 )
            {
                $i = $i+2;
            }
        
        foreach($lop_hoc_moi as $value){
            $giao_vien = DB::table('giao_vien')->where('lop_id', $value->id)->first();
            $hoc_sinh = DB::table('hoc_sinh')->where('lop_id', $value->id)->get();
           
            foreach($hoc_sinh as $item){
                $an = 1;
                $rand1 =1;
                $rand2 =1;
                if($rand1 == 2){
                    $an = 2;
                }
        
                DB::table('diem_danh_den')->insert([
                    'ngay_diem_danh_den' => '2020-12-0'.$i,
                    'hoc_sinh_id' => $item->id,
                    'giao_vien_id' => $giao_vien->id,
                    'type' => 1,
                    'trang_thai' => $rand1,
                    'lop_id' => $value->id,
                    'phieu_an' => $an
                ]);
                DB::table('diem_danh_den')->insert([
                    'ngay_diem_danh_den' => '2020-12-0'.$i,
                    'hoc_sinh_id' => $item->id,
                    'giao_vien_id' => $giao_vien->id,
                    'type' => 2,
                    'trang_thai' => $rand2,
                    'lop_id' => $value->id,
                    
                ]);
                $rand3 = rand(1,4);
                if($rand1 == 2 && $rand2 == 2){
                    DB::table('diem_danh_ve')->insert([
                        'ngay_diem_danh_ve' => '2020-12-0'.$i,
                        'hoc_sinh_id' => $item->id,
                        'user_id' => $item->user_id,
                        'giao_vien_id' => $giao_vien->user_id,
                        'trang_thai' => 3,
                        'lop_id' => $value->id,
                        'chu_thich' => 'Bé nghỉ học'
                    ]);
                }
                else{
                        $arr = [1,4];
                        DB::table('diem_danh_ve')->insert([
                            'ngay_diem_danh_ve' => '2020-12-0'.$i,
                            'hoc_sinh_id' => $item->id,
                            'user_id' => $item->user_id,
                            'giao_vien_id' => $giao_vien->user_id,
                            'trang_thai' => $arr[0],
                            'lop_id' => $value->id,
                        ]);
                    
                }
            }
        }
    }


    //    foreach($lop_hoc_moi as $value){
    //     $giao_vien = DB::table('giao_vien')->where('lop_id', $value->id)->first();
    //     $hoc_sinh = DB::table('hoc_sinh')->where('lop_id', $value->id);
    //     foreach($hoc_sinh as $item){
    //         DB::table('diem_danh_den')->insert([
    //             'ngay_diem_danh_den' => '2020-12-07',
    //             'hoc_sinh_id' => $item->id,
    //             'giao_vien_id' => $giao_vien->id,
    //             'type' => 1,
    //             'trang_thai' => rand(1,3),
    //             'lop_id' => $value->id
    //         ]);
    //         DB::table('diem_danh_den')->insert([
    //             'ngay_diem_danh_den' => '2020-12-07',
    //             'hoc_sinh_id' => $item->id,
    //             'giao_vien_id' => $giao_vien->id,
    //             'type' => 2,
    //             'trang_thai' => rand(1,3),
    //             'lop_id' => $value->id
    //         ]);
    //     }
    // }
       
    }
}
