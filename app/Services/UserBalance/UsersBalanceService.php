<?php

namespace App\Services\UserBalance;

use App\Models\UserBalance;
use App\Services\UserBalance\Contracts\UsersBalanceContract;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UsersBalanceService implements UsersBalanceContract
{

    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */
    public function getBalanceByUserId(int $userId): UserBalance
    {
        $userBalance = UserBalance::query()->where('user_id', $userId)->first();

        if (is_null($userBalance)) {

            throw new NotFoundHttpException("NOT FOUND!");

        }

        return $userBalance;
    }

    public static function updateBalanceByUserId(int $userId, int $amount): void
    {
        $userBalance = UserBalance::query()
            ->where('user_id', $userId)
            ->first();

        if (is_null($userBalance)) {
            UserBalance::query()
                ->create(
                    [
                        'user_id' => $userId,
                        'balance' => $amount
                    ]
                );

            return;
        }

        $userBalance->balance += $amount;
        $userBalance->save();
    }
}
