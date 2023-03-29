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

    /**
     * Store a transaction
     *
     * @author Saman
     * @param StoreTransactionRequest $request
     * @return JsonResponse
     * @OA\Post(
     *      path="/add-money",
     *      operationId="TransactionStore",
     *      tags={"Transaction"},
     *      summary="Store a transaction",
     *      description="",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreTransactionRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful Creation",
     *          @OA\JsonContent(
     *              @OA\Property(property="reference_id", type="integer", example=123123123123)
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(
     *              @OA\Property(property="code", type="string", example="unprocessable_entity"),
     *              @OA\Property(property="message", type="string", example="Unprocessable Entity"),
     *              @OA\Property(property="errors", type="object", example={
     *                      "example":{"The example field is required."}
     *                  })
     *           )
     *      )
     * )
     *
     */
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
