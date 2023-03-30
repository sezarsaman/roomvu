<?php

namespace Tests\Feature\UserBalance;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUserBalanceTest extends TestCase
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

    public function test_if_user_can_get_balance(): void
    {
        $response = $this->get(route("user_balance.show", self::USER_ID));

        $response->assertStatus(200);
    }

    public function test_if_unregistered_user_get_not_found_error()
    {
        $response = $this->get(route("user_balance.show", self::USER_ID * rand(5,500)));

        $response->assertStatus(404);
    }
}
