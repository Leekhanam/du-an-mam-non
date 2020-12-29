<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LichSuHocSinh extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       
            $hoc_sinh = DB::table('hoc_sinh')->where('lop_id', 89)->get();
            
            foreach($hoc_sinh as $item){
                DB::table('lich_su_hoc')->insert([
                    "hoc_sinh_id" => $item->id,
                    "lop_id" => 74
                ]);
            }
            
        
    }
}
