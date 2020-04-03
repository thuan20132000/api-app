<?php

use App\Model\Category;
use App\Model\Colors;
use App\Model\Product;
use App\Model\Review;
use App\Model\Sizes;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // $this->call(UsersTableSeeder::class);
        $this->call(SizeSeeder::class);
        factory(Colors::class,10)->create();
        factory(Category::class,10)->create();
        factory(Product::class,20)->create();
        factory(Review::class,250)->create();



    }
}
