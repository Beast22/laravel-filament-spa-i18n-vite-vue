<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        // Categories

        $catBuy = Category::create([
            'title' => ['en' => 'Buy', 'ru' => 'Покупка'],
            'slug' => 'buy'
        ]);

        $catRent = Category::create([
            'title' => ['en' => 'Rent', 'ru' => 'Рента'],
            'slug' => 'rent'
        ]);

        $this->call(AboutTitleSeeder::class);
        $this->call(BlogEntrySeeder::class);
        $this->call(CategoryCitySeeder::class);
        $this->call(CategoryPriceSeeder::class);
        $this->call(CategoryRoomSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(FooterMenuSeeder::class);
        $this->call(GoodSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(ServiceItemSeeder::class);
        $this->call(SocialSeeder::class);
        $this->call(SiteSettingsSeeder::class);
        $this->call(UserSeeder::class);
    }
}
