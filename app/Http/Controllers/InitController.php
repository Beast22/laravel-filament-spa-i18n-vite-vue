<?php

namespace App\Http\Controllers;

use App\Settings\GlobalSettings;
use App\Models\SiteSettings;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\CategoryCityController;
use App\Http\Controllers\CategoryPriceController;
use App\Http\Controllers\CategoryRoomController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Controllers\FooterMenuController;
use App\Http\Controllers\PageController;


class InitController extends Controller
{
    /**
     * Display an initial data for app.
     */

    public function index(GlobalSettings $settings): array
    {
        $socials = (new SocialController)->index();
        $cities = (new CategoryCityController)->index();
        $prices = (new CategoryPriceController)->index();
        $rooms = (new CategoryRoomController)->index();
        $goods = (new GoodController)->index();
        $latest = (new GoodController)->latest();
        $clients = (new ClientController)->index();
        $services = (new ServiceItemController)->index();
        $info = (new SiteSettingsController)->index();
        $pages = (new PageController)->index();
        $fmenu = (new FooterMenuController)->index();

        return [
            'data' => [
                'loaded' => true,
                'title' => $settings->site_name,
                'phone' => $settings->site_tel,
                'phone2' => $settings->site_tel_2,
                'email' => $settings->site_email,
                'logo' => $settings->site_logo,
                'socials' => $socials,
                'cities' => $cities,
                'prices' => $prices,
                'rooms' => $rooms,
                'goods' => $latest,
                'clients' => $clients,
                'services' => $services,
                'info' => $info,
                'pages' => $pages,
                'fmenu' => $fmenu,
            ]
        ];
    }
}
