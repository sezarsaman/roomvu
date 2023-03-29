<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(TransactionSeeder::class);

        DB::statement(
            "INSERT
                    INTO
                        users_balance(user_id,balance,updated_at,created_at)
                    SELECT
                        user_id, SUM(amount), NOW(), NOW()
                    FROM
                        transactions
                    GROUP BY
                        user_id"
        );

    }
}
