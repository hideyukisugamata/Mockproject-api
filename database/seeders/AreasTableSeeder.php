<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'id' => 1,
            'area' => '東京都'
        ];
        DB::table('areas')->insert($param);

        $param=[
            'id' => 2,
            'area' =>'大阪府'
        ];
        DB::table('areas')->insert($param);

        $param=[
            'id' => 3,
            'area' =>'福岡県'
        ];
        DB::table('areas')->insert($param);
    }
}
