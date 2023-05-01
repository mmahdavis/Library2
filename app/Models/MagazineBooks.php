<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineBooks extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'magazine_id',
    ];
}
