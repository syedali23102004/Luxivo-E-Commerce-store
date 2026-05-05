@extends('layouts.app')

@section('title', 'Home - LUXIVO')

@section('content')

<!-- ═══════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════ -->
<section class="hero-section" style="background:#000000;">
    <div class="hero-background" style="background:#000000;"></div>

    <!-- Gold Particles -->
    <div class="hero-particles">
        @for($i = 0; $i < 20; $i++)
            <div class="particle" style="left:{{ rand(5,95) }}%; top:{{ rand(5,95) }}%; animation-delay:{{ $i * 0.3 }}s;"></div>
        @endfor
    </div>

    <div class="container position-relative" style="z-index:3;">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <h1 class="hero-title mb-4" style="font-family:'Playfair Display',serif; font-size:clamp(3rem,8vw,6rem); font-weight:900; background:linear-gradient(135deg,#ffffff,#D4AF37); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    Where Luxury <span style="background:linear-gradient(135deg,#D4AF37,#c9a96e,#D4AF37); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">Meets You</span>
                </h1>
                <p class="hero-subtitle mb-5" style="font-family:'Raleway',sans-serif; font-size:1.35rem; color:rgba(255,255,255,0.65); max-width:650px; margin:0 auto; line-height:1.7;">
                    Discover a curated collection of premium products crafted for those who demand nothing but the extraordinary.
                </p>
                <div class="hero-buttons d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('products.index') }}" class="btn btn-gold" style="background:linear-gradient(135deg,#D4AF37,#c9a96e); border:none; color:#000; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:16px 40px; border-radius:50px; box-shadow:0 10px 30px rgba(212,175,55,0.3); transition:all 0.3s ease; text-decoration:none;">
                        <i class="fas fa-gem me-2"></i>Explore Collection
                    </a>
                    <a href="#categories" class="btn btn-outline-gold" style="border:2px solid #D4AF37; color:#D4AF37; background:transparent; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:16px 40px; border-radius:50px; transition:all 0.3s ease; text-decoration:none;">
                        <i class="fas fa-th-large me-2"></i>Categories
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════
     CATEGORIES SECTION
═══════════════════════════════════════ -->
<section id="categories" class="py-5" style="background:#000000;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="text-gradient-gold mb-3" style="font-family:'Playfair Display',serif; font-size:2.5rem; font-weight:700; background:linear-gradient(135deg,#D4AF37,#c9a96e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                Shop by Category
            </h2>
            <p style="color:rgba(255,255,255,0.5); font-size:1rem; letter-spacing:1px;">BROWSE OUR EXCLUSIVE COLLECTIONS</p>
            <div style="width:80px; height:2px; background:linear-gradient(90deg,transparent,#D4AF37,transparent); margin:20px auto;"></div>
        </div>

        <div class="row g-4">
            @forelse($categories as $category)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('category.show', $category->slug) }}" class="text-decoration-none">
                    <div class="category-card">
                        <div class="card h-100 text-center p-4" style="background:#111111; border:1px solid rgba(212,175,55,0.15); border-top:3px solid #D4AF37; border-radius:16px; transition:all 0.4s ease;">
                            <div class="mb-3" style="font-size:2.5rem; color:#D4AF37;">
                                <i class="fas fa-{{ $category->icon ?? 'tag' }}"></i>
                            </div>
                            <h5 class="card-title" style="font-family:'Playfair Display',serif; color:#D4AF37; font-weight:700; font-size:1.1rem; margin-bottom:0.5rem;">
                                {{ $category->name }}
                            </h5>
                            @if(isset($category->products_count))
                            <span class="badge" style="background:rgba(212,175,55,0.1); color:#D4AF37; border:1px solid rgba(212,175,55,0.3); font-weight:600;">
                                {{ $category->products_count }} Products
                            </span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p style="color:rgba(255,255,255,0.4);">No categories available.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════
     FEATURED PRODUCTS SECTION
═══════════════════════════════════════ -->
<section class="py-5" style="background:#000000;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="text-gradient-gold mb-3" style="font-family:'Playfair Display',serif; font-size:2.5rem; font-weight:700; background:linear-gradient(135deg,#D4AF37,#c9a96e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                Featured Products
            </h2>
            <p style="color:rgba(255,255,255,0.5); font-size:1rem; letter-spacing:1px;">HANDPICKED FOR THE DISCERNING FEW</p>
            <div style="width:80px; height:2px; background:linear-gradient(90deg,transparent,#D4AF37,transparent); margin:20px auto;"></div>
        </div>

        <div class="row g-4">
            @forelse($featuredProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card h-100" style="background:#111111; border:1px solid rgba(212,175,55,0.15); border-radius:16px; overflow:hidden; transition:all 0.4s ease;">
                    <!-- Image -->
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset($product->image) }}"
                             alt="{{ $product->name }}"
                             onerror="this.onerror=null; this.src='{{ asset('images/products/electronics.jpg') }}';"
                             class="product-image w-100"
                             style="height:220px; object-fit:cover; transition:transform 0.4s ease;">

                        @if($product->created_at && $product->created_at->diffInDays() < 30)
                            <span class="position-absolute top-0 end-0 m-2" style="background:#1a1a1a; border:1px solid #4ade80; color:#4ade80; font-size:0.7rem; font-weight:600; letter-spacing:1px; padding:4px 10px; border-radius:20px;">
                                <i class="fas fa-fire me-1"></i>New
                            </span>
                        @endif
                    </div>

                    <!-- Body -->
                    <div class="card-body p-3 d-flex flex-column" style="background:#111111;">
                        <span style="color:rgba(212,175,55,0.7); font-size:0.72rem; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:6px; display:block; font-weight:600;">
                            {{ $product->category->name ?? 'Luxury' }}
                        </span>

                        <a href="{{ route('products.show', $product->slug) }}" class="product-title text-decoration-none" style="font-family:'Playfair Display',serif; color:#ffffff; font-size:1rem; font-weight:600; line-height:1.4; margin-bottom:10px; display:block;">
                            {{ Str::limit($product->name, 50) }}
                        </a>

                        <!-- Price -->
                        <div class="mb-3">
                            @if($product->discount_price && $product->discount_price < $product->price)
                                <span style="color:rgba(255,255,255,0.35); font-size:0.85rem; text-decoration:line-through; margin-right:8px;">Rs. {{ number_format($product->price) }}</span>
                                <span style="color:#D4AF37; font-size:1.15rem; font-weight:700; font-family:'Playfair Display',serif;">Rs. {{ number_format($product->discount_price) }}</span>
                                <span style="color:#4ade80; font-size:0.75rem; margin-left:6px; font-weight:600;">{{ round((1 - $product->discount_price / $product->price) * 100) }}% off</span>
                            @else
                                <span style="color:#D4AF37; font-size:1.15rem; font-weight:700; font-family:'Playfair Display',serif;">Rs. {{ number_format($product->price) }}</span>
                            @endif
                        </div>

                        <!-- Add to Cart -->
                        <div class="mt-auto">
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn w-100" style="background:#D4AF37; border:2px solid #D4AF37; border-radius:50px; color:#000; font-size:0.78rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:10px; transition:all 0.3s ease; cursor:pointer;"
                                        onmouseover="this.style.background='transparent'; this.style.color='#D4AF37';"
                                        onmouseout="this.style.background='#D4AF37'; this.style.color='#000';">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-gem fa-3x mb-4" style="color:rgba(212,175,55,0.2);"></i>
                <h4 style="color:rgba(255,255,255,0.5); font-family:'Playfair Display',serif;">No Featured Products</h4>
                <p style="color:rgba(255,255,255,0.3); font-size:0.9rem;">Check back soon for our handpicked selection.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════
     LATEST PRODUCTS SECTION
═══════════════════════════════════════ -->
<section class="py-5 mb-5" style="background:#000000;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="text-gradient-gold mb-3" style="font-family:'Playfair Display',serif; font-size:2.5rem; font-weight:700; background:linear-gradient(135deg,#D4AF37,#c9a96e); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                Latest Arrivals
            </h2>
            <p style="color:rgba(255,255,255,0.5); font-size:1rem; letter-spacing:1px;">THE NEWEST ADDITIONS TO OUR COLLECTION</p>
            <div style="width:80px; height:2px; background:linear-gradient(90deg,transparent,#D4AF37,transparent); margin:20px auto;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card h-100" style="background:#111111; border:1px solid rgba(212,175,55,0.15); border-radius:16px; overflow:hidden; transition:all 0.4s ease;">
                    <!-- Image -->
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset($product->image) }}"
                             alt="{{ $product->name }}"
                             onerror="this.onerror=null; this.src='{{ asset('images/products/electronics.jpg') }}';"
                             class="product-image w-100"
                             style="height:220px; object-fit:cover; transition:transform 0.4s ease;">

                        <span class="position-absolute top-0 start-0 m-2" style="background:#D4AF37; color:#000; font-size:0.7rem; font-weight:700; letter-spacing:1px; padding:4px 10px; border-radius:20px;">
                            <i class="fas fa-star me-1"></i>New
                        </span>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-3 d-flex flex-column" style="background:#111111;">
                        <span style="color:rgba(212,175,55,0.7); font-size:0.72rem; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:6px; display:block; font-weight:600;">
                            {{ $product->category->name ?? 'Luxury' }}
                        </span>

                        <a href="{{ route('products.show', $product->slug) }}" class="product-title text-decoration-none" style="font-family:'Playfair Display',serif; color:#ffffff; font-size:1rem; font-weight:600; line-height:1.4; margin-bottom:10px; display:block;">
                            {{ Str::limit($product->name, 50) }}
                        </a>

                        <!-- Price -->
                        <div class="mb-3">
                            @if($product->discount_price && $product->discount_price < $product->price)
                                <span style="color:rgba(255,255,255,0.35); font-size:0.85rem; text-decoration:line-through; margin-right:8px;">Rs. {{ number_format($product->price) }}</span>
                                <span style="color:#D4AF37; font-size:1.15rem; font-weight:700; font-family:'Playfair Display',serif;">Rs. {{ number_format($product->discount_price) }}</span>
                                <span style="color:#4ade80; font-size:0.75rem; margin-left:6px; font-weight:600;">{{ round((1 - $product->discount_price / $product->price) * 100) }}% off</span>
                            @else
                                <span style="color:#D4AF37; font-size:1.15rem; font-weight:700; font-family:'Playfair Display',serif;">Rs. {{ number_format($product->price) }}</span>
                            @endif
                        </div>

                        <!-- Add to Cart -->
                        <div class="mt-auto">
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn w-100" style="background:#D4AF37; border:2px solid #D4AF37; border-radius:50px; color:#000; font-size:0.78rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:10px; transition:all 0.3s ease; cursor:pointer;"
                                        onmouseover="this.style.background='transparent'; this.style.color='#D4AF37';"
                                        onmouseout="this.style.background='#D4AF37'; this.style.color='#000';">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-3x mb-4" style="color:rgba(212,175,55,0.2);"></i>
                <h4 style="color:rgba(255,255,255,0.5); font-family:'Playfair Display',serif;">No New Arrivals</h4>
                <p style="color:rgba(255,255,255,0.3); font-size:0.9rem;">Stay tuned for upcoming releases.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<style>
/* Hover enhancements */
.category-card:hover .card {
    transform: translateY(-8px);
    border-color: rgba(212, 175, 55, 0.4) !important;
    box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 20px rgba(212,175,55,0.1) !important;
}
.product-card:hover {
    transform: translateY(-8px);
    border-color: rgba(212, 175, 55, 0.4) !important;
    box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 20px rgba(212,175,55,0.1) !important;
}
.product-card:hover .product-image {
    transform: scale(1.08);
}
</style>

@endsection

