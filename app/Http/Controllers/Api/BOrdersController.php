<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderRequest;
use App\Services\OrdersServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BOrdersController extends Controller
{
    protected  $orderService;

    public function __construct(OrdersServices $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the orders.
     */
    public function index(): JsonResponse
    {
        $orders = $this->orderService->getAll();
        return response()->json($orders);
    }
    public function countDiscount(): JsonResponse
    {
        
        $countDiscount = $this->orderService->countDiscount();
        return response()->json($countDiscount);
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $order = $this->orderService->create($request->validated());
        return response()->json($order, 201);
    }

    /**
     * Display the specified order.
     */
    public function show(int $id): JsonResponse
    {
        $order = $this->orderService->getById($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    /**
     * Update the specified order in storage.
     */
    public function update(OrderRequest $request, int $id): JsonResponse
    {
    
        $updated = $this->orderService->update($id, $request->validated());

        if (!$updated) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->orderService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json(['message' => 'Order deleted successfully']);
    }
}