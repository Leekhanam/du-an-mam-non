<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DotKhamSucKhoe extends Seeder
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
        ->select('lop_hoc.*', 'khoi.nam_hoc_id')
        ->where('khoi.nam_hoc_id', $nam_hoc_moi->id)->get();
        $suc_khoe = DB::table('dot_kham_suc_khoe')->orderBy('id', 'desc')->limit(1)->first();
        foreach($lop_hoc_moi as $value){
            //$giao_vien = DB::table('giao_vien')->where('lop_id', $value->id)->first();
            $hoc_sinh = DB::table('hoc_sinh')->where('lop_id', $value->id)->get();
           $rand = 90;
           $rand2 = 10;
            foreach($hoc_sinh as $item){
                DB::table('suc_khoe')->insert([
                    'dot_id' => $suc_khoe->id,
                    'hoc_sinh_id' => $item->id,
                    'lop_id' => $value->id,
                    'chieu_cao' => ($rand + rand(1,6)),
                    'can_nang' => ($rand2 + rand(1,6)),
                ]);
            }
        }
    }
}
