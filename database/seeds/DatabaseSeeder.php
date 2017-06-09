<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(HumansSeeder::class);
         $this->call(credentialbasicSeeder::class);
         $this->call(permissionSeeder::class);
    }
}
