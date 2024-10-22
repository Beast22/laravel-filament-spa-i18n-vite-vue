<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutTitle;

class AboutTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutTitle::create([
            'title' => [
                'en' => 'Why do property investors choose Bora Property?', 
                'ru' => 'Почему инвесторы выбирают Бора Проперти',
            ],
            'descr' => [
                'en' => 'Established in 2007, Bora Property is successfully developing and expanding the knowledge and services on real estate market in Albania. We are dedicated professionals who are passionate about property market and our country.

                        Our vision is consideration and honesty. We do not give delusive promises. Our aim is to earn trust of our clients by providing an excellent service and expertise. We want you to find a perfect home in Albania.
                        
                        Bora Property is proud to be your reliable companion on this journey. Together we are building and enhancing the prestige of Albania.
                        
                        Director of Bora Property, Julian',

                'ru' => 'Основанная в 2007 году, Бора Проперти успешно развивается и пополняет рынок недвижимости в Албании знаниями и услугами. Мы преданные делу профессионалы и намерены вложить все силы в эту сферу и нашу страну. 

                        Наш подход основан на честности и уважении. Мы не даеи иллюзорных обещаний. Наша цель - завоевать доверие своих клиентов компететностью и безупречным сервисом. Мы хотим, чтобы Албания стала для вас идеальным домом.

                        Для нас большая честь стать вашим надежным компаньоном в этом путешествии. Вместе мы построим и укрепим престиж Албании.
                        
                        Директор Бора Проперти, Джулиан.',
            ],
        ]);

    }
}
