<?php

namespace Codecycler\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'cms_pages';

    protected $guarded = [
        'id',
        'update_at',
        'created_at',
    ];

    protected $casts = [
        'blocks' => 'json',
        'blocks_before' => 'json',
    ];

    public static function findByUrl($url)
    {
        return static::where('url', $url)->first();
    }
}