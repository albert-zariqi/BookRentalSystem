<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'reader_id',
        'book_id',
        'status',
        'request_processed_at',
        'deadline',
        'returned_at'
    ];

    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function reader() {
        return $this->belongsTo(User::class, 'reader_id');
    }

    public function librarianManageRentals() {
        return $this->belongsTo(User::class, 'request_managed_by');
    }

    public function librarianManageReturns() {
        return $this->belongsTo(User::class, 'return_managed_by');
    }
}
