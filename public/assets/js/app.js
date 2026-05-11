document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    });

    const forms = document.querySelectorAll('form[data-confirm]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm(form.dataset.confirm)) {
                e.preventDefault();
            }
        });
    });
});