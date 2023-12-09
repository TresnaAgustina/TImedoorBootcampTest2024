<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Rating;
use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        'title',
        'author_id',
        'category_id',
    ];

    // relationship
    public function category()
    {
        return $this->belongsTo(BookCategory::class);
    }
    

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}
