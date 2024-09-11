<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\AddNewTransactionRequest;
use App\Models\Transactions;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AddNewTransactionController extends Controller
{
    public function __invoke(AddNewTransactionRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            Transactions::create($data);

            return new JsonResponse([
                'message' => 'Transaction added successfully.',
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
