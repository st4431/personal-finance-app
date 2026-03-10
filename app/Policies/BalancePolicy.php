<?php

namespace App\Policies;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BalancePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Balance $balance): bool
    {
        return $user->_id === $balance->account->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Balance $balance): bool
    {
        return $user->_id === $balance->account->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Balance $balance): bool
    {
        return $user->_id === $balance->account->user_id;
    }
}
