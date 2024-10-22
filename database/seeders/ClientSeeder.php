<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        Client::create([
            'name' => ['en' => 'Elise', 'ru' => 'Алиса'],
            'descr' => [
                        'en' => 'Thank you for all the appropriate informations. This informations made it easier for us to choose our home in Vlora.
                                Your support, gave us more confidence about our choice. As well, all the Albanian people, are friendly, hospitable and very 
                                communicative. So, it was very nice for us to know that for every step, we worked together.', 
                        'ru' => 'Спасибо за нужную информацию. Она облегчила нам поиски дома в Виоре.                   
                                Ваша поддержка вселила уверенность в выборе жилья. К тому же все албанцы дружелюбны, гостеприимны и очень
                                общительны. Поэтому нам очень приятно осознавать, что мы так много прошли вместе.'
                       ],
        ])->addMedia(resource_path() . '/client-img/Elise.jpg')->preservingOriginal()->toMediaCollection();

        Client::create([
            'name' => ['en' => 'John', 'ru' => 'Джон'],
            'descr' => [
                        'en' => 'We have bought an apartment furnished in Saranda. Our apartment is located at the part of 
                            the city when local people live all around the year. We visited a lot of properties with the local agent Bora Property 
                            and the process was easy to choose.', 
                        'ru' => 'Мы приобрели апартаменты с мебелью. Наша квартира расположена в районе города, где местные живут круглый
                            год. Вместе с агентом Бора Проперти мы посетили несколько апартаментов и с легкостью выбрали нужные.'
                       ],
        ])->addMedia(resource_path() . '/client-img/John.jpg')->preservingOriginal()->toMediaCollection();

        Client::create([
            'name' => ['en' => 'Eric', 'ru' => 'Эрик'],
            'descr' => [
                        'en' => 'In addition to his vast knowledge of the markets I was interested in, he also had multiple friendly and knowledgeable 
                                connections including but not limited to inspectors and mortgage brokers. Julian made sure I was taken care of at every
                                step of the way.', 
                        'ru' => 'Кроме обширных познаний в интересующим меня рынке недвижимости, я завел немало полезных и приятных знакомств, причем
                                не только среди инспекторов и ипотечных брокеров. Джулиан уверен, что обо мне позаботятся в любой момент.'
                       ],
        ])->addMedia(resource_path() . '/client-img/Eric.jpg')->preservingOriginal()->toMediaCollection();

        Client::create([
            'name' => ['en' => 'Emma', 'ru' => 'Эмма'],
            'descr' => [
                        'en' => 'The biggest issue when you buy an apartment, is always the registration process. But, the staff of BPA handled all the 
                                 transactions and i was informed, so it was like i was there.
                                Except from this, we work together, as a team, for the decorations and the furnitures. So I did not need to ask a lot of 
                                questions, they manage every section very well.', 
                        'ru' => 'Самая большая проблема при покупке квартиры - это всегда процесс регистрации. Но все операции взяли на себя сотрудники БП, 
                                и я узнавала о них словно сама там присутствовала.'
                       ],
        ])->addMedia(resource_path() . '/client-img/Emma.jpg')->preservingOriginal()->toMediaCollection();
    }
}
