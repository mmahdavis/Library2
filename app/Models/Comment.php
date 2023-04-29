<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Comment extends Model
{
    use HasFactory;
    use HasApiTokens;

    /**
     * Get all of the book for the Comment
     */
    public function book(): BelongsTo
    {
        return $this->BelongsTo(Book::class);
    }
}
