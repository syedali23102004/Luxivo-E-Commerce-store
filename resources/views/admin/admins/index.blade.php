@extends('layouts.admin')

@section('title', 'Admins Management - LUXIVO')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary">
                <i class="fas fa-user-shield me-2"></i>Admins Management
            </h1>
            <p class="text-muted mb-0">Manage administrator accounts and permissions.</p>
        </div>
        <div>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Admin
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

    <!-- Admins Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table id="admins-table" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Last Login</th>
                        <th>Status</th>
                        <th>Joined Date</th>
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
                <h5 class="modal-title text-danger" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this admin account? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> Deleting an admin account will permanently remove their access to the system.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">
                    <i class="fas fa-trash me-2"></i>Delete Admin
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#admins-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.admins.data") }}',
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id', width: '5%' },
            { data: 'name', name: 'name', width: '20%' },
            { data: 'email', name: 'email', width: '25%' },
            { data: 'last_login', name: 'last_login', width: '15%' },
            { data: 'status', name: 'status', width: '10%', className: 'text-center' },
            { data: 'created_at', name: 'created_at', width: '15%' },
            { data: 'actions', name: 'actions', orderable: false, width: '10%', className: 'text-center' }
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
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf me-1"></i>PDF',
                className: 'btn btn-danger btn-sm',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print me-1"></i>Print',
                className: 'btn btn-info btn-sm',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }
        ],
        language: {
            processing: '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><br>Processing...</div>',
            emptyTable: '<div class="text-center py-4"><i class="fas fa-user-shield fa-3x text-muted mb-3"></i><h5 class="text-muted">No admins found</h5><p class="text-muted">Administrator accounts will appear here.</p></div>'
        },
        initComplete: function() {
            // Add custom styling to buttons
            $('.dt-buttons').addClass('mt-3');
            $('.dt-buttons .btn').addClass('me-2');
        }
    });
});

// Delete confirmation function
function confirmDelete(adminId) {
    $('#deleteModal').modal('show');
    $('#confirm-delete').data('admin-id', adminId);
}

// Handle delete confirmation
$('#confirm-delete').click(function() {
    const adminId = $(this).data('admin-id');

    // Here you would typically make an AJAX call to delete the admin
    // For now, we'll just show a success message
    $('#deleteModal').modal('hide');

    // Reload the table
    $('#admins-table').DataTable().ajax.reload();

    toastr.success('Admin deleted successfully');
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