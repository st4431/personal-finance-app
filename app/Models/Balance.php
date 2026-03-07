<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    protected $fillable = ['account_id', 'year', 'month', 'balance'];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
