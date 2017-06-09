<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Human::class, function(\Faker\Generator $faker){
    return [
        'name'=>$faker->name,
        'credit'=>$faker->creditCardNumber(),
        'sex'=>$faker->boolean(),
        'profession'=>str_random(5),
        'qualification'=>str_random(5),
        'degree'=>str_random(5),
        'title'=>str_random(6),
        'skill'=>str_random(20),
        'time_enter'=>rand(0,100),
        'email'=>".".str_random(4),
        'phone'=>str_random(10),
        'remark'=>str_random(5),
        'path_i'=>str_random(5),
        'path_credit'=>str_random(5),
        'path_qualification'=>str_random(5),
        'path_degree'=>str_random(5),
        'path_skill'=>str_random(5)
    ];
});

$factory->define(\App\credential_basic::class, function(\Faker\Generator $faker){
    return [
        'name'=>$faker->name,
        'time_start'=>$faker->creditCardNumber(),
        'time_end'=>str_random(5),
        'remark'=>str_random(5),
        'path'=>str_random(5),
    ];
});









