<?php

use App\Arrangement;
use Illuminate\Database\Seeder;

class ArrangementsSeeder extends Seeder
{
    public function run()
    {
        $arrangements = [
            'Lead',
            'Alt. Lead',
            'Rhythm',
            'Alt. Rhythm',
            'Bass',
        ];

        foreach ($arrangements as $arrangement) {
            Arrangement::create(['name' => $arrangement]);
        }
    }
}
