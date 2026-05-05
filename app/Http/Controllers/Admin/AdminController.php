<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of admins.
     */
    public function index()
    {
        return view('admin.admins.index');
    }

    /**
     * Get admins data for DataTables.
     */
    public function getData()
    {
        $admins = User::where('role', 'admin')->select('users.*');

        return DataTables::of($admins)
            ->addColumn('last_login', function ($admin) {
                return $admin->last_login ? $admin->last_login->format('M d, Y H:i') : 'Never';
            })
            ->addColumn('status', function ($admin) {
                $status = $admin->is_active ? 'Active' : 'Inactive';
                $color = $admin->is_active ? 'success' : 'danger';
                return '<span class="badge bg-' . $color . '">' . $status . '</span>';
            })
            ->addColumn('actions', function ($admin) {
                return '
                    <a href="#" class="btn btn-sm btn-outline-info me-1" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-warning me-1" title="Edit Admin">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger" title="Delete Admin" onclick="confirmDelete(' . $admin->id . ')">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}