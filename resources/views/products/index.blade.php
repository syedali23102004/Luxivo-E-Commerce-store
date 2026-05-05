@extends('layouts.app')

@section('title', 'Products - LUXIVO')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 col-md-4">
            <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
                <h5 class="mb-4 fw-bold text-primary">
                    <i class="fas fa-filter me-2"></i>Filters
                </h5>

                <!-- Search Bar -->
                <div class="mb-4">
                    <form method="GET" action="{{ route('products.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control me-2"
                               placeholder="Search products..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Categories -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Categories</h6>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('products.index') }}"
                           class="list-group-item list-group-item-action px-0 py-2 {{ !request('category') ? 'active' : '' }}">
                            All Categories
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           class="list-group-item list-group-item-action px-0 py-2 {{ request('category') === $category->slug ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Price Range</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="number" name="min_price" class="form-control form-control-sm"
                                   placeholder="Min" value="{{ request('min_price') }}">
                        </div>
                        <div class="col-6">
                            <input type="number" name="max_price" class="form-control form-control-sm"
                                   placeholder="Max" value="{{ request('max_price') }}">
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2 w-100" onclick="applyFilters()">
                        Apply Price Filter
                    </button>
                </div>

                <!-- Sort Options -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Sort By</h6>
                    <select class="form-select" onchange="changeSort(this.value)">
                        <option value="">Default</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="featured" {{ request('sort') === 'featured' ? 'selected' : '' }}>Featured</option>
                    </select>
                </div>

                <!-- Clear Filters -->
                <div class="d-grid">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Clear All Filters
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-lg-9 col-md-8">
            <!-- Active Filters & Results Count -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    @if(request('search'))
                        <span class="badge bg-primary me-2">Search: {{ request('search') }}</span>
                    @endif
                    @if(request('category'))
                        <span class="badge bg-success me-2">Category: {{ $categories->where('slug', request('category'))->first()->name ?? 'Unknown' }}</span>
                    @endif
                    @if(request('min_price') || request('max_price'))
                        <span class="badge bg-info me-2">
                            Price: Rs. {{ number_format(request('min_price', 0)) }} - Rs. {{ number_format(request('max_price', '∞')) }}
                        </span>
                    @endif
                    @if(request('sort'))
                        <span class="badge bg-warning text-dark me-2">
                            Sort: {{ ucwords(str_replace('_', ' ', request('sort'))) }}
                        </span>
                    @endif
                </div>
                <div class="text-muted">
                    Showing {{ $products->count() }} of {{ $products->total() }} products
                </div>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="position-relative">
                            <img src="{{ asset($product->image) }}" 
                                 alt="{{ $product->name }}"
                                 onerror="this.onerror=null; this.src='{{ asset('images/products/electronics.jpg') }}';"
                                 style="width:100%; height:250px; object-fit:cover;"
                                 class="card-img-top">
                            @if($product->is_featured)
                                <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">
                                    <i class="fas fa-star me-1"></i>Featured
                                </span>
                            @endif
                            @if($product->created_at->diffInDays() < 7)
                                <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                    <i class="fas fa-fire me-1"></i>New
                                </span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted mb-1">{{ $product->category->name }}</small>
                            <h6 class="card-title mb-2">
                                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    {{ Str::limit($product->name, 50) }}
                                </a>
                            </h6>
                            <div class="mb-3">
                                @if($product->discount_price && $product->discount_price < $product->price)
                                    <span class="text-decoration-line-through text-muted me-2">
                                        Rs. {{ number_format($product->price) }}
                                    </span>
                                    <span class="fw-bold text-primary fs-5">
                                        Rs. {{ number_format($product->discount_price) }}
                                    </span>
                                    <small class="text-success ms-2">
                                        {{ round((1 - $product->discount_price / $product->price) * 100) }}% off
                                    </small>
                                @else
                                    <span class="fw-bold text-primary fs-5">
                                        Rs. {{ number_format($product->price) }}
                                    </span>
                                @endif
                            </div>
                            <div class="mt-auto">
                                <form method="POST" action="{{ route('cart.add') }}" class="d-inline w-100">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-warning w-100 add-to-cart-btn">
                                        <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No products found</h4>
                <p class="text-muted">Try adjusting your filters or search terms.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    <i class="fas fa-times me-2"></i>Clear Filters
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function applyFilters() {
    const minPrice = document.querySelector('input[name="min_price"]').value;
    const maxPrice = document.querySelector('input[name="max_price"]').value;
    const currentUrl = new URL(window.location);

    if (minPrice) currentUrl.searchParams.set('min_price', minPrice);
    else currentUrl.searchParams.delete('min_price');

    if (maxPrice) currentUrl.searchParams.set('max_price', maxPrice);
    else currentUrl.searchParams.delete('max_price');

    window.location.href = currentUrl.toString();
}

function changeSort(sortValue) {
    const currentUrl = new URL(window.location);
    if (sortValue) {
        currentUrl.searchParams.set('sort', sortValue);
    } else {
        currentUrl.searchParams.delete('sort');
    }
    window.location.href = currentUrl.toString();
}

// Add to cart functionality
document.addEventListener('DOMContentLoaded', function() {
    // Cart functionality now handled by form submission
    // Add any additional cart-related JavaScript here if needed
});
</script>

<style>
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.card-img-top {
    border-radius: 0.375rem 0.375rem 0 0;
}
</style>
@endsection