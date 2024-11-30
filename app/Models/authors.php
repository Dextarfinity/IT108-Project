<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class authors extends Model
{
    use HasFactory;

    protected $primaryKey = 'author_id';

    protected $fillable = ['name', 'country'];
}
