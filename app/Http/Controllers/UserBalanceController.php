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
