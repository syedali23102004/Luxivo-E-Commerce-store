<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Get users data for DataTables.
     */
    public function getData()
    {
        $users = User::where('role', 'user')->select('users.*');

        return DataTables::of($users)
            ->addColumn('total_orders', function ($user) {
                return Order::where('user_id', $user->id)->count();
            })
            ->addColumn('total_spent', function ($user) {
                return 'Rs. ' . number_format(Order::where('user_id', $user->id)->sum('total_amount'), 0, '.', ',');
            })
            ->addColumn('actions', function ($user) {
                return '
                    <a href="#" class="btn btn-sm btn-outline-info me-1" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-warning" title="Edit User">
                        <i class="fas fa-edit"></i>
                    </a>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}