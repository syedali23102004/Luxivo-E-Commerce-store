<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Success - LUXIVO</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <style>
        .success-hero {
            background: linear-gradient(135deg, #0a0f2c 0%, #4a0e6e 100%);
            min-height: 60vh;
            color: white;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .success-icon {
            font-size: 5rem;
            color: #f5a623;
            margin-bottom: 1.5rem;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-20px); }
            60% { transform: translateY(-10px); }
        }
        .glass-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .btn-home {
            background: linear-gradient(135deg, #f5a623, #e6951a);
            border: none;
            color: #0a0f2c;
            font-weight: 600;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(245,166,35,0.3);
        }
        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(245,166,35,0.4);
            color: #0a0f2c;
        }
    </style>
</head>
<body>
    <!-- Success Hero Section -->
    <section class="success-hero">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="glass-card p-5">
                        <i class="fas fa-check-circle success-icon"></i>
                        <h1 class="display-4 fw-bold mb-4">Order Confirmed!</h1>
                        <p class="lead mb-5">Thank you for your purchase. Your order has been successfully placed and is being processed.</p>
                        
                        @if(session('order'))
                            <div class="alert alert-success glass-card mb-4">
                                <h5><i class="fas fa-hashtag me-2"></i>Order #{{ session('order')->id }}</h5>
                                <p><strong>Total:</strong> ${{ number_format(session('order')->total, 2) }}</p>
                                <p><strong>Date:</strong> {{ session('order')->created_at->format('M d, Y h:i A') }}</p>
                                <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success">Processing</span></p>
                            </div>
                        @endif
                        
                        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                            <a href="{{ route('home') }}" class="btn btn-home btn-lg">
                                <i class="fas fa-home me-2"></i>Continue Shopping
                            </a>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-shopping-cart me-2"></i>View Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Next Steps Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 mx-auto">
                    <h2 class="mb-5">What Happens Next?</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="text-center p-4 h-100">
                                <i class="fas fa-shipping-fast text-gold mb-3" style="font-size: 3rem;"></i>
                                <h5>Processing</h5>
                                <p class="text-muted">Your order is being prepared by our team.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 h-100">
                                <i class="fas fa-truck text-gold mb-3" style="font-size: 3rem;"></i>
                                <h5>Shipped</h5>
                                <p class="text-muted">We'll notify you when your order ships.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 h-100">
                                <i class="fas fa-box-open text-gold mb-3" style="font-size: 3rem;"></i>
                                <h5>Delivered</h5>
                                <p class="text-muted">Track your package and enjoy!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Track Order CTA -->
    <section class="py-5 bg-navy text-white">
        <div class="container text-center">
            <h3 class="mb-4">Track Your Order</h3>
            <p class="lead mb-4">Enter your order number or email to track your package status.</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Order # or Email">
                        <button class="btn btn-gold"><i class="fas fa-search me-2"></i>Track</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <script>
        // Auto-hide success message after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert-success').forEach(el => {
                el.style.opacity = '0';
                el.style.transition = 'opacity 0.5s';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
