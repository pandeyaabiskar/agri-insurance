<?php

use App\Crop;
use Illuminate\Database\Seeder;

class CropsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crop::truncate();

        Crop::create([
            'name' => 'Carrot',
            'price' => '130',
            'season' => 'Spring',
            'harvest_days' => '80'
        ]);

        Crop::create([
            'name' => 'Onion',
            'price' => '500',
            'season' => 'Winter',
            'harvest_days' => '30'
        ]);

        Crop::create([
            'name' => 'Tomato',
            'price' => '300',
            'season' => 'Summer',
            'harvest_days' => '40'
        ]);

        Crop::create([
            'name' => 'Strawberry',
            'price' => '200',
            'season' => 'Summer',
            'harvest_days' => '180'
        ]);

        Crop::create([
            'name' => 'Cabbage',
            'price' => '120',
            'season' => 'Winter',
            'harvest_days' => '150'
        ]);

    }
}
