<?php

use Illuminate\Database\Seeder;

class credentialbasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\credential_basic::class, 50)->create();
    }
}
