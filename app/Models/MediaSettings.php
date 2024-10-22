<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaSettings extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use InteractsWithMedia;

    protected $fillable = [];

    protected $searchableFields = ['*'];

    protected $table = 'media_settings';

    public function registerMediaConversions(Media $media = null): void
        {
            $this
                ->addMediaConversion('preview')
                ->fit(Manipulations::FIT_CROP, 300, 300)
                ->nonQueued();
        }
}
