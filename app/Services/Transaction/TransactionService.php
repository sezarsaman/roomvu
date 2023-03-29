<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Services\Transaction\Contracts\TransactionContract;
use App\Services\UserBalance\UsersBalanceService;
use Illuminate\Support\Facades\DB;

class TransactionService implements TransactionContract
{

    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */

    public function storeTransaction(array $transactionArray): Transaction
    {
        return DB::transaction(function () use ($transactionArray){

            $transaction = Transaction::query()->create(
                [
                    'user_id' => $transactionArray['user_id'],
                    'amount' => $transactionArray['amount'],
                    'reference_id' => time() + $transactionArray['user_id'] + mt_rand(9999,999999)
                ]
            );

            UsersBalanceService::updateBalanceByUserId(
                $transactionArray['user_id'],
                $transactionArray['amount']
            );

            return $transaction;

        });
    }
}
