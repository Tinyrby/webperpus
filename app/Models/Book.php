<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'cover_image',
        'description',
        'series_title',
        'call_number',
        'physical_description',
        'language',
        'classification',
        'content_type',
        'media_type',
        'carrier_type',
        'edition',
        'category_id',
        'specific_detail_info',
        'statement_of_responsibility',
        'is_available',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
