<?php

namespace App\Services\Transaction\Contracts;

use App\Models\Transaction;

interface TransactionContract
{
    public function storeTransaction(array $transactionArray): Transaction;
}
