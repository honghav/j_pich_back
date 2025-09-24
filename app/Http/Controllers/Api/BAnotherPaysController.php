<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnotherPayRequest;
use App\Services\AnotherPaysServices;
use Illuminate\Http\JsonResponse;

class BAnotherPaysController extends Controller
{
    //
    protected $anotherPayService;

    public function __construct(AnotherPaysServices $anotherPayService)
    {
        $this->anotherPayService = $anotherPayService;
    }

    public function index(): JsonResponse
    {
        $anotherPays = $this->anotherPayService->getAll();
        return response()->json($anotherPays, 200);
    }

    public function store(AnotherPayRequest $request): JsonResponse
    {
        $anotherPay = $this->anotherPayService->create($request->validated());
        return response()->json($anotherPay, 201);
    }

    public function show($id): JsonResponse
    {
        $anotherPay = $this->anotherPayService->getById($id);
        return response()->json($anotherPay, 200);
    }

    public function update(AnotherPayRequest $request, $id): JsonResponse
    {
        $anotherPay = $this->anotherPayService->update($id, $request->validated());
        return response()->json($anotherPay, 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->anotherPayService->delete($id);
        return response()->json(null, 204);
    }
}
