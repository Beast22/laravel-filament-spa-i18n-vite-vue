<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class SiteSettings extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use InteractsWithMedia;
    use HasTranslations;

    protected $fillable = [
        'site_slogan',
        'site_geo',
        'site_message',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'site_settings';

    protected $casts = [
        'site_slogan' => 'array',
        'site_geo' => 'array',
        'site_message' => 'array',
    ];

    public $translatable = ['site_slogan','site_geo','site_message'];

    public function registerMediaConversions(Media $media = null): void
        {
            $this
                ->addMediaConversion('preview')
                ->fit(Manipulations::FIT_CROP, 300, 300)
                ->nonQueued();
        }
}
