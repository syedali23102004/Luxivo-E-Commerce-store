<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Count total products
        $totalProducts = Product::count();

        // Count total orders
        $totalOrders = Order::count();

        // Count total users (role = 'user')
        $totalUsers = User::where('role', 'user')->count();

        // Sum total revenue (from orders)
        $totalRevenue = Order::sum('total_amount');

        // Get recent 5 orders with user relationship
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get top 5 selling products (from order_items)
        $topSellingProducts = OrderItem::select('products.name', 'products.image', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->groupBy('order_items.product_id', 'products.name', 'products.image')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'recentOrders',
            'topSellingProducts'
        ));
    }
}