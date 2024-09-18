<?php

namespace App\Models;

use Database\Factories\CardFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, SoftDeletes};

class Card extends Model
{
    use SoftDeletes;

    /**
     * @use HasFactory<CardFactory>
     */
    use HasFactory;

    protected $fillable = [
        'name',
        'bank',
        'limit',
        'user_id',
    ];

    /**
     * @return BelongsTo<User, Card>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
