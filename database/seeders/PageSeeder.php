<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'slug' => 'privacy',
            'title' => [
                'en' => 'Privacy policy', 
                'ru' => 'Приватная политика сайта'
            ],
            'content' => [
                'en' => 'Bora Property Privacy policy',
                'ru' => 'Приватная политика сайта Бора Проперти',
            ],
        ]);
    }
}
