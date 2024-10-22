<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class AboutTitle extends Model
{
    use HasFactory;
    use Searchable;
    use HasTranslations;

    protected $fillable = ['title', 'descr'];

    protected $casts = [
        'title' => 'json',
        'descr' => 'json',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'about_title';

    public $translatable = ['title','descr'];
}
