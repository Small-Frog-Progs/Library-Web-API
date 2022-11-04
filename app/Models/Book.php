<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_id',
        'category_id',
        'shelf_id',
        'number_of_pages',
        'image_path',
        'is_digit',
        'book_path',
    ];

    public function scopeDigital($query): Builder
    {
        return $query->where('is_digital', 1);
    }

    public function scopeNonDigital($query): Builder
    {
        return $query->where('is_digital', 0);
    }

    public function Category() {
        return $this->belongsTo(Category::class);
    }

    public function Authors() {
        return $this->belongsToMany(Author::class);
    }

    public function Genres() {
        return $this->belongsToMany(Genre::class);
    }

    public function Shelf() {
        return $this->belongsTo(Shelf::class);
    }
}
