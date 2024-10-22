<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGlobalSettings extends SettingsMigration

{
    public function up(): void
    {
        $this->migrator->add('global.site_name', 'Bora property SPA');
        $this->migrator->add('global.site_description', 'Bora property awesome site');
        $this->migrator->add('global.site_tel', '+355 69 40 18881');
        $this->migrator->add('global.site_tel_2', '+355 69 40 18882');
        $this->migrator->add('global.site_email', 'info@boraproperty.com');
        $this->migrator->add('global.site_logo', 'logo/bora.svg');
    }
};
