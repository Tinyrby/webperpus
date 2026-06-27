<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['book_id', 'name', 'content'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
