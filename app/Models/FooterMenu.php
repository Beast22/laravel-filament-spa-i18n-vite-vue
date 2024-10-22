<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Translatable\HasTranslations;

class FooterMenu extends Model
{
    use HasFactory;
    use Searchable;
    use HasTranslations;

    protected $fillable = ['item', 'url', 'item_index'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'item' => 'array',
    ];

    protected $table = 'footer_menus';

    public $translatable = ['item'];

}
