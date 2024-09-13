<?php

namespace App\Models;

use Database\Factories\WalletFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, SoftDeletes};

class Wallet extends Model
{
    use SoftDeletes;

    /**
     * @use HasFactory<WalletFactory>
     */
    use HasFactory;

    protected $fillable = [
        'name',
        'balance',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * @return BelongsTo<User, Wallet>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
