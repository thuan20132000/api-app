<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Colors;
use Faker\Generator as Faker;

$factory->define(Colors::class, function (Faker $faker) {
    return [
        //
        'name'=>$faker->colorName
    ];
});
