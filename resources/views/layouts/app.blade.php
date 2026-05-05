<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts - Playfair Display + Raleway -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Raleway:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- LUXIVO Custom Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Bootstrap Dark Overrides — fixes white sidebar/cards everywhere -->
    <style>
        /* Base */
        main {
            background: #000000 !important;
        }

        body {
            background: #000000 !important;
        }

        /* Bootstrap white backgrounds */
        .bg-white {
            background: #111111 !important;
        }

        .bg-light {
            background: #111111 !important;
        }

        /* Cards & shadows */
        .card {
            background: #111111 !important;
            border-color: rgba(212, 175, 55, 0.2) !important;
        }

        .card-body {
            background: #111111 !important;
            color: #ffffff !important;
        }

        .shadow-sm {
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.06) !important;
        }

        .rounded-3 {
            border-radius: 4px !important;
        }

        /* Text */
        .text-dark {
            color: #ffffff !important;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.4) !important;
        }

        .text-primary {
            color: #D4AF37 !important;
        }

        .text-success {
            color: #4ade80 !important;
        }

        /* Buttons */
        .btn-primary {
            background: #D4AF37 !important;
            border-color: #D4AF37 !important;
            color: #000 !important;
        }

        .btn-primary:hover {
            background: #c9a96e !important;
            border-color: #c9a96e !important;
        }

        .btn-outline-primary {
            border-color: #D4AF37 !important;
            color: #D4AF37 !important;
            background: transparent !important;
        }

        .btn-outline-primary:hover {
            background: #D4AF37 !important;
            color: #000 !important;
        }

        .btn-outline-secondary {
            border-color: rgba(255, 255, 255, 0.2) !important;
            color: rgba(255, 255, 255, 0.4) !important;
            background: transparent !important;
        }

        .btn-outline-secondary:hover {
            border-color: rgba(255, 255, 255, 0.4) !important;
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .btn-warning {
            background: #D4AF37 !important;
            border-color: #D4AF37 !important;
            color: #000 !important;
        }

        .btn-warning:hover {
            background: transparent !important;
            color: #D4AF37 !important;
        }

        /* List groups (sidebar categories) */
        .list-group-item {
            background: #111111 !important;
            color: rgba(255, 255, 255, 0.55) !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
        }

        .list-group-item:hover {
            background: rgba(212, 175, 55, 0.08) !important;
            color: #D4AF37 !important;
        }

        .list-group-item.active {
            background: #D4AF37 !important;
            color: #000000 !important;
            border-color: #D4AF37 !important;
            font-weight: 600;
        }

        .list-group-item-action:focus {
            background: rgba(212, 175, 55, 0.08) !important;
        }

        /* Forms */
        .form-control {
            background: #1a1a1a !important;
            border-color: rgba(212, 175, 55, 0.2) !important;
            color: #ffffff !important;
        }

        .form-control:focus {
            background: #1a1a1a !important;
            border-color: #D4AF37 !important;
            box-shadow: 0 0 0 1px rgba(212, 175, 55, 0.3) !important;
            color: #ffffff !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3) !important;
        }

        .form-select {
            background-color: #1a1a1a !important;
            border-color: rgba(212, 175, 55, 0.2) !important;
            color: #ffffff !important;
        }

        .form-select:focus {
            border-color: #D4AF37 !important;
            box-shadow: 0 0 0 1px rgba(212, 175, 55, 0.3) !important;
        }

        /* Badges */
        .badge.bg-primary {
            background: rgba(212, 175, 55, 0.15) !important;
            color: #D4AF37 !important;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .badge.bg-success {
            background: rgba(74, 222, 128, 0.15) !important;
            color: #4ade80 !important;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .badge.bg-info {
            background: rgba(212, 175, 55, 0.1) !important;
            color: #D4AF37 !important;
        }

        .badge.bg-warning {
            background: #D4AF37 !important;
            color: #000 !important;
        }

        /* Alerts */
        .alert-success {
            background: rgba(74, 222, 128, 0.1) !important;
            border-color: rgba(74, 222, 128, 0.3) !important;
            color: #4ade80 !important;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1) !important;
            border-color: rgba(220, 53, 69, 0.3) !important;
            color: #ff6b7a !important;
        }

        /* Pagination */
        .page-link {
            background: #111111 !important;
            border-color: rgba(212, 175, 55, 0.2) !important;
            color: rgba(255, 255, 255, 0.5) !important;
            font-size: 0.85rem !important;
            padding: 8px 14px !important;
        }

        .page-link:hover {
            background: rgba(212, 175, 55, 0.1) !important;
            border-color: #D4AF37 !important;
            color: #D4AF37 !important;
        }

        .page-item.active .page-link {
            background: #D4AF37 !important;
            border-color: #D4AF37 !important;
            color: #000 !important;
        }

        .page-item.disabled .page-link {
            background: #0a0a0a !important;
            color: rgba(255, 255, 255, 0.2) !important;
        }

        /* Fix oversized SVG arrows in Laravel pagination */
        .page-link svg {
            width: 14px !important;
            height: 14px !important;
            vertical-align: middle !important;
        }

        nav[role="navigation"] {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav[role="navigation"] svg {
            width: 14px !important;
            height: 14px !important;
        }

        /* Tables */
        .table {
            color: #ffffff !important;
        }

        .table thead th {
            background: #1a1a1a !important;
            color: #D4AF37 !important;
            border-color: rgba(212, 175, 55, 0.15) !important;
        }

        .table td,
        .table th {
            border-color: rgba(255, 255, 255, 0.07) !important;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            background: rgba(255, 255, 255, 0.02) !important;
        }

        .table-hover tbody tr:hover {
            background: rgba(212, 175, 55, 0.05) !important;
        }

        /* Dropdown */
        .dropdown-menu {
            background: #1a1a1a !important;
            border-color: rgba(212, 175, 55, 0.2) !important;
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .dropdown-item:hover {
            background: rgba(212, 175, 55, 0.1) !important;
            color: #D4AF37 !important;
        }

        .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
    </style>

    <title>@yield('title', 'LUXIVO - Where Luxury Meets You')</title>

    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fa-solid fa-crown" style="color: var(--gold);"></i>
                LUXIVO
            </a>

            <button class="navbar-toggler border-gold" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu p-3"
                            style="min-width: 600px; background:#111111; border:1px solid rgba(212,175,55,0.2); border-radius:4px;">
                            @php $categories = \App\Models\Category::take(15)->get(); @endphp
                            <div class="row g-1">
                                @foreach($categories as $category)
                                    <div class="col-4">
                                        <a class="dropdown-item py-2 px-3 rounded-1"
                                            href="{{ route('category.show', $category->slug) }}"
                                            style="color:rgba(255,255,255,0.7); font-size:0.85rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; display:block;">
                                            <i class="fas fa-{{ $category->icon ?? 'tag' }} me-2"
                                                style="color:#D4AF37; width:16px;"></i>
                                            {{ Str::limit($category->name, 18) }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle fa-2x me-2"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('cart.index') }}"><i
                                                class="fas fa-shopping-cart me-2"></i>My Cart</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    @if(Auth::user()->is_admin)
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                                    class="fas fa-crown me-2"></i>Admin Panel</a></li>
                                    @endif
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item w-100 text-start border-0 bg-transparent">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                            </li>
                        </ul>
                        </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link me-3" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-gold px-4 py-2" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth

                <!-- Cart -->
                <li class="nav-item position-relative ms-3">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        @php $cartCount = session('cart.total_quantity', 0); @endphp
                        @if($cartCount > 0)
                            <span
                                class="cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-gold text-dark">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-5 mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show position-fixed"
                style="top: 100px; right: 20px; z-index: 9999; min-width: 300px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show position-fixed"
                style="top: 100px; right: 20px; z-index: 9999; min-width: 300px;">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5 pt-5">
        <div class="container">
            <div class="row">
                <!-- About LUXIVO -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-logo mb-3">
                        <i class="fa-solid fa-crown" style="color: var(--gold);"></i>
                        LUXIVO
                    </h5>
                    <p class="text-grey mb-3">Where Luxury Meets You. Premium products, exceptional service, worldwide
                        delivery.</p>
                    <div class="social-icons">
                        <a href="#" class="footer-social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="text-gold mb-3">Quick Links</h6>
                    <a href="{{ route('home') }}" class="footer-link">Home</a>
                    <a href="{{ route('products.index') }}" class="footer-link">Shop</a>
                    <a href="{{ route('cart.index') }}" class="footer-link">Cart</a>
                    <a href="{{ route('contact.index') }}" class="footer-link">Contact</a>
                    <a href="#" class="footer-link">Track Order</a>
                </div>

                <!-- Categories -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="text-gold mb-3">Categories</h6>
                    <a href="#" class="footer-link">Electronics</a>
                    <a href="#" class="footer-link">Fashion</a>
                    <a href="#" class="footer-link">Watches</a>
                    <a href="#" class="footer-link">Home & Living</a>
                    <a href="#" class="footer-link">Beauty</a>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="text-gold mb-3">Contact Info</h6>
                    <p class="footer-link mb-2"><i class="fas fa-phone me-2"></i>+92 300 1234567</p>
                    <p class="footer-link mb-2"><i class="fas fa-envelope me-2"></i>hello@luxivo.com</p>
                    <p class="footer-link mb-3"><i class="fas fa-map-marker-alt me-2"></i>Karachi, Pakistan</p>
                    <div class="payment-methods">
                        <small>Secure Payments:</small><br>
                        <i class="fab fa-cc-visa text-gold me-1"></i>
                        <i class="fab fa-cc-mastercard text-gold me-1"></i>
                        <i class="fab fa-cc-paypal text-gold"></i>
                    </div>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="text-center py-4">
                <p class="mb-0 text-grey">&copy; 2024 LUXIVO. All Rights Reserved. Where Luxury Meets You.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>