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
    ];
}