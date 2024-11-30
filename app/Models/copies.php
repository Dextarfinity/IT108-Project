<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class copies extends Model
{
    use HasFactory;

    protected $primaryKey = 'copy_id';

    protected $fillable = ['book_id', 'date_encoded', 'status'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
