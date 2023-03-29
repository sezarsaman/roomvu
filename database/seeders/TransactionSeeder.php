<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\UserBalance;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::factory()
            ->count(1000)
            ->create();
    }
}
