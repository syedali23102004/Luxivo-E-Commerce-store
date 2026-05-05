// LUXIVO E-Commerce Complete JavaScript
// Laravel 11 + Bootstrap 5 + jQuery DataTables

(function() {
    'use strict';
    
    // Global CSRF Token
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    // Cart Endpoints
    const CART_ADD = '/cart/add';
    const CART_REMOVE = '/cart/remove';
    const CART_UPDATE = '/cart/update';
    const CART_COUNT = '/cart/count';
    
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. Cart Add to Cart AJAX
        document.querySelectorAll('[data-action="add-to-cart"]').forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                const productId = this.dataset.productId;
                const quantity = parseInt(this.dataset.quantity) || 1;
                
                try {
                    const response = await fetch(CART_ADD, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ product_id: productId, quantity })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        updateCartBadge(data.cart_count || 0);
                        showToast(data.message || 'Added to cart!', 'success');
                    } else {
                        showToast(data.message || 'Failed to add item', 'error');
                    }
                } catch (error) {
                    showToast('Network error. Please try again.', 'error');
                }
            });
        });
        
        // 2. Cart Remove Item AJAX
        document.querySelectorAll('[data-action="remove-from-cart"]').forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                const rowId = this.dataset.rowId;
                
                if (!confirm('Remove this item from cart?')) return;
                
                try {
                    const response = await fetch(CART_REMOVE, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ row_id: rowId })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        this.closest('tr')?.remove();
                        updateCartBadge(data.cart_count || 0);
                        showToast(data.message || 'Item removed!', 'success');
                    } else {
                        showToast(data.message || 'Failed to remove item', 'error');
                    }
                } catch (error) {
                    showToast('Network error. Please try again.', 'error');
                }
            });
        });
        
        // 3. Cart Update Quantity AJAX
        document.querySelectorAll('[data-action="update-cart"]').forEach(input => {
            input.addEventListener('change', async function() {
                const rowId = this.dataset.rowId;
                const quantity = parseInt(this.value) || 1;
                
                if (quantity < 1) {
                    this.value = 1;
                    return;
                }
                
                try {
                    const response = await fetch(CART_UPDATE, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ row_id: rowId, quantity })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        updateCartBadge(data.cart_count || 0);
                        showToast(`Updated to ${quantity} items`, 'success');
                        // Update subtotal if exists
                        const subtotalEl = document.querySelector(`[data-subtotal="${rowId}"]`);
                        if (subtotalEl) subtotalEl.textContent = data.subtotal || '';
                    } else {
                        showToast(data.message || 'Failed to update', 'error');
                        this.value = data.previous_quantity || 1;
                    }
                } catch (error) {
                    showToast('Network error. Please try again.', 'error');
                    this.value = 1;
                }
            });
        });
        
        // 4. Product Quantity Selector (+/- buttons)
        document.querySelectorAll('.qty-plus, .qty-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.closest('.quantity-selector').querySelector('input[type="number"]');
                let value = parseInt(input.value) || 1;
                
                if (this.classList.contains('qty-plus')) {
                    input.value = value + 1;
                } else {
                    input.value = Math.max(1, value - 1);
                }
                
                // Trigger change for auto-save
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });
        });
        
        // 5. Admin Delete Confirmation Modal
        document.querySelectorAll('.delete-confirm').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal') || createDeleteModal());
                window.deleteForm = this;
                
                modal.show();
            });
        });
        
        // 6. Flash/Alert Messages Auto-hide (3s)
        document.querySelectorAll('.alert, .flash-message').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 3000);
        });
        
        // 7. Smooth Scroll for Anchor Links
        document.querySelectorAll('a[href^="#"]:not([data-toggle])').forEach(link => {
            link.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // 8. Mobile Navbar Collapse Helper
        const navbarToggler = document.querySelector('.navbar-toggler');
        if (navbarToggler) {
            navbarToggler.addEventListener('click', function() {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                setTimeout(() => navbarCollapse.classList.toggle('show'), 100);
            });
            
            // Close on outside click
            document.addEventListener('click', function(e) {
if (!e.target.closest('.navbar-toggler') && !e.target.closest('.navbar-nav')) {
                    document.querySelector('.navbar-collapse')?.classList.remove('show');
                }
            });
        }
        
        // 9. Initial Cart Count Load
        loadCartCount();
        
        // 10. Admin DataTables Initialization
        initAdminDataTables();
    });
    
    // Update Cart Badge in Navbar
    function updateCartBadge(count) {
        const badge = document.querySelector('#cart-badge, .cart-count');
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
    }
    
    // Load Initial Cart Count
    async function loadCartCount() {
        try {
            const response = await fetch(CART_COUNT, {
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            updateCartBadge(data.count || 0);
        } catch (error) {
            console.warn('Could not load cart count');
        }
    }
    
    // 11. Toast Notification Function
    window.showToast = function(message, type = 'success') {
        // Remove existing toasts
        document.querySelectorAll('.luxivo-toast').forEach(toast => toast.remove());
        
        const toast = document.createElement('div');
        toast.className = `luxivo-toast position-fixed border-0 rounded-3 shadow-lg p-3 mb-3 bg-${type === 'success' ? 'success' : 'danger'} text-white`;
        toast.style.cssText = `
            top: 1.5rem; right: 1.5rem; 
            min-width: 320px; max-width: 400px; 
            z-index: 1099; backdrop-filter: blur(10px);
        `;
        toast.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <strong class="me-2">${type === 'success' ? 'Success' : 'Error'}</strong>
                <span>${message}</span>
                <button type="button" class="btn-close btn-close-white ms-2" onclick="this.parentElement.parentElement.parentElement.remove()"></button>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 4s
        setTimeout(() => toast.remove(), 4000);
    };
    
    // Create Delete Confirmation Modal (if not exists)
    function createDeleteModal() {
        const modalHtml = `
            <div class="modal fade" id="deleteConfirmModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this item? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        return new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    }
    
    // Admin DataTables with Export Buttons
    function initAdminDataTables() {
        if (typeof $.fn.DataTable === 'undefined') return;
        
        $('.admin-datatable').each(function() {
            $(this).DataTable({
                responsive: true,
                serverSide: false,
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                order: [[0, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-success btn-sm me-2',
                        title: 'LUXIVO_Data_Export'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger btn-sm me-2',
                        title: 'LUXIVO_Data_Export'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info btn-sm',
                        title: 'LUXIVO - Print Data'
                    }
                ],
                language: {
                    search: 'Search records:',
                    lengthMenu: 'Show _MENU_ entries per page',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    infoEmpty: 'No entries available',
                    paginate: {
                        first: 'First',
                        last: 'Last',
                        next: 'Next >',
                        previous: '< Previous'
                    }
                },
                drawCallback: function() {
                    // Re-apply responsive after draw
                    this.api().columns.adjust().responsive.recalc();
                }
            });
        });
    }
    
    // Global Delete Confirm Handler
    document.addEventListener('click', function(e) {
if (e.target.id === 'confirmDeleteBtn' && window.deleteForm) {
            window.deleteForm.submit();
        }
    });
    
    // Polyfill for older browsers
    if (!window.fetch) {
        console.warn('Fetch API not supported - consider updating browser');
    }
    
})();

