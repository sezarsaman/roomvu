<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Services\Transaction\TransactionService;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */

    public function __construct(
        public TransactionService $transactionService
    )
    {
    }

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        try {
            return response()->json(
                new TransactionResource(
                    $this->transactionService->storeTransaction(
                        [
                            'user_id' => (int) $request->get('user_id'),
                            'amount' => (int) $request->get('amount'),
                        ]
                    )
                ),
                201
            );
        } catch (\Exception $exception){
            return response()->json(
                [
                    "error" => $exception->getMessage()
                ],
                503
            );
        }
    }
}
