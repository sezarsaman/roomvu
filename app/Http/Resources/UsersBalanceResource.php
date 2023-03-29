<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\UserBalance;

/**
 *
 * Class UsersBalanceResource
 *
 * @mixin UserBalance
 *
 */

class UsersBalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "balance" => $this->balance
        ];
    }
}
