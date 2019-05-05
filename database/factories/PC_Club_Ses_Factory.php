<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Models\PC_ClubSes::class, function (Faker $faker) {

    //$users = DB::table('users')->select('login')->get();
    //$pc_id =DB::table('pc_club_pc')->select('id')->get();

    $data = [
        //'id_pc' => array_rand(array($pc_id)),
        'id_pc' => rand(2, 11),
        'user_id' => rand(2, 12),
        'time_start' => $faker->dateTimeBetween('-2 months', '-2 days'),
        'time_end' => $faker->dateTimeBetween('-2 months', '-1 days'),
    ];

    return $data;
});

