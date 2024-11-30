<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';

    protected $fillable = [
        'title', 'category', 'genre', 'year_published', 'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function copies()
    {
        return $this->hasMany(Copy::class, 'book_id');
    }
}
