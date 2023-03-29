<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateTransactionsCommand extends Command
{
    /*
     |--------------------------------------------------------------------------
     | Variables:
     |--------------------------------------------------------------------------
    */
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transactions:calculate-transactions {user=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will calculate total and daily transactions of all users if we want it for one user just add the user_id after the command';

    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */
    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $userId = $this->argument("user");

        if($userId > 0){

            $this->getTransactionForSpecifiedUser($userId);

            return;

        }

        $this->getTransactionsForAllUsers();
    }


    private function getTransactionForSpecifiedUser($userId)
    {
        $this->line("");

        $dailyTransactionsAmount = Transaction::query()
            ->where("user_id", $userId)
            ->where("created_at", ">", Carbon::now()->subDays(1)->toDateTimeString())
            ->sum("amount");

        $this->warn("Daily Transactions total amount for user id {$userId} is:");

        $this->line( number_format($dailyTransactionsAmount) . " Rials");

        $this->line("");

        $totalTransactionAmount = Transaction::query()
            ->where("user_id", $userId)
            ->sum("amount");

        $this->warn("All Transactions total amount for user id {$userId} is:");

        $this->line( number_format($totalTransactionAmount) . " Rials");

        $this->line("");

    }

    private function getTransactionsForAllUsers()
    {
        $this->line("");

        $dailyTransactionsAmount = Transaction::query()
            ->where("created_at", ">", Carbon::now()->subDays(1)->toDateTimeString())
            ->sum("amount");

        $this->warn("Daily Transactions total amount for all users is:");

        $this->line( number_format($dailyTransactionsAmount) . " Rials");

        $this->line("");

        $totalTransactionAmount = Transaction::query()
            ->sum("amount");

        $this->warn("All Transactions total amount for all users is:");

        $this->line( number_format($totalTransactionAmount) . " Rials");

        $this->line("");
    }
}
