<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FooterMenu;

class FooterMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FooterMenu::create([
            'item' => ['en' => 'Buy', 'ru' => 'Покупка'],
            'url' => 'buy-rent',
            'item_index' => 'buy-rent',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Rent', 'ru' => 'Рента'],
            'url' => 'buy-rent',
            'item_index' => 'buy-rent',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Sold', 'ru' => 'Продано'],
            'url' => 'sold',
            'item_index' => 'buy-rent',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Saranda', 'ru' => 'Саранда'],
            'url' => 'buy-rent',
            'item_index' => 'city',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Vlora', 'ru' => 'Влора'],
            'url' => 'buy-rent',
            'item_index' => 'city',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Ksamil', 'ru' => 'Ксамил'],
            'url' => 'buy-rent',
            'item_index' => 'city',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Lalzi Bay', 'ru' => 'Лалзи Бэй'],
            'url' => 'buy-rent',
            'item_index' => 'city',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Studio', 'ru' => 'Студио'],
            'url' => 'buy-rent',
            'item_index' => 'room',
        ]);
        FooterMenu::create([
            'item' => ['en' => '1 bedroom', 'ru' => '1 спальня'],
            'url' => 'buy-rent',
            'item_index' => 'room',
        ]);
        FooterMenu::create([
            'item' => ['en' => '2 bedroom+', 'ru' => '2 спальни+'],
            'url' => 'buy-rent',
            'item_index' => 'room',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Penthouse', 'ru' => 'Пентхаус'],
            'url' => 'buy-rent',
            'item_index' => 'room',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Services', 'ru' => 'Услуги'],
            'url' => '#service',
            'item_index' => 'info',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'About', 'ru' => 'О нас'],
            'url' => '#about',
            'item_index' => 'info',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Blog', 'ru' => 'Блог'],
            'url' => 'blog',
            'item_index' => 'info',
        ]);
        FooterMenu::create([
            'item' => ['en' => 'Contacts', 'ru' => 'Контакты'],
            'url' => '#contacts',
            'item_index' => 'info',
        ]);
    }
}
