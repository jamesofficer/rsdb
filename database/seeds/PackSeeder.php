<?php

use Illuminate\Database\Seeder;

class PackSeeder extends Seeder
{
    public function run()
    {
        factory(App\Pack::class, 30)->create();
    }
}
