<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Category;
use App\Model\Colors;
use App\Model\Product;
use App\Model\Sizes;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'name'=>$faker->word,
        'imageUrl'=>$faker->imageUrl,
        'slug'=>$faker->slug(),
        'detail'=>$faker->paragraph,
        'price'=>$faker->numberBetween(100,1000),
        'stock'=>$faker->randomDigit,
        'discount'=>$faker->numberBetween(2,39),
        'category_id'=>function(){
            return Category::all()->random();
        },
        'color'=>function(){
            return Colors::all()->random();
        },
        'size'=>function(){
            return Sizes::all()->random();
        },
        'status'=>1

    ];
});
