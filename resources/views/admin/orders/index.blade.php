@extends('layouts.admin')

@section('title', 'Orders Management - LUXIVO')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary">
                <i class="fas fa-shopping-bag me-2"></i>Orders Management
            </h1>
            <p class="text-muted mb-0">Manage and track all customer orders.</p>
        </div>
        <div>
            <span class="badge bg-info fs-6 px-3 py-2">
                <i class="fas fa-clock me-1"></i>Real-time Updates
            </span>
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

    <!-- Orders Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table id="orders-table" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">
                    <i class="fas fa-edit text-primary me-2"></i>Update Order Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to update the status of order <strong id="modal-order-id"></strong>?</p>
                <div class="mb-3">
                    <label for="status-select" class="form-label">New Status:</label>
                    <select class="form-select" id="status-select">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-status-update">
                    <i class="fas fa-save me-2"></i>Update Status
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.orders.data") }}',
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id', width: '5%' },
            { data: 'customer_name', name: 'customer_name', width: '15%' },
            { data: 'customer_email', name: 'customer_email', width: '20%' },
            { data: 'total_formatted', name: 'total_amount', width: '10%' },
            { data: 'status_dropdown', name: 'status', orderable: false, width: '12%' },
            { data: 'payment_method', name: 'payment_method', width: '10%' },
            { data: 'created_at', name: 'created_at', width: '12%' },
            { data: 'actions', name: 'actions', orderable: false, width: '16%' }
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
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf me-1"></i>PDF',
                className: 'btn btn-danger btn-sm',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print me-1"></i>Print',
                className: 'btn btn-info btn-sm',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }
        ],
        language: {
            processing: '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><br>Processing...</div>',
            emptyTable: '<div class="text-center py-4"><i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i><h5 class="text-muted">No orders found</h5><p class="text-muted">Orders will appear here once customers start purchasing.</p></div>'
        },
        initComplete: function() {
            // Add custom styling to buttons
            $('.dt-buttons').addClass('mt-3');
            $('.dt-buttons .btn').addClass('me-2');
        }
    });

    // Handle status dropdown changes
    $('#orders-table').on('change', '.status-dropdown', function() {
        const orderId = $(this).data('order-id');
        const newStatus = $(this).val();
        const row = $(this).closest('tr');

        // Show loading state
        $(this).prop('disabled', true);

        // Update status via AJAX
        $.ajax({
            url: '{{ route("admin.orders.index") }}/' + orderId + '/status',
            type: 'POST',
            data: {
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Update the badge
                    const badge = row.find('.status-badge');
                    const statusColors = {
                        'pending': 'warning',
                        'processing': 'primary',
                        'shipped': 'info',
                        'delivered': 'success',
                        'cancelled': 'danger'
                    };

                    badge.removeClass('bg-warning bg-primary bg-info bg-success bg-danger')
                         .addClass('bg-' + statusColors[newStatus])
                         .text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));

                    toastr.success(response.message);
                } else {
                    toastr.error('Failed to update status');
                }
            },
            error: function(xhr) {
                toastr.error('Error updating status');
                // Revert dropdown
                $(this).val(row.find('.status-badge').text().toLowerCase());
            },
            complete: function() {
                // Remove loading state
                $('.status-dropdown').prop('disabled', false);
            }
        });
    });
});
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

/* Status Dropdown */
.status-dropdown {
    min-width: 120px;
    font-size: 0.85rem;
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

    .status-dropdown {
        min-width: 100px;
    }
}
</style>
@endsection