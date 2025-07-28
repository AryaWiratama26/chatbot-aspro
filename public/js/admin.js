$(document).ready(function() {
    // Set CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Confirm delete actions
    $('.btn-danger').on('click', function(e) {
        if ($(this).closest('form').length > 0) {
            e.preventDefault();
            const form = $(this).closest('form');
            
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                form.submit();
            }
        }
    });

    // Form validation enhancements
    $('form').on('submit', function() {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.addClass('loading').prop('disabled', true);
        
        // Re-enable button after 3 seconds (in case of error)
        setTimeout(function() {
            submitBtn.removeClass('loading').prop('disabled', false);
        }, 3000);
    });

    // Auto-resize textareas
    $('textarea').each(function() {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Character counter for textareas
    $('textarea').each(function() {
        const maxLength = $(this).attr('maxlength');
        if (maxLength) {
            const counter = $(`<small class="form-text text-muted char-counter">0/${maxLength} karakter</small>`);
            $(this).after(counter);
            
            $(this).on('input', function() {
                const currentLength = $(this).val().length;
                counter.text(`${currentLength}/${maxLength} karakter`);
                
                if (currentLength > maxLength * 0.9) {
                    counter.removeClass('text-muted').addClass('text-warning');
                } else {
                    counter.removeClass('text-warning').addClass('text-muted');
                }
            });
        }
    });

    // Enhanced table sorting (if needed)
    $('.table th').on('click', function() {
        if ($(this).data('sortable') !== false) {
            // Add sorting functionality here if needed
        }
    });

    // Search functionality for tables
    $('.table-search').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        const table = $(this).data('table');
        
        $(`${table} tbody tr`).filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Tooltip initialization
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Sidebar toggle for mobile
    $('#sidebarToggle').on('click', function() {
        $('.sidebar').toggleClass('show');
    });

    // Close sidebar on mobile when clicking outside
    $(document).on('click', function(e) {
        if ($(window).width() <= 767.98) {
            if (!$(e.target).closest('.sidebar, #sidebarToggle').length) {
                $('.sidebar').removeClass('show');
            }
        }
    });
});

// Function to show loading state
function showLoading(element) {
    $(element).addClass('loading').prop('disabled', true);
}

// Function to hide loading state
function hideLoading(element) {
    $(element).removeClass('loading').prop('disabled', false);
}

// Function to show toast notification
function showToast(message, type = 'success') {
    const toastHtml = `
        <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
    
    // Create toast container if it doesn't exist
    if (!$('#toast-container').length) {
        $('body').append('<div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3"></div>');
    }
    
    const $toast = $(toastHtml);
    $('#toast-container').append($toast);
    
    const toast = new bootstrap.Toast($toast[0]);
    toast.show();
    
    // Remove toast element after it's hidden
    $toast.on('hidden.bs.toast', function() {
        $(this).remove();
    });
}

// Function to format numbers
function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

// Function to format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Function to copy text to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        showToast('Teks berhasil disalin ke clipboard');
    }, function(err) {
        console.error('Could not copy text: ', err);
        showToast('Gagal menyalin teks', 'danger');
    });
}

// Function to validate form fields
function validateForm(formSelector) {
    let isValid = true;
    const $form = $(formSelector);
    
    $form.find('input[required], textarea[required], select[required]').each(function() {
        const $field = $(this);
        const value = $field.val().trim();
        
        if (!value) {
            $field.addClass('is-invalid');
            isValid = false;
        } else {
            $field.removeClass('is-invalid');
        }
    });
    
    return isValid;
}

// Function to reset form
function resetForm(formSelector) {
    const $form = $(formSelector);
    $form[0].reset();
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.char-counter').text('0/0 karakter');
}

// Function to handle AJAX errors
function handleAjaxError(xhr, textStatus, errorThrown) {
    let message = 'Terjadi kesalahan yang tidak diketahui';
    
    if (xhr.status === 422) {
        // Validation errors
        const errors = xhr.responseJSON.errors;
        message = Object.values(errors).flat().join('<br>');
    } else if (xhr.status === 500) {
        message = 'Terjadi kesalahan server. Silakan coba lagi nanti.';
    } else if (xhr.status === 404) {
        message = 'Halaman atau resource tidak ditemukan.';
    } else if (xhr.status === 403) {
        message = 'Anda tidak memiliki izin untuk melakukan tindakan ini.';
    }
    
    showToast(message, 'danger');
}

// Export functions for global use
window.showLoading = showLoading;
window.hideLoading = hideLoading;
window.showToast = showToast;
window.formatNumber = formatNumber;
window.formatDate = formatDate;
window.copyToClipboard = copyToClipboard;
window.validateForm = validateForm;
window.resetForm = resetForm;
window.handleAjaxError = handleAjaxError;