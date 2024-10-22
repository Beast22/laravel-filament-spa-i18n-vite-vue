<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Translatable\HasTranslations;

class ServiceItem extends Model
{
    use HasFactory;
    use Searchable;
    use HasTranslations;

    protected $fillable = ['text'];

    protected $searchableFields = ['*'];

    protected $table = 'service_items';

    protected $casts = [
        'text' => 'array',
    ];

    public $translatable = ['text'];
}
