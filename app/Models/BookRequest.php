<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'book_id', 'status'];

    // Define relationship with Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
