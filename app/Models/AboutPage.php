<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'slug',
        'title_id',
        'title_en',
        'type',
        'content_id',
        'content_en',
        'file_path',
        'video_url',
        'order',
        'is_active',
    ];
}
