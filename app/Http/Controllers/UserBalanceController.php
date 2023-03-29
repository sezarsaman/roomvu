<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersBalanceResource;
use App\Services\UserBalance\UsersBalanceService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class UserBalanceController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */
    public function __construct(
        public UsersBalanceService $usersBalanceService
    )
    {
    }

    /**
     * Show an item of resource
     *
     * @param int $userId
     * @return JsonResponse
     *
     * @OA\Get(
     *      path="/get-balance/{userId}",
     *      summary="Show balance of user",
     *      description="",
     *      operationId="UserBalanceShow",
     *      tags={"UserBalance"},
     *      @OA\Parameter(
     *          name="userId",
     *          description="ID of user",
     *          required=true,
     *          in="path",
     *          example=1,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="OK"),
     *              @OA\Property(property="data",  ref="#/components/schemas/CompanyResource")
     *          )
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="code", type="string", example="not_found"),
     *              @OA\Property(property="message", type="string", example="Not Found"),
     *              @OA\Property(property="errors", type="object", example={})
     *          )
     *      )
     * )
     */
    public function show(int $userId): JsonResponse
    {

        try {
            return response()->json(
                new UsersBalanceResource($this->usersBalanceService->getBalanceByUserId($userId)),
                200
            );
        } catch (NotFoundHttpException $exception) {
            return response()->json(
                [
                    'error' => $exception->getMessage()
                ],
                404
            );
        }


    }

}
