<?php

namespace App\Models;

use Database\Factories\TransactionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Transaction extends Model
{
    use SoftDeletes;

    /**
     * @use HasFactory<TransactionFactory>
     */
    use HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'description',
        'observation',
        'transaction_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'transaction_at' => 'datetime',
        ];
    }
}
