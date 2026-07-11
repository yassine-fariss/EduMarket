<x-customer-layout title="Panier">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active">Panier</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">Mon panier</h2>
                @if ($items->isNotEmpty())
                    <p class="text-muted small mb-0">{{ $items->sum('quantity') }} article(s)</p>
                @endif
            </div>
            @if ($items->isNotEmpty())
                <button type="button" class="btn btn-outline-danger rounded-pill btn-sm" data-ajax-clear>
                    <i class="bi bi-trash me-1"></i>Vider le panier
                </button>
            @endif
        </div>

        @if ($items->isEmpty())
            <div class="card-modern bg-white text-center py-5">
                <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                <p class="text-muted mb-3 mt-3">Votre panier est vide.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-bag me-2"></i>Découvrir nos produits
                </a>
            </div>
        @else
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card-modern bg-white">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 cart-table" id="cart-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produit</th>
                                        <th class="text-center">Prix</th>
                                        <th class="text-center">Quantité</th>
                                        <th class="text-end">Sous-total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr data-product-id="{{ $item['product_id'] }}">
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @php
                                                    $isExternal = filter_var($item['image'] ?? '', FILTER_VALIDATE_URL);
                                                    $imgSrc = $isExternal ? $item['image'] : (str_starts_with($item['image'] ?? '', 'images/') ? asset($item['image']) : asset('storage/' . $item['image']));
                                                    @endphp
                                                    @if ($item['image'])
                                                        <img src="{{ $imgSrc }}" alt="{{ $item['title'] }}"
                                                             class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted"
                                                             style="width: 50px; height: 50px; font-size: 0.7rem;">N/A</div>
                                                    @endif
                                                    <a href="{{ route('shop.show', $item['slug']) }}" class="text-decoration-none text-dark fw-medium">
                                                        {{ $item['title'] }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ number_format($item['price'], 2) }} €</td>
                                            <td class="text-center" style="width: 140px;">
                                                <form class="cart-qty-form d-flex align-items-center justify-content-center gap-1" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">

                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-secondary rounded-circle qty-down"
                                                            data-product-id="{{ $item['product_id'] }}"
                                                            aria-label="Diminuer"
                                                            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                        <i class="bi bi-dash"></i>
                                                    </button>

                                                    <input type="number" name="quantity"
                                                           class="form-control form-control-sm text-center cart-qty-input fw-bold"
                                                           style="width: 50px;"
                                                           value="{{ $item['quantity'] }}"
                                                           min="1" max="{{ $item['stock'] }}"
                                                           data-product-id="{{ $item['product_id'] }}"
                                                           data-max="{{ $item['stock'] }}">

                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-secondary rounded-circle qty-up"
                                                            data-product-id="{{ $item['product_id'] }}"
                                                            aria-label="Augmenter"
                                                            {{ $item['quantity'] >= $item['stock'] ? 'disabled' : '' }}>
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-end fw-medium cart-subtotal">
                                                {{ number_format($item['price'] * $item['quantity'], 2) }} €
                                            </td>
                                            <td class="text-end">
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger rounded-circle"
                                                        data-ajax-remove
                                                        data-product-id="{{ $item['product_id'] }}"
                                                        aria-label="Retirer">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card-modern bg-white">
                        <div class="p-3 border-bottom">
                            <h5 class="fw-bold mb-0"><i class="bi bi-receipt me-2 text-primary"></i>Résumé</h5>
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Articles</span>
                                <span class="fw-medium" id="cart-count">{{ $items->sum('quantity') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Livraison</span>
                                <span class="text-muted small">Calculée à la commande</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold h5 mb-0">Total</span>
                                <span class="fw-bold h5 mb-0" id="cart-total" style="color: var(--primary);">
                                    {{ number_format($items->sum(fn ($i) => $i['price'] * $i['quantity']), 2) }} €
                                </span>
                            </div>
                            @auth
                                <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 rounded-pill">
                                    <i class="bi bi-box-seam me-2"></i>Commander
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary w-100 rounded-pill">
                                    <i class="bi bi-person me-2"></i>Connectez-vous pour commander
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-customer-layout>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('cart-table');
    if (!table) return;

    const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    const updateUrl = '{{ route("cart.update") }}';
    const removeUrl = '{{ route("cart.remove") }}';
    const clearUrl = '{{ route("cart.clear") }}';

    function el(id) { return document.getElementById(id); }
    function showToast(message, type) {
        const toast = el('cart-toast');
        const body = el('cart-toast-body');
        if (!toast || !body) return;
        body.textContent = message;
        toast.className = 'toast align-items-center text-bg-' + type + ' border-0';
        try { bootstrap.Toast.getOrCreateInstance(toast).show(); } catch {}
    }

    function refreshTotals(data) {
        const count = el('cart-count');
        const total = el('cart-total');
        const badge = el('cart-badge');
        if (count) count.textContent = data.cart_count;
        if (total) total.textContent = data.cart_total.toFixed(2) + ' €';
        if (badge) {
            badge.textContent = data.cart_count;
            badge.classList.toggle('d-none', data.cart_count === 0);
        }
    }

    function api(url, body, btn, cb) {
        if (btn) btn.disabled = true;
        fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
            body: JSON.stringify(body),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                refreshTotals(data);
                if (cb) cb(data);
            } else {
                showToast(data.message, 'danger');
                if (btn) btn.disabled = false;
            }
        })
        .catch(() => {
            try { showToast('Erreur réseau.', 'danger'); } catch {}
            if (btn) { btn.disabled = false; btn.innerHTML = btn.dataset.originalHtml; }
        });
    }

    function getInput(pid) { return document.querySelector('.cart-qty-input[data-product-id="' + pid + '"]'); }
    function getRow(pid) { const inp = getInput(pid); return inp ? inp.closest('tr') : null; }
    function setSpin(btn, spin) {
        if (spin) {
            btn.dataset.originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
        } else {
            btn.disabled = false;
            btn.innerHTML = btn.dataset.originalHtml || btn.innerHTML;
        }
    }

    // Quantity UP
    table.addEventListener('click', e => {
        const btn = e.target.closest('.qty-up');
        if (!btn || btn.disabled) return;
        const pid = btn.dataset.productId;
        const input = getInput(pid);
        if (!input) return;
        const max = parseInt(input.dataset.max);
        const val = parseInt(input.value);
        if (val >= max) return;
        const newVal = val + 1;
        setSpin(btn, true);
        api(updateUrl, { product_id: pid, quantity: newVal }, btn, data => {
            input.value = newVal;
            const row = getRow(pid);
            if (row) row.querySelector('.cart-subtotal').textContent = data.subtotal.toFixed(2) + ' €';
            btn.disabled = (newVal >= max);
            btn.innerHTML = '<i class="bi bi-plus"></i>';
            const down = row?.querySelector('.qty-down');
            if (down) down.disabled = (newVal <= 1);
        });
    });

    // Quantity DOWN — if quantity would become 0, remove after confirmation
    table.addEventListener('click', e => {
        const btn = e.target.closest('.qty-down');
        if (!btn || btn.disabled) return;
        const pid = btn.dataset.productId;
        const input = getInput(pid);
        if (!input) return;
        const val = parseInt(input.value);
        if (val <= 1) {
            if (!confirm('Retirer ce produit du panier ?')) return;
            setSpin(btn, true);
            api(removeUrl, { product_id: pid }, btn, () => {
                const row = getRow(pid);
                if (row) row.remove();
                showToast('Produit retiré du panier.', 'success');
                if (document.querySelectorAll('#cart-table tbody tr').length === 0) location.reload();
            });
            return;
        }
        const newVal = val - 1;
        setSpin(btn, true);
        api(updateUrl, { product_id: pid, quantity: newVal }, btn, data => {
            input.value = newVal;
            const row = getRow(pid);
            if (row) row.querySelector('.cart-subtotal').textContent = data.subtotal.toFixed(2) + ' €';
            btn.disabled = (newVal <= 1);
            btn.innerHTML = '<i class="bi bi-dash"></i>';
            const up = row?.querySelector('.qty-up');
            if (up) up.disabled = (newVal >= parseInt(input.dataset.max));
        });
    });

    // Remove product
    table.addEventListener('click', e => {
        const btn = e.target.closest('[data-ajax-remove]');
        if (!btn || btn.disabled) return;
        const pid = btn.dataset.productId;
        if (!confirm('Retirer ce produit du panier ?')) return;
        setSpin(btn, true);
        api(removeUrl, { product_id: pid }, btn, () => {
            const row = getRow(pid);
            if (row) row.remove();
            showToast('Produit retiré du panier.', 'success');
            if (document.querySelectorAll('#cart-table tbody tr').length === 0) location.reload();
        });
    });

    // Direct input change
    table.addEventListener('change', e => {
        const input = e.target.closest('.cart-qty-input');
        if (!input) return;
        const pid = input.dataset.productId;
        const val = parseInt(input.value);
        const max = parseInt(input.dataset.max);
        const clamped = Math.max(1, Math.min(val || 1, max));
        if (clamped !== parseInt(input.value)) input.value = clamped;
        api(updateUrl, { product_id: pid, quantity: clamped }, null, data => {
            const row = getRow(pid);
            if (row) row.querySelector('.cart-subtotal').textContent = data.subtotal.toFixed(2) + ' €';
            const up = row?.querySelector('.qty-up');
            const down = row?.querySelector('.qty-down');
            if (up) up.disabled = (clamped >= max);
            if (down) down.disabled = (clamped <= 1);
        });
    });

    // Clear cart
    document.querySelector('[data-ajax-clear]')?.addEventListener('click', function () {
        if (this.disabled) return;
        if (!confirm('Vider le panier ?')) return;
        setSpin(this, true);
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Vidage...';
        api(clearUrl, {}, this, () => { location.reload(); });
    });
});
</script>
@endpush
