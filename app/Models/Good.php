<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Good extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use InteractsWithMedia;
    use HasTranslations;

    protected $fillable = [
        'title',
        'descr',
        'city',
        'beds',
        'bath',
        'floor',
        'square',
        'price',
        'video',
        'is_published',
        'sold',
        'latest',
        'category_city_id',
        'category_room_id',
        'category_price_id',
    ];

    protected $searchableFields = ['*'];

    public $translatable = ['title', 'descr', 'city'];

    protected $casts = [
        'title' => 'array',
        'descr' => 'array',
        'city' => 'array',
        'beds' => 'array',
        'bath' => 'array',
        'floor' => 'array',
        'square' => 'array',
        'price' => 'array',
        'video' => 'array',
        'is_published' => 'boolean',
        'sold' => 'boolean',
        'latest' => 'boolean',
    ];

    public function categoryCity()
    {
        return $this->belongsTo(CategoryCity::class);
    }

    public function categoryRoom()
    {
        return $this->belongsTo(CategoryRoom::class);
    }

    public function categoryPrice()
    {
        return $this->belongsTo(CategoryPrice::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('filament_preview')
            ->fit(Manipulations::FIT_CROP, 400, 250)
            ->sharpen(10)
            ->nonQueued();
        $this
            ->addMediaConversion('preview')
            ->width(700)
            ->height(700)
            ->sharpen(10)
            ->nonQueued();
        $this
            ->addMediaConversion('large')
            ->width(1500)
            ->height(1500)
            ->sharpen(10)
            ->nonQueued();
    }
}
