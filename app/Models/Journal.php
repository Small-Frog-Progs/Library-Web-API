<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = 'journal';

    protected $fillable = [
        'user_id',
        'book_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected function User()
    {
        return $this->belongsTo(User::class);
    }

    protected function Book()
    {
        return $this->belongsTo(Book::class);
    }
}
