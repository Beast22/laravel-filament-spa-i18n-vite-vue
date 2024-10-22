<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Application extends Model
{
    use HasFactory;
    use Searchable;
    use HasTranslations;

    protected $fillable = ['name', 'tel', 'country', 'object'];

    protected $searchableFields = ['*'];

    protected $table = 'applications';

    protected $casts = [
        'object' => 'array',
    ];

    public $translatable = ['object'];

}
