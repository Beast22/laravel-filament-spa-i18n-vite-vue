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

class CategoryRoom extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use InteractsWithMedia;
    use HasTranslations;

    protected $fillable = ['id', 'room', 'slug', 'category_id', 'category_room_id'];

    protected $searchableFields = ['*'];

    protected $table = 'category_rooms';

    protected $casts = [
        'room' => 'array',
        'slug' => 'array',
    ];

    public $translatable = ['room'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('filament_preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function goods()
    {
        return $this->hasMany(Good::class);
    }
}
