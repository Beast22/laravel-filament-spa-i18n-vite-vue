<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceItem;

class ServiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceItem::create([
            'text' => ['en' => 'An apartment cleaning', 
                       'ru' => 'Уборка квартир'],

        ]);
        ServiceItem::create([
            'text' => ['en' => 'Visual inspection of the interior, and check for any obvious defects', 
                       'ru' => 'Визуальный осмотр интерьера и проверка на явные дефекты'],

        ]);
        ServiceItem::create([
            'text' => ['en' => 'Examination of all furniture and furnishings for any possible inconvenience', 
                       'ru' => 'Проверка всей мебели и обстановки на предмет возможных неудобств'],

        ]);
        ServiceItem::create([
            'text' => ['en' => 'Test of security services and equipment', 
                       'ru' => 'Проверка охранных услуг и инвентаря'],

        ]);
        ServiceItem::create([
            'text' => ['en' => 'A full inventory of the apartments in case it was rented before', 
                       'ru' => 'Полная опись имущества апартаментов, если они ранее сдавались а аренду'],

        ]);
        ServiceItem::create([
            'text' => ['en' => 'Test of all appliances and electrical equipment', 
                       'ru' => 'Проверка всех приборов и электрооборудования'],

        ]);
        ServiceItem::create([
            'text' => ['en' => 'Check of all sanitary equipment and plumbing', 
                       'ru' => 'Проверка всей сантехники и водопровода'],

        ]);
        ServiceItem::create([
            'text' => ['en' => 'Preparation and sending of monthly pictures', 
                       'ru' => 'Подготовка и отправление фото'],

        ]);
    }
}
