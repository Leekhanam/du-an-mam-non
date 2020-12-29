<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class HocSinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Faker\Factory::create();
        for ($i=0; $i < 100 ; $i++) { 
            DB::table('hoc_sinh')->insert([
                'ten' => $fake->lastName,
                'ma_hoc_sinh' => Str::random(2).rand(100,400),
                'gioi_tinh' => rand(1,2),
                'tuoi'=> rand(3,5)
            ]);
        }
       
    }
}
