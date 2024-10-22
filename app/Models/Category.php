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

class Category extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use InteractsWithMedia;
    use HasTranslations;

    protected $fillable = ['id', 'title', 'slug'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'title' => 'array',
    ];

    public $translatable = ['title'];

    public function categoryCities()
    {
        return $this->hasMany(CategoryCity::class);
    }

    public function categoryPrices()
    {
        return $this->hasMany(CategoryPrice::class);
    }

    public function categoryRooms()
    {
        return $this->hasMany(CategoryRoom::class);
    }
}
