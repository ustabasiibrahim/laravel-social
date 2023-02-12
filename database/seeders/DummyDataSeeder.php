<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        if(Country::query()->count() == 0) {
            Country::query()->create([
                'name' => 'Türkiye',
                'iso_code' => 'TUR',
            ]);

            Country::query()->create([
                'name' => 'United Kingdom',
                'iso_code' => 'GBR',
            ]);

            Country::query()->create([
                'name' => 'United States',
                'iso_code' => 'USA',
            ]);
        }

    }
}
