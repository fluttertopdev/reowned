<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
use DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $dataArr = [
            array(
                'image' => '',
                'link' => 'https://demo.com/',
                'status'=> 0,
            ),
        ];

        // Insert data into the banners table
        foreach ($dataArr as $cat) {
            $existingCategory = DB::table('banners')->first();
            if (!$existingCategory) {
                DB::table('banners')->insert($cat);
            }
        }
    }
}
