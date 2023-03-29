<?php

namespace App\Services\UserBalance\Contracts;

use App\Models\UserBalance;

interface UsersBalanceContract
{
    public function getBalanceByUserId(int $userId): UserBalance;

    public static function updateBalanceByUserId(int $userId, int $amount): void;

}
