@extends('layouts.admin')

@section('title', 'Admin Dashboard - LUXIVO')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </h1>
            <p class="text-muted mb-0">Welcome back! Here's what's happening with your store.</p>
        </div>
        <div>
            <small class="text-muted">{{ now()->format('l, F j, Y') }}</small>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row g-4 mb-5">
        <!-- Total Products -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card products-card">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon">
                        <i class="fas fa-box fa-2x text-white"></i>
                    </div>
                    <div class="stat-content ms-3">
                        <h3 class="stat-number mb-1">{{ number_format($totalProducts) }}</h3>
                        <p class="stat-label mb-0 text-white-50">Total Products</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <small class="text-white-50">
                        <i class="fas fa-arrow-up me-1"></i>Active inventory
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card orders-card">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag fa-2x text-white"></i>
                    </div>
                    <div class="stat-content ms-3">
                        <h3 class="stat-number mb-1">{{ number_format($totalOrders) }}</h3>
                        <p class="stat-label mb-0 text-white-50">Total Orders</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <small class="text-white-50">
                        <i class="fas fa-clock me-1"></i>All time orders
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card users-card">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon">
                        <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                    <div class="stat-content ms-3">
                        <h3 class="stat-number mb-1">{{ number_format($totalUsers) }}</h3>
                        <p class="stat-label mb-0 text-white-50">Total Users</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <small class="text-white-50">
                        <i class="fas fa-user-plus me-1"></i>Registered customers
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card revenue-card">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon">
                        <i class="fas fa-money-bill fa-2x text-white"></i>
                    </div>
                    <div class="stat-content ms-3">
                        <h3 class="stat-number mb-1">Rs. {{ number_format($totalRevenue, 0, '.', ',') }}</h3>
                        <p class="stat-label mb-0 text-white-50">Total Revenue</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <small class="text-white-50">
                        <i class="fas fa-chart-line me-1"></i>All time earnings
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Top Products Row -->
    <div class="row g-4">
        <!-- Recent Orders -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-clock me-2"></i>Recent Orders
                        </h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>View All
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 fw-bold text-muted">Order ID</th>
                                    <th class="border-0 fw-bold text-muted">Customer</th>
                                    <th class="border-0 fw-bold text-muted">Total</th>
                                    <th class="border-0 fw-bold text-muted">Status</th>
                                    <th class="border-0 fw-bold text-muted">Payment</th>
                                    <th class="border-0 fw-bold text-muted">Date</th>
                                    <th class="border-0 fw-bold text-muted">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td class="fw-bold text-primary">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                                {{ substr($order->user->name, 0, 1) }}
                                            </div>
                                            <span>{{ $order->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="fw-bold">Rs. {{ number_format($order->total_amount, 0, '.', ',') }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'processing' => 'primary',
                                                'shipped' => 'info',
                                                'delivered' => 'success',
                                                'cancelled' => 'danger'
                                            ];
                                            $statusColor = $statusColors[$order->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }} text-white">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-credit-card me-1"></i>{{ ucfirst($order->payment_method ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td class="text-muted">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No orders yet</h5>
                        <p class="text-muted">Orders will appear here once customers start purchasing.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Top Selling Products -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-trophy me-2"></i>Top Products
                        </h5>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>View All
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($topSellingProducts->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($topSellingProducts as $index => $product)
                        <div class="list-group-item border-0 px-3 py-3">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <img src="{{ $product->image }}"
                                         class="rounded"
                                         alt="{{ $product->name }}"
                                         style="width: 50px; height: 50px; object-fit: cover;"
                                         onerror="this.src='{{ asset('images/no-image.svg') }}'">
                                    <span class="position-absolute top-0 start-0 badge bg-warning text-dark rounded-circle"
                                          style="width: 20px; height: 20px; font-size: 0.7rem; display: flex; align-items: center; justify-content: center;">
                                        {{ $index + 1 }}
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold text-truncate" style="max-width: 150px;">
                                        {{ $product->name }}
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-shopping-cart me-1"></i>{{ $product->total_sold }} sold
                                        </small>
                                        <small class="text-success fw-bold">
                                            Rs. {{ number_format($product->total_sold * 1000, 0, '.', ',') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No sales data yet</h5>
                        <p class="text-muted">Top products will appear here once orders are placed.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Glassmorphism Stat Cards */
.stat-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    color: white;
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    z-index: -1;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

/* Card Color Themes */
.products-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.orders-card {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.users-card {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.revenue-card {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

/* Stat Card Content */
.stat-icon {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: white;
}

.stat-label {
    font-size: 0.9rem;
    margin: 0;
}

/* Avatar Styles */
.avatar-sm {
    width: 35px;
    height: 35px;
    font-size: 0.9rem;
    font-weight: 600;
}

/* Table Styles */
.table th {
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table td {
    vertical-align: middle;
}

/* Badge Styles */
.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

/* Card Animations */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .stat-card .card-body {
        padding: 1rem;
    }

    .stat-number {
        font-size: 1.5rem;
    }

    .stat-icon {
        padding: 10px;
    }

    .stat-icon i {
        font-size: 1.5rem !important;
    }
}
</style>

<script>
// Add some interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Animate stat cards on load
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Add hover effects for table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });

        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
});
</script>
@endsection