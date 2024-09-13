<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Wallet extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'balance',
        'is_active',
        'user_id',
    ];

    /**
     * @return BelongsTo<User, Wallet>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
