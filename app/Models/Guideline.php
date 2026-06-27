<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guideline extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title_id',
        'title_en',
        'type',
        'file_path',
        'video_url',
        'order',
        'is_active',
    ];
}
