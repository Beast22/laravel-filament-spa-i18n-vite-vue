<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Good;
use App\Models\CategoryCity;
use App\Models\CategoryPrice;
use App\Models\CategoryRoom;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Categories City

        $cityKsamilBuy = CategoryCity::where('id', '=', 1)->first();
        $cityLalziBuy = CategoryCity::where('id', '=', 2)->first();
        $citySarandaBuy = CategoryCity::where('id', '=', 3)->first();
        $cityVloraBuy = CategoryCity::where('id', '=', 4)->first();

        $cityKsamilRent = CategoryCity::where('id', '=', 5)->first();
        $cityLalziRent = CategoryCity::where('id', '=', 6)->first();
        $citySarandaRent= CategoryCity::where('id', '=', 7)->first();
        $cityVloraRent = CategoryCity::where('id', '=', 8)->first();

        // Categories Price

        $priceFirstBuy = CategoryPrice::where('id', '=', 1)->first();
        $priceSecBuy = CategoryPrice::where('id', '=', 2)->first();
        $priceThirdBuy = CategoryPrice::where('id', '=', 3)->first();
        $priceFourBuy = CategoryPrice::where('id', '=', 4)->first();

        $priceFirstRent = CategoryPrice::where('id', '=', 5)->first();
        $priceSecRent = CategoryPrice::where('id', '=', 6)->first();
        $priceThirdRent = CategoryPrice::where('id', '=', 7)->first();
        $priceFourRent = CategoryPrice::where('id', '=', 8)->first();

        // Categories Room

        $roomStudioBuy= CategoryRoom::where('id', '=', 1)->first();
        $roomOnebedBuy = CategoryRoom::where('id', '=', 2)->first();
        $roomTwobedBuy = CategoryRoom::where('id', '=', 3)->first();
        $roomPentBuy = CategoryRoom::where('id', '=', 4)->first();

        $roomStudioRent = CategoryRoom::where('id', '=', 5)->first();
        $roomOnebedRent = CategoryRoom::where('id', '=', 6)->first();
        $roomTwobedRent = CategoryRoom::where('id', '=', 7)->first();
        $roomPentRent = CategoryRoom::where('id', '=', 8)->first();


        // Goods

        Good::create([
            'title' => ['en' => 'Full sea view apartment next to the promenade', 'ru' => 'Квартира рядом с набережной с видом на море'],
            'city' => ['en' => 'Albania, Saranda', 'ru' => 'Албания, Саранда'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'],
            'beds' => '2',
            'bath' => '6',
            'floor' => '1',
            'square' => '250',
            'price' => '2100',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 1,
            'category_city_id' => $citySarandaRent->id,
            'category_room_id' => $roomTwobedRent->id,
            'category_price_id' => $priceFourRent->id,
        ]);

        $good_1 = Good::where('id', '=', 1)->first();
        $good_1->addMedia(resource_path() . '/good-img/1/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_1->addMedia(resource_path() . '/good-img/1/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_1->addMedia(resource_path() . '/good-img/1/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_1->addMedia(resource_path() . '/good-img/1/4.jpg')->preservingOriginal()->toMediaCollection('goods');


        Good::create([
            'title' => ['en' => '1 BEDROOM WITH SPACIOUS VERANDA', 'ru' => '1 спальня с просторной верандой'],
            'city' => ['en' => 'Albania, Vlora', 'ru' => 'Албания, Влора'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '1',
            'bath' => '2',
            'floor' => '1',
            'square' => '100',
            'price' => '750',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 1,
            'category_city_id' => $cityVloraRent->id,
            'category_room_id' => $roomOnebedRent->id,
            'category_price_id' => $priceThirdRent->id,
        ]);

        $good_2 = Good::where('id', '=', 2)->first();
        $good_2->addMedia(resource_path() . '/good-img/2/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_2->addMedia(resource_path() . '/good-img/2/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_2->addMedia(resource_path() . '/good-img/2/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_2->addMedia(resource_path() . '/good-img/2/4.jpg')->preservingOriginal()->toMediaCollection('goods');


        Good::create([
            'title' => ['en' => 'FURNISHED PENTHOUSE WITH FULL SEA VIEW', 'ru' => 'Меблированный пентхаус с видом на море'],
            'city' => ['en' => 'Albania, Saranda', 'ru' => 'Албания, Саранда'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '1',
            'bath' => '2',
            'floor' => '2',
            'square' => '234',
            'price' => '500',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 1,
            'category_city_id' => $citySarandaRent->id,
            'category_room_id' => $roomOnebedRent->id,
            'category_price_id' => $priceSecRent->id,
        ]);

        $good_3 = Good::where('id', '=', 3)->first();
        $good_3->addMedia(resource_path() . '/good-img/3/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_3->addMedia(resource_path() . '/good-img/3/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_3->addMedia(resource_path() . '/good-img/3/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_3->addMedia(resource_path() . '/good-img/3/4.jpg')->preservingOriginal()->toMediaCollection('goods');


        Good::create([
            'title' => ['en' => 'STUDIO AT SAIL 2', 'ru' => 'Студия в Зоне 2'],
            'city' => ['en' => 'Albania, Saranda', 'ru' => 'Албания, Саранда'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '1',
            'bath' => '2',
            'floor' => '2',
            'square' => '75',
            'price' => '350',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 1,
            'category_city_id' => $citySarandaRent->id,
            'category_room_id' => $roomStudioRent->id,
            'category_price_id' => $priceFirstRent->id,
        ]);

        $good_4 = Good::where('id', '=', 4)->first();
        $good_4->addMedia(resource_path() . '/good-img/4/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_4->addMedia(resource_path() . '/good-img/4/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_4->addMedia(resource_path() . '/good-img/4/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_4->addMedia(resource_path() . '/good-img/4/4.jpg')->preservingOriginal()->toMediaCollection('goods');


        Good::create([
            'title' => ['en' => 'FULLY FURNISHED WITH SPACIOUS VERANDA', 'ru' => 'Полностью мебилированные апартаменты с просторной верандой'],
            'city' => ['en' => 'Albania, Vlora', 'ru' => 'Албания, Влора'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '3',
            'bath' => '2',
            'floor' => '7',
            'square' => '100',
            'price' => '1260',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 0,
            'category_city_id' => $cityVloraRent->id,
            'category_room_id' => $roomTwobedRent->id,
            'category_price_id' => $priceFourRent->id,
        ]);

        $good_5 = Good::where('id', '=', 5)->first();
        $good_5->addMedia(resource_path() . '/good-img/5/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_5->addMedia(resource_path() . '/good-img/5/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_5->addMedia(resource_path() . '/good-img/5/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_5->addMedia(resource_path() . '/good-img/5/4.jpg')->preservingOriginal()->toMediaCollection('goods');


        Good::create([
            'title' => ['en' => 'STUDIO APARTMENT WITH PARTIAL SEA VIEW', 'ru' => 'Студия с частичным видом на море'],
            'city' => ['en' => 'Albania, Saranda', 'ru' => 'Албания, Саранда'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '0',
            'bath' => '1',
            'floor' => '2',
            'square' => '40',
            'price' => '490',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 0,
            'category_city_id' => $citySarandaRent->id,
            'category_room_id' => $roomStudioRent->id,
            'category_price_id' => $priceThirdRent->id,
        ]);

        $good_6 = Good::where('id', '=', 6)->first();
        $good_6->addMedia(resource_path() . '/good-img/6/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_6->addMedia(resource_path() . '/good-img/6/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_6->addMedia(resource_path() . '/good-img/6/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_6->addMedia(resource_path() . '/good-img/6/4.jpg')->preservingOriginal()->toMediaCollection('goods');

        
        Good::create([
            'title' => ['en' => 'SEA VIEW', 'ru' => 'Вид на море'],
            'city' => ['en' => 'Albania, Vlora', 'ru' => 'Албания, Влора'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '1',
            'bath' => '2',
            'floor' => '2',
            'square' => '250',
            'price' => '350 000',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 0,
            'category_city_id' => $cityVloraBuy->id,
            'category_room_id' => $roomOnebedBuy->id,
            'category_price_id' => $priceFourBuy->id,
        ]);

        $good_7 = Good::where('id', '=', 7)->first();
        $good_7->addMedia(resource_path() . '/good-img/7/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_7->addMedia(resource_path() . '/good-img/7/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_7->addMedia(resource_path() . '/good-img/7/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_7->addMedia(resource_path() . '/good-img/7/4.jpg')->preservingOriginal()->toMediaCollection('goods');


        Good::create([
            'title' => ['en' => 'ONE BEDROOMS APARTMENT AT SEA BREEZE 2 RESIDENCE', 'ru' => 'Однокомнатная квартира в резиденции Морской Бриз 2'],
            'city' => ['en' => 'Albania, Ksamil', 'ru' => 'Албания, Ксамил'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '1',
            'bath' => '1',
            'floor' => '4',
            'square' => '94',
            'price' => '135 000',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 0,
            'category_city_id' => $cityKsamilBuy->id,
            'category_room_id' => $roomOnebedBuy->id,
            'category_price_id' => $priceThirdBuy->id,
        ]);

        $good_8 = Good::where('id', '=', 8)->first();
        $good_8->addMedia(resource_path() . '/good-img/8/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_8->addMedia(resource_path() . '/good-img/8/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_8->addMedia(resource_path() . '/good-img/8/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_8->addMedia(resource_path() . '/good-img/8/4.jpg')->preservingOriginal()->toMediaCollection('goods');


        Good::create([
            'title' => ['en' => 'SPACIOUS VERANDA', 'ru' => 'Просторная веранда'],
            'city' => ['en' => 'Albania, Lalzi Bay', 'ru' => 'Албания, Лалзи Бэй'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '3',
            'bath' => '2',
            'floor' => '7',
            'square' => '100',
            'price' => '240 000',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 0,
            'category_city_id' => $cityLalziBuy->id,
            'category_room_id' => $roomTwobedBuy->id,
            'category_price_id' => $priceFourBuy->id,
        ]);

        $good_9 = Good::where('id', '=', 9)->first();
        $good_9->addMedia(resource_path() . '/good-img/9/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_9->addMedia(resource_path() . '/good-img/9/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_9->addMedia(resource_path() . '/good-img/9/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_9->addMedia(resource_path() . '/good-img/9/4.jpg')->preservingOriginal()->toMediaCollection('goods');


        Good::create([
            'title' => ['en' => 'VERANDA', 'ru' => 'Веранда'],
            'city' => ['en' => 'Albania, Lalzi Bay', 'ru' => 'Албания, Лалзи Бэй'],
            'descr' => ['en' => '<p>Residence "Agora" is located in the new prestigious area of Saranda on the first line of the Ionian Sea. 
                                This residence is built in a modern and stylish form, with an amazing interior decor.<br><br>Built in a favourable, 
                                with every facilities around it such as: restaurants, grocery stores, caffee places, etc. Agora it is known for its 
                                amazing beaches and its vivid atmosphere throughout the summer season. By the beach, there are located beach bars, 
                                and places to rent a boat, a jetski or a canoe.<br><br>PRICE: €109 844<br><br>1ST PAYMENT 
                                (CONTRACT) : €54 922<br>2ND PAYMENT (KEYS) : €49 430<br>3RD PAYMENT (CERTIFICATE): €5 492<br>COMMISSION: €5 492</p>', 
                        'ru' => 'Резиденция Агора расположена в новом престижом районе Саранды, на первой линии Ионического моря.
                                Здание построено в современном и элегантном стиле и великолепно декорированно изнутри.<br><br>Рядом имеется вся инфраструктра:
                                рестораны, продуктовые магазины, кофейни и т.д. Агора известна своими превосходными пляжами и яркой атмосферой на протяжении
                                всего лета. На пляже имеются бары и места для аренды лодок, водных лыж или каноэ.<br><br>ЦЕНА: €109 844<br><br>1-Я ВЫПЛАТА
                                (КОНТРАКТ) : €54 922<br>2-Я ВЫПЛАТА (КЛЮЧИ) : €49 430<br>3-Я ВЫПЛАТА (СЕРТИФИКАТ): €5 492<br>КОММИССИЯ: €5 492</p>'
                        ],
            'beds' => '0',
            'bath' => '2',
            'floor' => '7',
            'square' => '100',
            'price' => '90 000',
            'video' => 'https://www.youtube.com/watch?v=KRrpktEb-Qo',
            'is_published' => 1,
            'sold' => 0,
            'latest' => 0,
            'category_city_id' => $cityLalziBuy->id,
            'category_room_id' => $roomStudioBuy->id,
            'category_price_id' => $priceSecBuy->id,
        ]);

        $good_10 = Good::where('id', '=', 10)->first();
        $good_10->addMedia(resource_path() . '/good-img/10/1.jpg')->preservingOriginal()->toMediaCollection('floorplants');
        $good_10->addMedia(resource_path() . '/good-img/10/2.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_10->addMedia(resource_path() . '/good-img/10/3.jpg')->preservingOriginal()->toMediaCollection('goods');
        $good_10->addMedia(resource_path() . '/good-img/10/4.jpg')->preservingOriginal()->toMediaCollection('goods');

    }
}
