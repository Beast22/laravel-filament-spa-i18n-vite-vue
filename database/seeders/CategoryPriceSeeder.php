<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryPrice;

class CategoryPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categories

        $catBuy = Category::where('slug', 'buy')->first();
        $catRent = Category::where('slug', 'rent')->first();


        // Categories Price

        CategoryPrice::create([
            'price' => ['en' => '25 000 - 60 000', 'ru' => '25 000 - 60 000'],
            'slug' => ['en' => '25000', 'ru' => '25000'],
            'category_id' => $catBuy->id,
            'category_price_id' =>  1,
        ])->addMedia(resource_path() . '/price-img/price-1.jpg')->preservingOriginal()->toMediaCollection();

        CategoryPrice::create([
            'price' => ['en' => '60 000 - 100 000', 'ru' => '60 000 - 100 000'],
            'slug' => ['en' => '60000', 'ru' => '60000'],
            'category_id' => $catBuy->id,
            'category_price_id' =>  2,
        ])->addMedia(resource_path() . '/price-img/price-2.jpg')->preservingOriginal()->toMediaCollection();

        CategoryPrice::create([
            'price' => ['en' => '100 000 - 150 000', 'ru' => '100 000 - 150 000'],
            'slug' => ['en' => '100000', 'ru' => '100000'],
            'category_id' => $catBuy->id,
            'category_price_id' =>  3,
        ])->addMedia(resource_path() . '/price-img/price-3.jpg')->preservingOriginal()->toMediaCollection();

        CategoryPrice::create([
            'price' => ['en' => '150 000 € - more', 'ru' => '150 000 € и больше'],
            'slug' => ['en' => '150000', 'ru' => '150000'],
            'category_id' => $catBuy->id,
            'category_price_id' =>  4,
        ])->addMedia(resource_path() . '/price-img/price-4.jpg')->preservingOriginal()->toMediaCollection();

        CategoryPrice::create([
            'price' => ['en' => '250 - 450', 'ru' => '250 - 450'],
            'slug' => ['en' => '250', 'ru' => '250'],
            'category_id' => $catRent->id,
            'category_price_id' =>  5,
        ])->addMedia(resource_path() . '/price-img/price-1.jpg')->preservingOriginal()->toMediaCollection();

        CategoryPrice::create([
            'price' => ['en' => '450 - 650', 'ru' => '450 - 650'],
            'slug' => ['en' => '450', 'ru' => '450'],
            'category_id' => $catRent->id,
            'category_price_id' =>  6,
        ])->addMedia(resource_path() . '/price-img/price-2.jpg')->preservingOriginal()->toMediaCollection();

        CategoryPrice::create([
            'price' => ['en' => '650 - 1 000', 'ru' => '650 - 1 000'],
            'slug' => ['en' => '650', 'ru' => '650'],
            'category_id' => $catRent->id,
            'category_price_id' =>  7,
        ])->addMedia(resource_path() . '/price-img/price-3.jpg')->preservingOriginal()->toMediaCollection();

        CategoryPrice::create([
            'price' => ['en' => '1000 € - more', 'ru' => '1000 € и больше'],
            'slug' => ['en' => '1000', 'ru' => '1000'],
            'category_id' => $catRent->id,
            'category_price_id' =>  8,
        ])->addMedia(resource_path() . '/price-img/price-4.jpg')->preservingOriginal()->toMediaCollection();
    }
}
