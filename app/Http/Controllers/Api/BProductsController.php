<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductsRequest;
use App\Http\Controllers\Controller;
use App\Services\ProductsServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BProductsController extends Controller
{
    protected $productsService;

    public function __construct(ProductsServices $productsService)
    {
        $this->productsService = $productsService;
    }

    public function index(): JsonResponse
    {
        $products = $this->productsService->all();
        return response()->json($products, 200);
    }
    public function allByStatus(): JsonResponse
    {
        $products = $this->productsService->allByStatus();
        return response()->json($products, 200);
    }

    public function store(ProductsRequest $request): JsonResponse
    {
        $product = $this->productsService->create($request->validated());
        return response()->json($product, 201);
    }

    public function show($id): JsonResponse
    {
        $product = $this->productsService->find($id);
        return response()->json($product, 200);
    }

    public function update(ProductsRequest $request, $id): JsonResponse
    {
        $product = $this->productsService->update($id, $request->validated());
        return response()->json($product, 200);
    }

    public function destroy($id): JsonResponse
    {
        $this->productsService->delete($id);
        return response()->json(null, 204);
    }
}
