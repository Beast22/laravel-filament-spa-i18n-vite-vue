<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSettings;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSettings::create([
            'site_slogan' => ['en' => 'Shetitorja Naim Frasheri', 'ru' => 'Shetitorja Naim Frasheri'],
            'site_geo' => ['en' => 'Saranda, Albania', 'ru' => 'Саранда, Албания'],
            'site_message' => ['en' => '<p>Established in 2007, Bora Property is successfully developing and expanding the knowledge and services on real estate 
                                        market in Albania. We are dedicated professionals who are passionate about property market and our country.&nbsp;</p>
                                        <p>Our vision is consideration and honesty. We do not give delusive promises. Our aim is to earn trust of our clients 
                                        by providing an excellent service and expertise. We want you to find a perfect home in Albania.&nbsp;
                                        </p><p>Bora Property is proud to be your reliable companion on this journey. Together we are building and enhancing 
                                        the prestige of Albania.&nbsp;</p><p>Director of Bora Property, Julian</p>', 

                                'ru' => '<p>Основанная в 2007, Бора Проперти успешно развивается и расширяет познания и услуги на рынке недвижимости в Албании. 
                                        Мы - преданные своему делу профессионалы, увлеченные рынком недвижимости и своей страной.&nbsp;</p><p>Наша концепция - 
                                        уважение и честность. Мы не даем обманчивых обещаний. Наша цель - завоевать доверие наших клиентов, предлагая превосходный 
                                        сервис и опыт. Мы хотим, чтобы вы нашли в Албании превосходный дом.</p><p>&nbsp; Мы рады быть вашим надежным компаньоном в 
                                        этом деле. Вместе мы построим и повысим престиж Албании.&nbsp;</p><p>Директор Бора Проперти, Юлиан</p>'
            ],
        ]);
    }
}
