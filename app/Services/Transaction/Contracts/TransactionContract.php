<?php

namespace App\Services\Transaction\Contracts;

interface TransactionContract
{
    public function storeTransaction(array $transactionArray): int;
}
