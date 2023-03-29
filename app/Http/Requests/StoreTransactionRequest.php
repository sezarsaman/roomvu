<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="StoreTransactionRequest",
 *     description="Request body for storing transaction",
 *     @OA\Xml(
 *         name="StoreTransactionRequest"
 *     ),
 *     @OA\Property(property="user_id", type="integer", description="Id of a user", example=1850),
 *     @OA\Property(property="amount", type="integer", description="Amount of Transaction", example=100000),
 * )
 */
class StoreTransactionRequest extends FormRequest
{
    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'numeric', 'gt:0'],
            'amount' => ['required', 'integer'],
        ];
    }
}
