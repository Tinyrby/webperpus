<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'title',
        'author',
        'publisher',
        'isbn',
        'notes',
    ];
}
