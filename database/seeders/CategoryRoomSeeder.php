<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryRoom;

class CategoryRoomSeeder extends Seeder
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


        // Categories Room

        CategoryRoom::create([
            'room' => ['en' => 'Studio', 'ru' => 'Студия'],
            'slug' => ['en' => 'studio', 'ru' => 'studio'],
            'category_id' => $catBuy->id,
            'category_room_id' =>  1,
        ])->addMedia(resource_path() . '/room-img/Studio.jpg')->preservingOriginal()->toMediaCollection();

         CategoryRoom::create([
             'room' => ['en' => '1_Bedroom', 'ru' => '1_спальня'],
             'slug' => ['en' => '1_bedroom', 'ru' => '1_bedroom'],
             'category_id' => $catBuy->id,
             'category_room_id' =>  2,
         ])->addMedia(resource_path() . '/room-img/1_Bedroom.jpg')->preservingOriginal()->toMediaCollection();

         CategoryRoom::create([
             'room' => ['en' => '2_Bedroom', 'ru' => '2_спальни'],
             'slug' => ['en' => '2_bedroom', 'ru' => '2_bedroom'],
             'category_id' => $catBuy->id,
             'category_room_id' =>  3,
         ])->addMedia(resource_path() . '/room-img/2_Bedroom.jpg')->preservingOriginal()->toMediaCollection();

         CategoryRoom::create([
             'room' => ['en' => 'Penthouse', 'ru' => 'Пентхаус'],
             'slug' => ['en' => 'penthouse', 'ru' => 'penthouse'],
             'category_id' => $catBuy->id,
             'category_room_id' =>  4,
         ])->addMedia(resource_path() . '/room-img/Penthouse.jpg')->preservingOriginal()->toMediaCollection();

         CategoryRoom::create([
             'room' => ['en' => 'Studio', 'ru' => 'Студия'],
             'slug' => ['en' => 'studio', 'ru' => 'studio'],
             'category_id' => $catRent->id,
             'category_room_id' =>  5,
         ])->addMedia(resource_path() . '/room-img/Studio.jpg')->preservingOriginal()->toMediaCollection();

         CategoryRoom::create([
             'room' => ['en' => '1_Bedroom', 'ru' => '1_спальня'],
             'slug' => ['en' => '1_bedroom', 'ru' => '1_bedroom'],
             'category_id' => $catRent->id,
             'category_room_id' =>  6,
         ])->addMedia(resource_path() . '/room-img/1_Bedroom.jpg')->preservingOriginal()->toMediaCollection();

         CategoryRoom::create([
             'room' => ['en' => '2_Bedroom', 'ru' => '2_спальни'],
             'slug' => ['en' => '2_bedroom', 'ru' => '2_bedroom'],
             'category_id' => $catRent->id,
             'category_room_id' =>  7,
         ])->addMedia(resource_path() . '/room-img/2_Bedroom.jpg')->preservingOriginal()->toMediaCollection();

         CategoryRoom::create([
             'room' => ['en' => 'Penthouse', 'ru' => 'Пентхаус'],
             'slug' => ['en' => 'penthouse', 'ru' => 'penthouse'],
             'category_id' => $catRent->id,
             'category_room_id' =>  8,
         ])->addMedia(resource_path() . '/room-img/Penthouse.jpg')->preservingOriginal()->toMediaCollection();

    }
}
