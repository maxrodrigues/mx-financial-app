<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Card extends Model
{
    use SoftDeletes;

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
