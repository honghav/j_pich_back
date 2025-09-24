<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnotherPays;
use App\Models\Categories;
use App\Models\Orders;
use App\Models\Products;
use Carbon\Carbon;

class BDashbordController extends Controller
{
   public function getOrderCount()
    {
        // Current and last month ranges
        $now = Carbon::now();
        $startOfThisMonth = $now->copy()->startOfMonth();
        $endOfThisMonth   = $now->copy()->endOfMonth();
        
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth   = $now->copy()->subMonth()->endOfMonth();

        // Count orders
        $thisMonthCount = Orders::whereBetween('created_at', [$startOfThisMonth, $endOfThisMonth])->count();
        $lastMonthCount = Orders::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // Calculate difference (+/-)
        $difference = $thisMonthCount - $lastMonthCount;

        return response()->json([
            'this_month_count' => $thisMonthCount,
            'last_month_count' => $lastMonthCount,
            'difference' => $difference,
            'percentage_change' => $lastMonthCount > 0 
                ? round((($thisMonthCount - $lastMonthCount) / $lastMonthCount) * 100, 2)
                : 100, // if last month was 0, treat as 100% growth
        ]);
    }
   public function getAnotherOrderCount()
    {
        // Current and last month ranges
        $now = Carbon::now();
        $startOfThisMonth = $now->copy()->startOfMonth();
        $endOfThisMonth   = $now->copy()->endOfMonth();
        
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth   = $now->copy()->subMonth()->endOfMonth();

        // Count orders
        $thisMonthCount = AnotherPays::whereBetween('created_at', [$startOfThisMonth, $endOfThisMonth])->count();
        $lastMonthCount = AnotherPays::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // Calculate difference (+/-)
        $difference = $thisMonthCount - $lastMonthCount;

        return response()->json([
            'this_month_count' => $thisMonthCount,
            'last_month_count' => $lastMonthCount,
            'difference' => $difference,
            'percentage_change' => $lastMonthCount > 0 
                ? round((($thisMonthCount - $lastMonthCount) / $lastMonthCount) * 100, 2)
                : 100, // if last month was 0, treat as 100% growth
        ]);
    }
    public function getAnotherOrderSum()
    {
        // Current and last month ranges
        $now = Carbon::now();
        $startOfThisMonth = $now->copy()->startOfMonth();
        $endOfThisMonth   = $now->copy()->endOfMonth();
        
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth   = $now->copy()->subMonth()->endOfMonth();

        // Count orders
        $thisMonthCount = AnotherPays::whereBetween('created_at', [$startOfThisMonth, $endOfThisMonth])->sum('price');
        $lastMonthCount = AnotherPays::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->sum('price');

        // Calculate difference (+/-)
        $difference = $thisMonthCount - $lastMonthCount;

        return response()->json([
            'this_month_total' => $thisMonthCount,
            'last_month_total' => $lastMonthCount,
            'difference' => $difference,
            'percentage' => $lastMonthCount > 0 
                ? round((($thisMonthCount - $lastMonthCount) / $lastMonthCount) * 100, 2)
                : 100, // if last month was 0, treat as 100% growth
        ]);
    }
    public function getOrderSum()
    {
        $now = Carbon::now();

        $startOfThisMonth = $now->copy()->startOfMonth();
        $endOfThisMonth   = $now->copy()->endOfMonth();

        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth   = $now->copy()->subMonth()->endOfMonth();

        // This month
        $thisMonthSum = Orders::join('products', 'orders.product_id', '=', 'products.id')
            ->whereBetween('orders.created_at', [$startOfThisMonth, $endOfThisMonth])
            ->selectRaw('SUM(CAST(products.price AS DECIMAL(10,2)) - orders.discount) as total')
            ->value('total') ?? 0;

        // Last month
        $lastMonthSum = Orders::join('products', 'orders.product_id', '=', 'products.id')
            ->whereBetween('orders.created_at', [$startOfLastMonth, $endOfLastMonth])
            ->selectRaw('SUM(CAST(products.price AS DECIMAL(10,2)) - orders.discount) as total')
            ->value('total') ?? 0;

        return response()->json([
            'this_month_total' => (float) $thisMonthSum,
            'last_month_total' => (float) $lastMonthSum,
            'difference' => (float) $thisMonthSum - (float) $lastMonthSum,
            'percentage' => $lastMonthSum > 0
                ? round((($thisMonthSum - $lastMonthSum) / $lastMonthSum) * 100, 2)
                : 100,
        ]);

    }

    public function getProductCount()
    {
        $allProduct = Products::count();
        $activeCount = Products::where('status', 'active')->count();
        $unActiveCount = Products::where('status', 'unactive')->count();
        $allCategory = Categories::count();

        return response()->json([
            'allProduct' => $allProduct,
            'productActive' => $activeCount,
            'productUnactive' => $unActiveCount,
            'allCategory' => $allCategory
        ]);
    }
}
