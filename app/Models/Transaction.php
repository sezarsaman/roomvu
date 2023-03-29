<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 *
 * @property int id
 * @property int user_id
 * @property int amount
 * @property int reference_id
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 */
class Transaction extends Model
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
    protected $guarded = ["id"];

}
