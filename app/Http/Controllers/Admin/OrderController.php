<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        return view('admin.orders.index');
    }

    /**
     * Get orders data for DataTables.
     */
    public function getData()
    {
        $orders = Order::with('user')->select('orders.*');

        return DataTables::of($orders)
            ->addColumn('customer_name', function ($order) {
                return $order->user->name ?? 'N/A';
            })
            ->addColumn('customer_email', function ($order) {
                return $order->user->email ?? 'N/A';
            })
            ->addColumn('total_formatted', function ($order) {
                return 'Rs. ' . number_format($order->total_amount, 0, '.', ',');
            })
            ->addColumn('status_badge', function ($order) {
                $statusColors = [
                    'pending' => 'warning',
                    'processing' => 'primary',
                    'shipped' => 'info',
                    'delivered' => 'success',
                    'cancelled' => 'danger'
                ];
                $color = $statusColors[$order->status] ?? 'secondary';

                return '<span class="badge bg-' . $color . ' status-badge" data-order-id="' . $order->id . '">' . ucfirst($order->status) . '</span>';
            })
            ->addColumn('status_dropdown', function ($order) {
                $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                $dropdown = '<select class="form-select form-select-sm status-dropdown" data-order-id="' . $order->id . '">';

                foreach ($statuses as $status) {
                    $selected = $order->status === $status ? 'selected' : '';
                    $dropdown .= '<option value="' . $status . '" ' . $selected . '>' . ucfirst($status) . '</option>';
                }

                $dropdown .= '</select>';
                return $dropdown;
            })
            ->addColumn('actions', function ($order) {
                return '
                    <a href="#" class="btn btn-sm btn-outline-info me-1" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-primary" title="Print Invoice">
                        <i class="fas fa-print"></i>
                    </a>
                ';
            })
            ->rawColumns(['status_badge', 'status_dropdown', 'actions'])
            ->make(true);
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully!',
            'status' => $request->status
        ]);
    }
}