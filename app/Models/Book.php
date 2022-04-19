<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'authors',
        'description',
        'released_at',
        'cover_image',
        'pages',
        'language_code',
        'isbn',
        'in_stock'
    ];

    public function borrows() {
        return $this->hasMany(Borrow::class);
    }

    public function activeBorrows() {
    return $this->borrows()->where('status', '=', 'ACCEPTED');
    }

    public function genres() {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }
}
