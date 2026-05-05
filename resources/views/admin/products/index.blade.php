@extends('layouts.admin')

@section('title', 'Products Management - LUXIVO')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary">
                <i class="fas fa-box me-2"></i>Products Management
            </h1>
            <p class="text-muted mb-0">Manage your product inventory and catalog.</p>
        </div>
        <div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-warning">
                <i class="fas fa-plus me-2"></i>Add New Product
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Products Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table id="products-table" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Stock</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-trash text-danger me-2"></i>Delete Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product? This action cannot be undone.</p>
                <p class="text-muted mb-0">Product: <strong id="delete-product-name"></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm-delete-btn">
                    <i class="fas fa-trash me-2"></i>Delete Product
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.products.data") }}',
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id', width: '5%' },
            { data: 'image', name: 'image', orderable: false, width: '8%' },
            { data: 'name', name: 'name', width: '20%' },
            { data: 'category_name', name: 'category_name', width: '12%' },
            { data: 'price_formatted', name: 'price', width: '10%' },
            { data: 'discount_price_formatted', name: 'discount_price', width: '10%' },
            { data: 'stock', name: 'stock', width: '8%' },
            { data: 'is_featured_badge', name: 'is_featured', orderable: false, width: '10%' },
            { data: 'actions', name: 'actions', orderable: false, width: '17%' }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        responsive: true,
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>' +
             '<"row"<"col-sm-12"B>>',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel me-1"></i>Excel',
                className: 'btn btn-success btn-sm',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf me-1"></i>PDF',
                className: 'btn btn-danger btn-sm',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print me-1"></i>Print',
                className: 'btn btn-info btn-sm',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7]
                }
            }
        ],
        language: {
            processing: '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><br>Processing...</div>',
            emptyTable: '<div class="text-center py-4"><i class="fas fa-box-open fa-3x text-muted mb-3"></i><h5 class="text-muted">No products found</h5><p class="text-muted">Start by adding your first product.</p></div>'
        },
        initComplete: function() {
            // Add custom styling to buttons
            $('.dt-buttons').addClass('mt-3');
            $('.dt-buttons .btn').addClass('me-2');
        }
    });
});

// Delete product function
function deleteProduct(productId) {
    // Get product name for confirmation (you might want to fetch this via AJAX)
    $('#delete-product-name').text('Product #' + productId);

    // Set up delete button
    $('#confirm-delete-btn').off('click').on('click', function() {
        // Send delete request
        $.ajax({
            url: '{{ route("admin.products.index") }}/' + productId,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    $('#products-table').DataTable().ajax.reload();
                    toastr.success(response.message);
                } else {
                    toastr.error('Failed to delete product');
                }
            },
            error: function(xhr) {
                toastr.error('Error deleting product');
            }
        });
    });

    // Show modal
    $('#deleteModal').modal('show');
}
</script>

<style>
/* DataTable Custom Styling */
.dataTables_wrapper {
    padding: 1rem;
}

.dataTables_length select,
.dataTables_filter input {
    border-radius: 0.375rem;
    border: 1px solid #dee2e6;
    padding: 0.375rem 0.75rem;
}

.dataTables_filter input:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.table th {
    background-color: #343a40 !important;
    color: white !important;
    border: none !important;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table td {
    vertical-align: middle;
    border-color: #e9ecef;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}

/* Modal Styling */
.modal-content {
    border-radius: 0.5rem;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        text-align: center;
        margin-bottom: 1rem;
    }

    .dt-buttons {
        text-align: center;
        margin-top: 1rem;
    }

    .dt-buttons .btn {
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection