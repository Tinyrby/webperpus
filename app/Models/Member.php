<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'name',
        'email',
        'phone',
        'faculty',
        'study_program',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
