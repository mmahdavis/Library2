<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'slug',
    ];
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    public function specialIssue(): HasMany
    {
        return $this->hasMany(SpecialIssue::class);
    }
}
