<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserBalance
 *
 * @property int id
 * @property int user_id
 * @property int balance
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string numberFormattedBalance
 *
 */

class UserBalance extends Model
{
    /*
     |--------------------------------------------------------------------------
     | Traits:
     |--------------------------------------------------------------------------
    */
    use HasFactory;

    /*
     |--------------------------------------------------------------------------
     | Variables:
     |--------------------------------------------------------------------------
    */
    protected $table = "users_balance";

    protected $guarded = ["id"];

    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */
    protected function getNumberFormattedBalanceAttribute(): string
    {
        return number_format($this->balance) . " Rials";
    }

}
