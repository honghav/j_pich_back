<?php

namespace App\Repositories;

use App\Models\Orders;
use App\Repositories\Interface\OrdersRepositoriesInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrdersRepositories implements OrdersRepositoriesInterface
{
    public function countDiscount()
    {
        $thisMonth = Carbon::now()->format('Y-m');

        $totalDiscount = Orders::whereRaw("TO_CHAR(created_at, 'YYYY-MM') = ?", [$thisMonth])
            ->select(DB::raw("TO_CHAR(created_at, 'YYYY-MM') as month"), DB::raw("SUM(discount) as total_discount"))
            ->groupBy('month')
            ->first();
        return $totalDiscount;
    }
    public function all()
    {
        return Orders::join('products', 'orders.product_id', '=', 'products.id')
        ->select('products.name','products.price','orders.*')->orderBy('created_at', 'desc')
        ->get();
    }

    public function find(int $id)
    {
        return Orders::with('product')->find($id);
    }

    public function create(array $data)
    {
        return Orders::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $order = Orders::findOrFail($id);
        return $order->update($data);
    }

    public function delete(int $id): bool
    {
        $order = Orders::findOrFail($id);
        return $order->delete();
    }
}
