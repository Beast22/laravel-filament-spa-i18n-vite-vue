<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryCity;

class CategoryCitySeeder extends Seeder
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

         // Categories City

         CategoryCity::create([
            'city' => ['en' => 'Ksamil', 'ru' => 'Ксамил'],
            'slug' => ['en' => 'ksamil', 'ru' => 'ksamil'],
            'category_id' => $catBuy->id,
            'category_city_id' =>  1,
        ])->addMedia(resource_path() . '/city-img/Ksamil.jpg')->preservingOriginal()->toMediaCollection();

         CategoryCity::create([
            'city' => ['en' => 'Lalzi_Bay', 'ru' => 'Лалзи Бэй'],
            'slug' => ['en' => 'lalzi', 'ru' => 'lalzi'],
            'category_id' => $catBuy->id,
            'category_city_id' =>  2,
        ])->addMedia(resource_path() . '/city-img/Lalzi_Bay.jpg')->preservingOriginal()->toMediaCollection();

         CategoryCity::create([
            'city' => ['en' => 'Saranda', 'ru' => 'Саранда'],
            'slug' => ['en' => 'saranda', 'ru' => 'saranda'],
            'category_id' => $catBuy->id,
            'category_city_id' =>  3,
        ])->addMedia(resource_path() . '/city-img/Saranda.jpg')->preservingOriginal()->toMediaCollection();

         CategoryCity::create([
            'city' => ['en' => 'Vlora', 'ru' => 'Влора'],
            'slug' => ['en' => 'vlora', 'ru' => 'vlora'],
            'category_id' => $catBuy->id,
            'category_city_id' =>  4,
        ])->addMedia(resource_path() . '/city-img/Vlora.jpg')->preservingOriginal()->toMediaCollection();

         CategoryCity::create([
            'city' => ['en' => 'Ksamil', 'ru' => 'Ксамил'],
            'slug' => ['en' => 'ksamil', 'ru' => 'ksamil'],
            'category_id' => $catRent->id,
            'category_city_id' =>  5,
        ])->addMedia(resource_path() . '/city-img/Ksamil.jpg')->preservingOriginal()->toMediaCollection();

         CategoryCity::create([
            'city' => ['en' => 'Lalzi_Bay', 'ru' => 'Лалзи Бэй'],
            'slug' => ['en' => 'lalzi', 'ru' => 'lalzi'],
            'category_id' => $catRent->id,
            'category_city_id' =>  6,
        ])->addMedia(resource_path() . '/city-img/Lalzi_Bay.jpg')->preservingOriginal()->toMediaCollection();

         CategoryCity::create([
            'city' => ['en' => 'Saranda', 'ru' => 'Саранда'],
            'slug' => ['en' => 'saranda', 'ru' => 'saranda'],
            'category_id' => $catRent->id,
            'category_city_id' =>  7,
        ])->addMedia(resource_path() . '/city-img/Saranda.jpg')->preservingOriginal()->toMediaCollection();

         CategoryCity::create([
            'city' => ['en' => 'Vlora', 'ru' => 'Влора'],
            'slug' => ['en' => 'vlora', 'ru' => 'vlora'],
            'category_id' => $catRent->id,
            'category_city_id' =>  8,
        ])->addMedia(resource_path() . '/city-img/Vlora.jpg')->preservingOriginal()->toMediaCollection();
    }
}
