@extends('layouts.app')

@section('title', 'Checkout - LUXIVO')

@section('content')

<style>
/* ── Page ── */
.checkout-page {
    background: #000000;
    min-height: 100vh;
    padding: 50px 0 80px;
}

/* ── Page Heading ── */
.checkout-heading {
    color: #D4AF37;
    font-size: 1.6rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 6px;
}

.checkout-subheading {
    color: rgba(255,255,255,0.35);
    font-size: 0.82rem;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 40px;
}

/* ── Cards ── */
.checkout-card {
    background: #111111;
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 6px;
    padding: 32px;
    margin-bottom: 24px;
}

.checkout-card .card-section-title {
    color: #D4AF37;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    margin-bottom: 24px;
    padding-bottom: 14px;
    border-bottom: 1px solid rgba(212, 175, 55, 0.12);
}

/* ── Form Fields ── */
.form-label-lux {
    color: rgba(255,255,255,0.5);
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 6px;
    display: block;
}

.form-control-lux {
    background: #1a1a1a !important;
    border: 1px solid rgba(212, 175, 55, 0.2) !important;
    border-radius: 3px;
    color: #ffffff !important;
    font-size: 0.9rem;
    padding: 12px 14px;
    width: 100%;
    transition: border-color 0.25s ease;
}

.form-control-lux:focus {
    outline: none;
    border-color: #D4AF37 !important;
    box-shadow: 0 0 0 1px rgba(212,175,55,0.2) !important;
}

.form-control-lux::placeholder {
    color: rgba(255,255,255,0.25) !important;
}

.form-control-lux.is-invalid {
    border-color: rgba(220, 53, 69, 0.6) !important;
}

/* ── Payment Method ── */
.payment-option {
    background: #1a1a1a;
    border: 1px solid rgba(212, 175, 55, 0.15);
    border-radius: 4px;
    padding: 16px 20px;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.payment-option:hover {
    border-color: rgba(212, 175, 55, 0.4);
    background: rgba(212, 175, 55, 0.04);
}

.payment-option input[type="radio"] {
    accent-color: #D4AF37;
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

.payment-option input[type="radio"]:checked + .payment-label-wrap {
    color: #D4AF37;
}

.payment-option:has(input:checked) {
    border-color: #D4AF37;
    background: rgba(212, 175, 55, 0.06);
}

.payment-icon {
    color: #D4AF37;
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
}

.payment-label-wrap .payment-title {
    color: rgba(255,255,255,0.9);
    font-size: 0.88rem;
    font-weight: 600;
    display: block;
}

.payment-label-wrap .payment-desc {
    color: rgba(255,255,255,0.35);
    font-size: 0.75rem;
    display: block;
    margin-top: 2px;
}

/* ── Order Summary ── */
.summary-card {
    background: #111111;
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 6px;
    padding: 28px;
    position: sticky;
    top: 100px;
}

.summary-title {
    color: #D4AF37;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    margin-bottom: 20px;
    padding-bottom: 14px;
    border-bottom: 1px solid rgba(212, 175, 55, 0.12);
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    gap: 10px;
}

.summary-item:last-of-type {
    border-bottom: none;
}

.summary-item-name {
    color: rgba(255,255,255,0.7);
    font-size: 0.85rem;
    line-height: 1.4;
    flex: 1;
}

.summary-item-qty {
    color: rgba(255,255,255,0.3);
    font-size: 0.75rem;
    display: block;
    margin-top: 2px;
}

.summary-item-price {
    color: #D4AF37;
    font-size: 0.88rem;
    font-weight: 600;
    white-space: nowrap;
}

.summary-divider {
    border: none;
    border-top: 1px solid rgba(212, 175, 55, 0.15);
    margin: 16px 0;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.summary-row .label {
    color: rgba(255,255,255,0.4);
    font-size: 0.82rem;
    letter-spacing: 0.5px;
}

.summary-row .value {
    color: rgba(255,255,255,0.7);
    font-size: 0.88rem;
    font-weight: 500;
}

.summary-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0 0;
    border-top: 1px solid rgba(212, 175, 55, 0.2);
    margin-top: 8px;
}

.summary-total-label {
    color: #ffffff;
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.summary-total-value {
    color: #D4AF37;
    font-size: 1.3rem;
    font-weight: 700;
}

/* ── Place Order Button ── */
.btn-place-order {
    background: #D4AF37;
    border: 2px solid #D4AF37;
    border-radius: 50px;
    color: #000000;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    width: 100%;
    padding: 14px;
    margin-top: 20px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-place-order:hover {
    background: transparent;
    color: #D4AF37;
}

.btn-place-order:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ── Back to Cart ── */
.btn-back-cart {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.35);
    font-size: 0.78rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    margin-bottom: 32px;
    transition: color 0.25s ease;
}

.btn-back-cart:hover {
    color: #D4AF37;
}

/* ── Empty Cart State ── */
.empty-checkout {
    text-align: center;
    padding: 80px 20px;
}

/* ── Security Badge ── */
.security-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: rgba(255,255,255,0.25);
    font-size: 0.73rem;
    letter-spacing: 0.5px;
    margin-top: 14px;
}
</style>

<div class="checkout-page">
<div class="container">

    <!-- Back Link -->
    <a href="{{ route('cart.index') }}" class="btn-back-cart">
        <i class="fas fa-arrow-left"></i> Back to Cart
    </a>

    <!-- Heading -->
    <div class="checkout-heading">
        <i class="fas fa-lock me-2" style="font-size:1.2rem;"></i>Secure Checkout
    </div>
    <div class="checkout-subheading">Complete your order below</div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger mb-4" style="background:rgba(220,53,69,0.1); border:1px solid rgba(220,53,69,0.3); color:#ff6b7a; border-radius:4px;">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach($errors->all() as $error)
                    <li style="font-size:0.85rem;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4" style="background:rgba(220,53,69,0.1); border:1px solid rgba(220,53,69,0.3); color:#ff6b7a; border-radius:4px;">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif

    @if(!empty($cart))
    <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm">
        @csrf
        <div class="row g-4">

            <!-- ══ LEFT: Billing Form ══ -->
            <div class="col-lg-7">

                <!-- Billing Info -->
                <div class="checkout-card">
                    <div class="card-section-title">
                        <i class="fas fa-user me-2"></i>Billing Information
                    </div>

                    <div class="row g-3">
                        <!-- Full Name -->
                        <div class="col-12">
                            <label class="form-label-lux">Full Name *</label>
                            <input type="text"
                                   name="name"
                                   class="form-control-lux {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   placeholder="Enter your full name"
                                   value="{{ old('name', Auth::user()->name ?? '') }}"
                                   required>
                            @error('name')
                                <div style="color:#ff6b7a; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label-lux">Email Address *</label>
                            <input type="email"
                                   name="email"
                                   class="form-control-lux {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   placeholder="your@email.com"
                                   value="{{ old('email', Auth::user()->email ?? '') }}"
                                   required>
                            @error('email')
                                <div style="color:#ff6b7a; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label-lux">Phone Number *</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control-lux {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                   placeholder="+92 300 0000000"
                                   value="{{ old('phone') }}"
                                   required>
                            @error('phone')
                                <div style="color:#ff6b7a; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label-lux">Delivery Address *</label>
                            <textarea name="address"
                                      class="form-control-lux {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                      placeholder="Street address, house/flat number..."
                                      rows="3"
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <div style="color:#ff6b7a; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="col-md-6">
                            <label class="form-label-lux">City *</label>
                            <input type="text"
                                   name="city"
                                   class="form-control-lux {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                   placeholder="e.g. Karachi, Lahore"
                                   value="{{ old('city') }}"
                                   required>
                            @error('city')
                                <div style="color:#ff6b7a; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Postal Code -->
                        <div class="col-md-6">
                            <label class="form-label-lux">Postal Code</label>
                            <input type="text"
                                   name="postal_code"
                                   class="form-control-lux"
                                   placeholder="e.g. 75500"
                                   value="{{ old('postal_code') }}">
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="checkout-card">
                    <div class="card-section-title">
                        <i class="fas fa-credit-card me-2"></i>Payment Method
                    </div>

                    <!-- Cash on Delivery -->
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cod"
                               {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }} required>
                        <span class="payment-icon"><i class="fas fa-money-bill-wave"></i></span>
                        <span class="payment-label-wrap">
                            <span class="payment-title">Cash on Delivery</span>
                            <span class="payment-desc">Pay when your order arrives at your door</span>
                        </span>
                    </label>

                    <!-- Bank Transfer -->
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="bank_transfer"
                               {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }}>
                        <span class="payment-icon"><i class="fas fa-university"></i></span>
                        <span class="payment-label-wrap">
                            <span class="payment-title">Bank Transfer</span>
                            <span class="payment-desc">Transfer directly to our bank account</span>
                        </span>
                    </label>

                    @error('payment_method')
                        <div style="color:#ff6b7a; font-size:0.78rem; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- ══ RIGHT: Order Summary ══ -->
            <div class="col-lg-5">
                <div class="summary-card">
                    <div class="summary-title">
                        <i class="fas fa-receipt me-2"></i>Order Summary
                        <span style="float:right; color:rgba(255,255,255,0.3); font-size:0.75rem; font-weight:400; letter-spacing:1px;">
                            {{ count($cart) }} {{ Str::plural('item', count($cart)) }}
                        </span>
                    </div>

                    <!-- Cart Items -->
                    @foreach($cart as $productId => $item)
                    <div class="summary-item">
                        <div class="summary-item-name">
                            {{ $item['name'] }}
                            <span class="summary-item-qty">Qty: {{ $item['quantity'] }}</span>
                        </div>
                        <div class="summary-item-price">
                            Rs. {{ number_format($item['price'] * $item['quantity']) }}
                        </div>
                    </div>
                    @endforeach

                    <hr class="summary-divider">

                    <!-- Subtotal -->
                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span class="value">Rs. {{ number_format($total) }}</span>
                    </div>

                    <!-- Shipping -->
                    <div class="summary-row">
                        <span class="label">Shipping</span>
                        <span style="color:#4ade80; font-size:0.82rem; font-weight:600;">FREE</span>
                    </div>

                    <!-- Total -->
                    <div class="summary-total-row">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-value">Rs. {{ number_format($total, 2) }}</span>
                    </div>

                    <!-- Place Order Button -->
                    <button type="submit" class="btn-place-order" id="placeOrderBtn">
                        <i class="fas fa-lock me-2"></i>Place Order
                    </button>

                    <!-- Security Badge -->
                    <div class="security-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>256-bit SSL Secure Checkout</span>
                    </div>
                </div>
            </div>

        </div>
    </form>

    @else
    <!-- Empty Cart State -->
    <div class="empty-checkout">
        <i class="fas fa-shopping-cart fa-3x mb-4 d-block" style="color:rgba(212,175,55,0.3);"></i>
        <h4 style="color:rgba(255,255,255,0.5);">Your cart is empty</h4>
        <p style="color:rgba(255,255,255,0.3); font-size:0.9rem;">Add products to your cart before checking out.</p>
        <a href="{{ route('products.index') }}"
           style="display:inline-block; margin-top:20px; padding:12px 30px; border:1px solid #D4AF37; color:#D4AF37; border-radius:50px; font-size:0.82rem; letter-spacing:2px; text-transform:uppercase; text-decoration:none;">
            <i class="fas fa-shopping-bag me-2"></i>Browse Products
        </a>
    </div>
    @endif

</div>
</div>

<script>
// Prevent double submission
document.getElementById('checkoutForm')?.addEventListener('submit', function() {
    const btn = document.getElementById('placeOrderBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
});
</script>

@endsection
