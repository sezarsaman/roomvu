<?php

namespace Tests\Feature\Transaction;

use App\Models\Transaction;
use App\Models\UserBalance;
use Carbon\Carbon;
use Tests\TestCase;

class StoreTransactionTest extends TestCase
{
    /*
     |--------------------------------------------------------------------------
     | Variables:
     |--------------------------------------------------------------------------
    */
    const USER_ID = 555555;

    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */

    public function test_if_user_can_store_a_transaction(): void
    {
        $response = $this
            ->withHeaders(
                [
                    "Accept" => "application/json"
                ]
            )->post(
                route("transaction.store"),
                [
                    'user_id' => self::USER_ID,
                    'amount' => 1000000
                ]
            );

        $response->assertStatus(201);

    }

    public function test_if_transaction_exists_in_db()
    {
        $this
            ->withHeaders(
                [
                    "Accept" => "application/json"
                ]
            )->post(
                route("transaction.store"),
                [
                    'user_id' => self::USER_ID + 1,
                    'amount' => 1000000
                ]
            );

        $transaction = Transaction::query()
            ->where("user_id", self::USER_ID + 1)
            ->where("amount", 1000000)
            ->where("created_at", ">", Carbon::now()->subSeconds(10)->toDateTimeString())
            ->first();

        $this->assertNotNull($transaction);
    }

    public function test_if_user_balance_changes_on_transaction()
    {

        $userBalance = UserBalance::query()
            ->create(
                [
                    'user_id' => self::USER_ID + 2,
                    'balance' => 100000,
                ]
            );

        $this
            ->withHeaders(
                [
                    "Accept" => "application/json"
                ]
            )->post(
                route("transaction.store"),
                [
                    'user_id' => self::USER_ID + 2,
                    'amount' => 1000000
                ]
            );

        $updatedUserBalance = UserBalance::query()
            ->select("balance")
            ->where("user_id", self::USER_ID + 2)
            ->first();

        $this->assertNotEquals($userBalance["balance"], $updatedUserBalance);

    }

    public function test_if_user_id_is_required()
    {
        $response = $this
            ->withHeaders(
                [
                    "Accept" => "application/json"
                ]
            )->post(
                route("transaction.store"),
                [
                    'amount' => 1000000
                ]
            );

        $response->assertStatus(422);
    }

    public function test_if_amount_is_required()
    {
        $response = $this
            ->withHeaders(
                [
                    "Accept" => "application/json"
                ]
            )->post(
                route("transaction.store"),
                [
                    'user_id' => self::USER_ID + 3
                ]
            );

        $response->assertStatus(422);
    }

}
