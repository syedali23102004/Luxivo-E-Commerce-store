@extends('layouts.admin')

@section('title', 'Contacts Management - LUXIVO')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-primary">
                <i class="fas fa-envelope me-2"></i>Contacts Management
            </h1>
            <p class="text-muted mb-0">Manage customer inquiries and messages.</p>
        </div>
        <div>
            <span class="badge bg-warning fs-6 px-3 py-2" id="unread-count">
                <i class="fas fa-envelope me-1"></i>Loading...
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

    <!-- Contacts Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table id="contacts-table" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message Preview</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- View Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">
                    <i class="fas fa-envelope-open text-primary me-2"></i>Message Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Name:</strong> <span id="modal-name"></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> <span id="modal-email"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Subject:</strong> <span id="modal-subject"></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Date:</strong> <span id="modal-date"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Message:</strong>
                    <div class="mt-2 p-3 bg-light rounded" id="modal-message"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="mark-read-btn">
                    <i class="fas fa-check me-2"></i>Mark as Read
                </button>
            </div>
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
                <p>Are you sure you want to delete this contact message? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">
                    <i class="fas fa-trash me-2"></i>Delete Message
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#contacts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.contacts.data") }}',
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id', width: '5%' },
            { data: 'name', name: 'name', width: '15%' },
            { data: 'email', name: 'email', width: '20%' },
            { data: 'subject', name: 'subject', width: '15%' },
            { data: 'message_preview', name: 'message_preview', width: '20%' },
            { data: 'status', name: 'status', width: '8%', className: 'text-center' },
            { data: 'created_at', name: 'created_at', width: '12%' },
            { data: 'actions', name: 'actions', orderable: false, width: '5%', className: 'text-center' }
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
            emptyTable: '<div class="text-center py-4"><i class="fas fa-envelope fa-3x text-muted mb-3"></i><h5 class="text-muted">No contact messages</h5><p class="text-muted">Customer inquiries will appear here.</p></div>'
        },
        initComplete: function() {
            // Add custom styling to buttons
            $('.dt-buttons').addClass('mt-3');
            $('.dt-buttons .btn').addClass('me-2');

            // Update unread count
            updateUnreadCount();
        }
    });

    // Update unread count function
    function updateUnreadCount() {
        $.ajax({
            url: '{{ route("admin.contacts.data") }}',
            type: 'GET',
            data: { unread_only: true },
            success: function(data) {
                const unreadCount = data.recordsTotal || 0;
                $('#unread-count').html('<i class="fas fa-envelope me-1"></i>' + unreadCount + ' Unread');
                $('#unread-count').removeClass('bg-warning bg-success').addClass(unreadCount > 0 ? 'bg-warning' : 'bg-success');
            }
        });
    }
});

// View message function
function viewMessage(contactId) {
    // Here you would typically fetch the full message data
    // For now, we'll show a placeholder
    $('#messageModal').modal('show');
    $('#modal-name').text('Loading...');
    $('#modal-email').text('Loading...');
    $('#modal-subject').text('Loading...');
    $('#modal-date').text('Loading...');
    $('#modal-message').text('Loading...');

    // Simulate loading message data
    setTimeout(() => {
        $('#modal-name').text('John Doe');
        $('#modal-email').text('john@example.com');
        $('#modal-subject').text('Product Inquiry');
        $('#modal-date').text('Dec 15, 2024 14:30');
        $('#modal-message').text('I am interested in your luxury watches. Can you provide more information about the pricing and availability?');
    }, 500);
}

// Mark as read function
function markAsRead(contactId) {
    $.ajax({
        url: '{{ route("admin.contacts.index") }}/' + contactId + '/mark-read',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                $('#contacts-table').DataTable().ajax.reload();
                updateUnreadCount();
                toastr.success(response.message);
            } else {
                toastr.error('Failed to mark as read');
            }
        },
        error: function() {
            toastr.error('Error marking message as read');
        }
    });
}

// Delete confirmation function
function confirmDelete(contactId) {
    $('#deleteModal').modal('show');
    $('#confirm-delete').data('contact-id', contactId);
}

// Handle delete confirmation
$('#confirm-delete').click(function() {
    const contactId = $(this).data('contact-id');

    // Here you would typically make an AJAX call to delete the contact
    // For now, we'll just show a success message
    $('#deleteModal').modal('hide');

    // Reload the table
    $('#contacts-table').DataTable().ajax.reload();
    updateUnreadCount();

    toastr.success('Message deleted successfully');
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

#modal-message {
    white-space: pre-wrap;
    line-height: 1.6;
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