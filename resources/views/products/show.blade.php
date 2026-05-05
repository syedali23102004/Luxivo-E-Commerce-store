@extends('layouts.app')

@section('title', $product->name . ' - LUXIVO')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-5 mb-4">
            <div class="product-gallery">
                <!-- Main Image -->
                <div class="main-image mb-3">
                    <img src="{{ asset($product->image) }}" 
                         class="img-fluid rounded shadow"
                         id="main-product-image"
                         alt="{{ $product->name }}"
                         onerror="this.onerror=null; this.src='{{ asset('images/products/electronics.jpg') }}';"
                         style="width:100%; height:250px; object-fit:cover;">
                </div>

                <!-- Thumbnail Images Row -->
                <div class="thumbnail-row d-flex gap-2 overflow-auto pb-2">
                    <img src="{{ $product->image }}"
                         class="thumbnail-img rounded border"
                         alt="Product view 1"
                         onclick="changeMainImage(this.src)">
                    <!-- Add more thumbnail placeholders if you have multiple images -->
                    @for($i = 2; $i <= 4; $i++)
                    <img src="https://picsum.photos/seed/{{ $product->id + $i }}/400/400"
                         class="thumbnail-img rounded border"
                         alt="Product view {{ $i }}"
                         onclick="changeMainImage(this.src)">
                    @endfor
                </div>
            </div>
        </div>

        <!-- Product Information -->
        <div class="col-lg-7">
            <div class="product-info">
                <!-- Category Badge -->
                <span class="badge bg-primary mb-3">{{ $product->category->name }}</span>

                <!-- Product Name -->
                <h1 class="h2 mb-3 fw-bold">{{ $product->name }}</h1>

                <!-- Rating -->
                <div class="rating mb-3">
                    @php
                        $rating = rand(4, 5);
                        $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                    @endphp
                    <span class="text-warning fs-5">{{ $stars }}</span>
                    <span class="text-muted ms-2">({{ rand(10, 100) }} reviews)</span>
                </div>

                <!-- Price -->
                <div class="price-section mb-4">
                    @if($product->discount_price && $product->discount_price < $product->price)
                        <span class="text-decoration-line-through text-muted fs-4 me-3">
                            Rs. {{ number_format($product->price) }}
                        </span>
                        <span class="fw-bold text-primary fs-2">
                            Rs. {{ number_format($product->discount_price) }}
                        </span>
                        <div class="text-success fw-bold mt-1">
                            {{ round((1 - $product->discount_price / $product->price) * 100) }}% OFF
                        </div>
                    @else
                        <span class="fw-bold text-primary fs-2">
                            Rs. {{ number_format($product->price) }}
                        </span>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="mb-4">
                    @if($product->stock > 0)
                        <span class="badge bg-success fs-6 px-3 py-2">
                            <i class="fas fa-check-circle me-2"></i>In Stock ({{ $product->stock }} available)
                        </span>
                    @else
                        <span class="badge bg-danger fs-6 px-3 py-2">
                            <i class="fas fa-times-circle me-2"></i>Out of Stock
                        </span>
                    @endif
                </div>

                <!-- Brand -->
                <div class="mb-4">
                    <strong class="text-muted">Brand:</strong>
                    <span class="ms-2">{{ $product->brand }}</span>
                </div>

                <!-- Quantity Selector -->
                <div class="quantity-section mb-4">
                    <label class="form-label fw-bold">Quantity:</label>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary btn-sm" onclick="changeQuantity(-1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" class="form-control text-center mx-2" id="quantity" value="1" min="1" max="{{ $product->stock }}" style="width: 80px;">
                        <button class="btn btn-outline-secondary btn-sm" onclick="changeQuantity(1)">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons mb-4">
                    <div class="row g-2">
                        <div class="col-6">
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="cart-quantity" value="1">
                                <button type="submit" class="btn btn-warning w-100 py-3 fw-bold add-to-cart-btn">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-outline-primary w-100 py-3 fw-bold">
                                <i class="fas fa-bolt me-2"></i>Buy Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Meta -->
                <div class="product-meta border-top pt-4">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <strong class="text-muted">SKU:</strong>
                            <span class="ms-2">LUX-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <strong class="text-muted">Category:</strong>
                            <span class="ms-2">{{ $product->category->name }}</span>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <strong class="text-muted">Brand:</strong>
                            <span class="ms-2">{{ $product->brand }}</span>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <strong class="text-muted">Availability:</strong>
                            <span class="ms-2">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs border-bottom-0" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab">
                                <i class="fas fa-info-circle me-2"></i>Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="specifications-tab" data-bs-toggle="tab"
                                    data-bs-target="#specifications" type="button" role="tab">
                                <i class="fas fa-list me-2"></i>Specifications
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews" type="button" role="tab">
                                <i class="fas fa-star me-2"></i>Reviews ({{ rand(10, 50) }})
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content p-4" id="productTabsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <h5 class="mb-3">Product Description</h5>
                            <p class="text-muted mb-4">{{ $product->description }}</p>

                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Key Features:</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Premium quality materials</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Long-lasting durability</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Modern design</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Easy to use</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">What's Included:</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-box text-primary me-2"></i>Main product unit</li>
                                        <li class="mb-2"><i class="fas fa-book text-primary me-2"></i>User manual</li>
                                        <li class="mb-2"><i class="fas fa-shield-alt text-primary me-2"></i>Warranty card</li>
                                        <li class="mb-2"><i class="fas fa-tools text-primary me-2"></i>Basic accessories</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Specifications Tab -->
                        <div class="tab-pane fade" id="specifications" role="tabpanel">
                            <h5 class="mb-4">Technical Specifications</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold text-muted" width="30%">Brand</td>
                                            <td>{{ $product->brand }}</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <td class="fw-bold text-muted">Category</td>
                                            <td>{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-muted">SKU</td>
                                            <td>LUX-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <td class="fw-bold text-muted">Weight</td>
                                            <td>{{ rand(500, 5000) }}g</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-muted">Dimensions</td>
                                            <td>{{ rand(10, 50) }} x {{ rand(10, 50) }} x {{ rand(5, 30) }} cm</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <td class="fw-bold text-muted">Material</td>
                                            <td>Premium Quality</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold text-muted">Warranty</td>
                                            <td>{{ rand(1, 5) }} Year{{ rand(1, 5) > 1 ? 's' : '' }} Limited Warranty</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <td class="fw-bold text-muted">Origin</td>
                                            <td>Made in Pakistan</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <h5 class="mb-4">Customer Reviews</h5>

                            @for($i = 1; $i <= 3; $i++)
                            <div class="review-item border-bottom pb-4 mb-4">
                                <div class="d-flex align-items-start">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <span class="fw-bold">{{ substr(['Ahmed', 'Sara', 'Ali', 'Fatima', 'Hassan'][$i-1], 0, 1) }}</span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1">{{ ['Ahmed Khan', 'Sara Ahmed', 'Ali Raza', 'Fatima Bibi', 'Hassan Ali'][$i-1] }}</h6>
                                                <div class="rating">
                                                    @php $reviewRating = rand(4, 5); @endphp
                                                    <span class="text-warning">
                                                        {{ str_repeat('★', $reviewRating) . str_repeat('☆', 5 - $reviewRating) }}
                                                    </span>
                                                    <small class="text-muted ms-2">{{ rand(1, 30) }} days ago</small>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-0">
                                            {{ ['Excellent product! Highly recommended. The quality is outstanding and it arrived quickly.',
                                                 'Very satisfied with this purchase. Works perfectly and great value for money.',
                                                 'Good product overall. Does what it says and the customer service was helpful.'][$i-1] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endfor

                            <div class="text-center">
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-2"></i>Load More Reviews
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="text-center mb-4 fw-bold text-primary">You May Also Like</h3>
            <div class="row g-4">
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="position-relative">
                            <img src="{{ asset($relatedProduct->image) }}" 
                                 alt="{{ $relatedProduct->name }}"
                                 onerror="this.onerror=null; this.src='{{ asset('images/products/electronics.jpg') }}';"
                                 style="width:100%; height:250px; object-fit:cover;"
                                 class="card-img-top">
                            @if($relatedProduct->is_featured)
                                <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">
                                    <i class="fas fa-star me-1"></i>Featured
                                </span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted mb-1">{{ $relatedProduct->category->name }}</small>
                            <h6 class="card-title mb-2">
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" class="text-decoration-none text-dark">
                                    {{ Str::limit($relatedProduct->name, 40) }}
                                </a>
                            </h6>
                            <div class="mb-3">
                                @if($relatedProduct->discount_price && $relatedProduct->discount_price < $relatedProduct->price)
                                    <span class="text-decoration-line-through text-muted me-2">
                                        Rs. {{ number_format($relatedProduct->price) }}
                                    </span>
                                    <span class="fw-bold text-primary">
                                        Rs. {{ number_format($relatedProduct->discount_price) }}
                                    </span>
                                @else
                                    <span class="fw-bold text-primary">
                                        Rs. {{ number_format($relatedProduct->price) }}
                                    </span>
                                @endif
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<script>
function changeMainImage(src) {
    document.getElementById('main-product-image').src = src;
    // Update active thumbnail
    document.querySelectorAll('.thumbnail-img').forEach(img => {
        img.classList.remove('border-primary');
        if (img.src === src) {
            img.classList.add('border-primary');
        }
    });
}

function changeQuantity(delta) {
    const quantityInput = document.getElementById('quantity');
    const cartQuantityInput = document.getElementById('cart-quantity');
    const currentValue = parseInt(quantityInput.value);
    const maxValue = parseInt(quantityInput.max);
    const newValue = currentValue + delta;

    if (newValue >= 1 && newValue <= maxValue) {
        quantityInput.value = newValue;
        cartQuantityInput.value = newValue;
    }
}

// Add to cart functionality
document.addEventListener('DOMContentLoaded', function() {
    // Cart functionality now handled by form submission
    // Initialize first thumbnail as active
    document.querySelector('.thumbnail-img').classList.add('border-primary');
});
</script>

<style>
.product-gallery .thumbnail-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid #dee2e6;
    transition: border-color 0.3s ease;
}

.product-gallery .thumbnail-img:hover,
.product-gallery .thumbnail-img.border-primary {
    border-color: #ffc107;
}

.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.rating {
    font-size: 1.2rem;
}

.price-section .fs-2 {
    font-size: 2rem !important;
}

.action-buttons .btn {
    font-size: 1.1rem;
}

.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    padding: 1rem 1.5rem;
}

.nav-tabs .nav-link.active {
    background-color: #ffc107;
    color: #000;
    border-color: #ffc107;
}

.table-borderless td {
    border: none;
    padding: 0.75rem 0;
}
</style>
@endsection