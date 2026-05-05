<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LUXIVO Admin Panel')</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Yajra DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <!-- jQuery 3.7 -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Custom Admin CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header">
                <h3 class="text-center mb-0">
                    <i class="fas fa-crown me-2" style="color: #f5a623;"></i>
                    <span style="color: #f5a623; font-weight: 700;">LUXIVO</span>
                    <br>
                    <small class="text-muted">Admin Panel</small>
                </h3>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-gauge me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        <i class="fas fa-box me-2"></i>
                        Products
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}">
                        <i class="fas fa-shopping-bag me-2"></i>
                        Orders
                    </a>
                </li>
<li class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
    <a href="{{ route('admin.orders.index') }}">
        <i class="fas fa-list me-2"></i>
        Order Items
    </a>
</li>
                <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users me-2"></i>
                        Users
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.admins.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.admins.index') }}">
                        <i class="fas fa-user-shield me-2"></i>
                        Admins
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.contacts.index') }}">
                        <i class="fas fa-envelope me-2"></i>
                        Contacts
                    </a>
                </li>
                <li class="mt-4">
                    <a href="{{ route('home') }}" class="text-warning">
                        <i class="fas fa-arrow-left me-2"></i>
                        Back to Site
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Bar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <!-- Hamburger Menu -->
                    <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Page Title -->
                    <div class="mx-auto">
                        <h4 class="mb-0 text-center">@yield('page-title', 'Dashboard')</h4>
                    </div>

                    <!-- Admin Info -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Yajra DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

    <!-- Custom Admin JavaScript -->
    <script>
        $(document).ready(function() {
            // Sidebar toggle
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            // Close sidebar on mobile when clicking outside
            $(document).on('click', function(e) {
                if ($(window).width() < 768) {
                    if (!$(e.target).closest('#sidebar, #sidebarCollapse').length) {
                        $('#sidebar').removeClass('active');
                        $('#content').removeClass('active');
                    }
                }
            });

            // Initialize DataTables if table exists
            if ($('.data-table').length) {
                $('.data-table').DataTable({
                    responsive: true,
                    pageLength: 25,
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        }
                    }
                });
            }

            // Auto-dismiss alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>

    @yield('scripts')
    @stack('scripts')
</body>
</html>