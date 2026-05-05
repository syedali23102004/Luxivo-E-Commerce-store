@extends('layouts.app')

@section('title', 'Shopping Cart - LUXIVO')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5 fw-bold text-primary">
                <i class="fas fa-shopping-cart me-3"></i>Shopping Cart
            </h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(empty($cart))
                <!-- Empty Cart -->
                <div class="text-center py-5">
                    <div class="empty-cart-icon mb-4">
                        <i class="fas fa-shopping-cart fa-5x text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">Your cart is empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg px-4 py-3">
                        <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                    </a>
                </div>
            @else
                <!-- Cart Items -->
                <div class="row">
                    <!-- Cart Items List -->
                    <div class="col-lg-8 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0 fw-bold text-primary">
                                    <i class="fas fa-list me-2"></i>Cart Items ({{ count($cart) }})
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                @foreach($cart as $productId => $item)
                                <div class="cart-item border-bottom p-4">
                                    <div class="row align-items-center">
                                        <!-- Product Image -->
                                        <div class="col-md-2 col-sm-3 mb-3 mb-md-0">
                                            <img src="{{ $item['image'] }}"
                                                 class="img-fluid rounded"
                                                 alt="{{ $item['name'] }}"
                                                 style="max-height: 80px; object-fit: cover;"
                                                 onerror="this.src='{{ asset('images/no-image.svg') }}'">
                                        </div>

                                        <!-- Product Details -->
                                        <div class="col-md-4 col-sm-9 mb-3 mb-md-0">
                                            <h6 class="mb-1">
                                                <a href="{{ route('products.show', \App\Models\Product::find($productId)->slug ?? '#') }}"
                                                   class="text-decoration-none text-dark fw-bold">
                                                    {{ $item['name'] }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">Product ID: {{ $productId }}</small>
                                        </div>

                                        <!-- Price -->
                                        <div class="col-md-2 mb-3 mb-md-0">
                                            <span class="fw-bold text-primary fs-5">
                                                Rs. {{ number_format($item['price']) }}
                                            </span>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="col-md-2 mb-3 mb-md-0">
                                            <div class="quantity-controls d-flex align-items-center">
                                                <button class="btn btn-outline-secondary btn-sm quantity-btn"
                                                        onclick="updateQuantity({{ $productId }}, {{ $item['quantity'] - 1 }})">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" class="form-control form-control-sm text-center mx-2 quantity-input"
                                                       value="{{ $item['quantity'] }}" min="1" max="99"
                                                       onchange="updateQuantity({{ $productId }}, this.value)"
                                                       style="width: 60px;">
                                                <button class="btn btn-outline-secondary btn-sm quantity-btn"
                                                        onclick="updateQuantity({{ $productId }}, {{ $item['quantity'] + 1 }})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Subtotal & Remove -->
                                        <div class="col-md-2 text-end">
                                            <div class="mb-2">
                                                <strong class="text-primary">
                                                    Rs. {{ number_format($item['price'] * $item['quantity']) }}
                                                </strong>
                                            </div>
                                            <form method="POST" action="{{ route('cart.remove') }}" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Remove this item from cart?')">
                                                    <i class="fas fa-trash me-1"></i>Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Continue Shopping -->
                        <div class="mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-receipt me-2"></i>Order Summary
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Subtotal -->
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Subtotal ({{ count($cart) }} items)</span>
                                    <strong>Rs. {{ number_format($total) }}</strong>
                                </div>

                                <!-- Shipping -->
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Shipping</span>
                                    <span class="text-success">Free</span>
                                </div>

                                <!-- Tax -->
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Tax (GST 17%)</span>
                                    <strong>Rs. {{ number_format($total * 0.17) }}</strong>
                                </div>

                                <hr>

                                <!-- Total -->
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="fs-5 fw-bold">Total</span>
                                    <span class="fs-5 fw-bold text-primary">
                                        Rs. {{ number_format($total * 1.17) }}
                                    </span>
                                </div>

                                <!-- Checkout Button -->
                                <div class="d-grid">
                                    <a href="{{ route('checkout.index') }}" class="btn btn-warning btn-lg py-3 fw-bold">
                                        <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                                    </a>
                                </div>

                                <!-- Payment Methods -->
                                <div class="mt-4 text-center">
                                    <small class="text-muted">We Accept</small>
                                    <div class="mt-2">
                                        <i class="fab fa-cc-visa fa-2x me-2 text-primary"></i>
                                        <i class="fab fa-cc-mastercard fa-2x me-2 text-danger"></i>
                                        <i class="fab fa-cc-paypal fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Clear Cart -->
                        <div class="mt-3">
                            <form method="POST" action="{{ route('cart.clear') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100"
                                        onclick="return confirm('Clear entire cart?')">
                                    <i class="fas fa-trash me-2"></i>Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function updateQuantity(productId, newQuantity) {
    if (newQuantity < 1) {
        if (confirm('Remove this item from cart?')) {
            removeItem(productId);
        }
        return;
    }

    // Send AJAX request to update quantity
    fetch('{{ route("cart.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Reload to update totals
        }
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload(); // Fallback to page reload
    });
}

function removeItem(productId) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("cart.remove") }}';

    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';

    const productIdInput = document.createElement('input');
    productIdInput.type = 'hidden';
    productIdInput.name = 'product_id';
    productIdInput.value = productId;

    form.appendChild(csrfToken);
    form.appendChild(productIdInput);
    document.body.appendChild(form);
    form.submit();
}

// Update cart count in navbar
function updateCartCount() {
    fetch('{{ route("cart.count") }}')
    .then(response => response.json())
    .then(data => {
        const cartBadge = document.querySelector('.cart-count');
        if (cartBadge) {
            cartBadge.textContent = data.count;
            cartBadge.style.display = data.count > 0 ? 'inline' : 'none';
        }
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
</script>

<style>
.cart-item:hover {
    background-color: #f8f9fa;
}

.quantity-controls {
    max-width: 140px;
}

.quantity-btn {
    width: 30px;
    height: 30px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-input {
    text-align: center;
    border-radius: 0;
}

.empty-cart-icon {
    opacity: 0.5;
}

.card {
    border-radius: 0.5rem;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}
</style>
@endsection