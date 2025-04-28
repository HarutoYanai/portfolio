<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        /*DB::table('categories')->insert([
            'category_id' =>
            'category_name' =>
            'created_at' =>
            'updated_at' =>
        ]); */


        DB::table('categories')->insert([
            'category_id' => '10-276',
            'category_name' => '豚肉',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('categories')->insert([
            'category_id' => '10-277',
            'category_name' => '鶏肉',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        
    }
}
