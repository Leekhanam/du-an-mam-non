<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class NamHoc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nam_hoc')->insert([
            'name' => '2018 - 2019',
            'start_date' => '2018-01-01',
            'end_date' => '2019-01-01',
            'type' => 2
        ]);
        DB::table('nam_hoc')->insert([
            'name' => '2019 - 2020',
            'start_date' => '2019-01-01',
            'end_date' => '2020-01-01',
            'type' => 2
        ]);
        DB::table('nam_hoc')->insert([
            'name' => '2020 - 2021',
            'start_date' => '2020-01-01',
            'end_date' => '2021-01-01',
            'type' => 1
        ]);
    }
}
