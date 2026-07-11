import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('submit', async (e) => {
    const form = e.target;
    if (!form.matches('form[data-ajax-cart]')) return;

    e.preventDefault();

    const button = form.querySelector('button[type="submit"]');
    const originalHtml = button.innerHTML;

    button.disabled = true;
    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span>';

    try {
        const res = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });

        const data = await res.json();

        if (data.success) {
            const badge = document.getElementById('cart-badge');
            if (badge) {
                badge.textContent = data.cart_count;
                badge.classList.toggle('d-none', data.cart_count === 0);
            }
            showCartToast(data.message, 'success');
        } else {
            showCartToast(data.message, 'danger');
        }
    } catch {
        showCartToast('Erreur réseau. Veuillez réessayer.', 'danger');
    } finally {
        button.disabled = false;
        button.innerHTML = originalHtml;
    }
});

function showCartToast(message, type = 'success') {
    const toast = document.getElementById('cart-toast');
    const body = document.getElementById('cart-toast-body');
    if (!toast || !body) return;

    body.textContent = message;
    toast.className = `toast align-items-center text-bg-${type} border-0`;

    const instance = bootstrap.Toast.getOrCreateInstance(toast);
    instance.show();
}
