<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
   
    public function run()
    {   $count = count(distrcit()['title_en']);
        for($i = 0; $i < $count; $i++){
            $district = new District();
            $district->title_bn  = distrcit()['title_bn'][$i];
            $district->title_en  = distrcit()['title_en'][$i];
            $district->slug      = distrcit()['slug'][$i];
            $district->save();
        } 
    }
}
