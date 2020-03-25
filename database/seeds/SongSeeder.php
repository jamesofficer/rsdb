<?php

use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    public function run()
    {
        factory(App\Song::class, 100)->create();
    }
}
