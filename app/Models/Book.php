<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'book_cover', 'author', 'category_id', 'penerbit', 'shelf', 'row', 'stok', 'book_files','user_id','status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function requests()
    {
        return $this->hasMany(BookRequest::class);
    }
    public function getRequestAttribute()
    {
        // Assuming you want to retrieve the first request related to the book
        return $this->requests();
    }
}
