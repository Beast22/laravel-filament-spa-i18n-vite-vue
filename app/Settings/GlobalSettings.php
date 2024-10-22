<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GlobalSettings extends Settings
{
    public string $site_tel;
    public string $site_tel_2;
    public string $site_email;
    public string $site_logo;
    public string $site_name;
    public string $site_description;

    public static function group(): string
    {
        return 'global';
    }
}