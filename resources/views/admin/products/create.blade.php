@extends('layouts.admin')

@section('title', 'Add New Product - LUXIVO')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary">
                <i class="fas fa-plus me-2"></i>Add New Product
            </h1>
            <p class="text-muted mb-0">Create a new product for your catalog.</p>
        </div>
        <div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Products
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
                        @csrf

                        <div class="row">
                            <!-- Product Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       value="{{ old('slug') }}" required>
                                <div class="form-text">URL-friendly version of the name</div>
                                @error('slug')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Brand -->
                            <div class="col-md-6 mb-3">
                                <label for="brand" class="form-label fw-bold">Brand <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="brand" name="brand"
                                       value="{{ old('brand') }}" required>
                                @error('brand')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Price -->
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label fw-bold">Price (Rs.) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="price" name="price"
                                       value="{{ old('price') }}" step="0.01" min="0" required>
                                @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Discount Price -->
                            <div class="col-md-4 mb-3">
                                <label for="discount_price" class="form-label fw-bold">Discount Price (Rs.)</label>
                                <input type="number" class="form-control" id="discount_price" name="discount_price"
                                       value="{{ old('discount_price') }}" step="0.01" min="0">
                                <div class="form-text">Leave empty if no discount</div>
                                @error('discount_price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div class="col-md-4 mb-3">
                                <label for="stock" class="form-label fw-bold">Stock Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                       value="{{ old('stock', 0) }}" min="0" required>
                                @error('stock')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload OR URL -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-white">Product Image</label>
                            
                            <!-- Tab buttons -->
                            <div class="mb-2">
                                <button type="button" class="btn btn-sm btn-gold" onclick="showTab('upload')">Upload File</button>
                                <button type="button" class="btn btn-sm btn-outline-warning ms-2" onclick="showTab('url')">Use URL</button>
                            </div>

                            <!-- File Upload Tab -->
                            <div id="tab-upload">
                                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                                <img id="image-preview" src="" class="mt-2 rounded" style="max-height:150px;display:none;">
                                <div class="form-text mt-1">Supported: JPEG, PNG, JPG, WebP (max 2MB)</div>
                            </div>

                            <!-- URL Tab -->
                            <div id="tab-url" style="display:none;">
                                <input type="text" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
                                <div class="form-text mt-1">Paste direct image URL</div>
                            </div>
                            @error('image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            @error('image_url')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Featured Toggle -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_featured">
                                    <i class="fas fa-star text-warning me-2"></i>Mark as Featured Product
                                </label>
                            </div>
                            <div class="form-text">Featured products appear prominently on the homepage</div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
        .replace(/\s+/g, '-') // Replace spaces with hyphens
        .replace(/-+/g, '-') // Replace multiple hyphens with single
        .trim('-'); // Trim hyphens from start/end

    document.getElementById('slug').value = slug;
});

function showTab(tab) {
    document.getElementById('tab-upload').style.display = tab === 'upload' ? 'block' : 'none';
    document.getElementById('tab-url').style.display = tab === 'url' ? 'block' : 'none';
}
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    }
}

// Form validation
document.getElementById('product-form').addEventListener('submit', function(e) {
    const discountPrice = parseFloat(document.getElementById('discount_price').value) || 0;
    const price = parseFloat(document.getElementById('price').value) || 0;

    if (discountPrice >= price && discountPrice > 0) {
        e.preventDefault();
        alert('Discount price must be less than regular price.');
        document.getElementById('discount_price').focus();
        return false;
    }
});
</script>

<style>
.card {
    border-radius: 0.5rem;
}

.form-label {
    color: #495057;
    font-weight: 600 !important;
}

.form-control, .form-select {
    border-radius: 0.375rem;
    border: 1px solid #dee2e6;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #000;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
    color: #000;
}

.img-thumbnail {
    border-radius: 0.375rem;
}

.form-check-input:checked {
    background-color: #ffc107;
    border-color: #ffc107;
}

.form-check-input:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}
</style>
@endsection