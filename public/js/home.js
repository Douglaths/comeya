document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filterForm');
    const searchInput = document.querySelector('input[name="search"]');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    
    // Auto-submit form when checkboxes change
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            form.submit();
        });
    });

    // Submit form on Enter key in search input
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                form.submit();
            }
        });
    }

    // Clear filters button functionality
    const clearBtn = document.getElementById('clearFilters');
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            form.submit();
        });
    }
});