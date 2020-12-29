<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Khoi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nam_hoc = DB::table('nam_hoc')->get();
        foreach ($nam_hoc as $key) {
            DB::table('khoi')->insert([
                'ten_khoi' => 'Khối 2',
                'do_tuoi' => 2,
                'nam_hoc_id' => $key->id
            ]);
            DB::table('khoi')->insert([
                'ten_khoi' => 'Khối 3',
                'do_tuoi' => 3,
                'nam_hoc_id' => $key->id
            ]);
            DB::table('khoi')->insert([
                'ten_khoi' => 'Khối 4',
                'do_tuoi' => 4,
                'nam_hoc_id' => $key->id
            ]);
            DB::table('khoi')->insert([
                'ten_khoi' => 'Khối 5',
                'do_tuoi' => 5,
                'nam_hoc_id' => $key->id
            ]);
        }
    }
}
