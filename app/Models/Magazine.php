<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class Magazine extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'image',
        'name',
        'slug',
        'price',
    ];

    /**
     * Get all of the books for the Magazine
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'magazine_books', 'magazine_id', 'book_id');
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_ralations', 'entity_id', 'tag_id');
    }
}
