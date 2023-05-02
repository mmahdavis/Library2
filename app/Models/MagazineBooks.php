<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class MagazineBooks extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'book_id',
        'magazine_id',
    ];
}
