<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\AccountType;
use App\Enums\AccountCategory;


class Account extends Model
{
    protected $fillable = ['user_id', 'name', 'type', 'category'];

    protected $casts = [
    'type' => AccountType::class,
    'category' => AccountCategory::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function balances(): HasMany
    {
        return $this->hasMany(Balance::class);
    }
}
