<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'authors',
        'description',
        'released_at',
        'cover_image',
        'pages',
        'language_code',
        'isbn',
        'in_stock',
        'genres'
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
