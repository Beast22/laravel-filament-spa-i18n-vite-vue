<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Social;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Social::create([
            'url' => 'https://www.facebook.com/boraproperty',
        ])->addMedia(resource_path() . '/social/fb.svg')->preservingOriginal()->toMediaCollection('socials');

        Social::create([
            'url' => 'https://www.instagram.com/bora_property/',
        ])->addMedia(resource_path() . '/social/inst.svg')->preservingOriginal()->toMediaCollection('socials');
    }
}
