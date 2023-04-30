<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagRelations extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'tag_id',
        'type',
    ];
}
