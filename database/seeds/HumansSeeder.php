<?php

use Illuminate\Database\Seeder;

class HumansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Human::class, 50)->create();
    }
}
