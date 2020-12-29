<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LopHoc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $khoi = DB::table('khoi')->get();
        $i = 2;
        foreach ($khoi as $key => $value) {
            DB::table('lop_hoc')->insert([
                'khoi_id' => $value->id,
                'ten_lop' => 'Lớp '. $i .' tuổi A',
                'type' => 1
            ]);
            DB::table('lop_hoc')->insert([
                'khoi_id' => $value->id,
                'ten_lop' => 'Lớp '. $i .' tuổi B',
                'type' => 2
            ]);
            DB::table('lop_hoc')->insert([
                'khoi_id' => $value->id,
                'ten_lop' => 'Lớp '. $i .' tuổi C',
                'type' => 3
            ]);
            $i = $i+ 1;
            if($i > 5){
                $i = 2;
            }
        }
    }
}
