<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'book_id',
        'borrow_date',
        'due_date',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    protected static function booted()
    {
        static::saved(function ($loan) {
            $loan->syncBookAvailability();
            
            // Update old book if book_id was changed
            if ($loan->isDirty('book_id') && $loan->getOriginal('book_id')) {
                $oldBook = Book::find($loan->getOriginal('book_id'));
                if ($oldBook) {
                    $oldBook->update([
                        'is_available' => !Loan::where('book_id', $oldBook->id)->where('status', 'Dipinjam')->exists()
                    ]);
                }
            }
        });

        static::deleted(function ($loan) {
            $loan->syncBookAvailability();
        });
    }

    public function syncBookAvailability()
    {
        if ($this->book) {
            $this->book->update([
                'is_available' => !Loan::where('book_id', $this->book_id)->where('status', 'Dipinjam')->exists()
            ]);
        }
    }
}
