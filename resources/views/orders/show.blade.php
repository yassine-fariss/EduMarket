<x-app-layout title="Commande #{{ $order->order_number ?? $order->id }}">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">Commande #{{ $order->order_number ?? $order->id }}</h4>
            <p class="text-muted small mb-0">Détail de votre commande</p>
        </div>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary rounded-pill btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card-modern bg-white">
                <div class="p-3 border-bottom">
                    <h5 class="fw-bold mb-0"><i class="bi bi-box-seam me-2 text-primary"></i>Articles</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produit</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-end">Prix unitaire</th>
                                <th class="text-end">Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('shop.show', $item->product->slug) }}" class="text-decoration-none fw-medium text-dark">
                                            {{ $item->product->title }}
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->price, 2) }} €</td>
                                    <td class="text-end fw-medium">{{ number_format($item->subtotal, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total</td>
                                <td class="text-end fw-bold fs-5" style="color: var(--primary);">{{ number_format($order->total, 2) }} €</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-modern bg-white mb-4">
                <div class="p-3 border-bottom">
                    <h5 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Détails</h5>
                </div>
                <div class="p-4">
                    <dl class="row mb-0 small">
                        <dt class="col-sm-5 text-muted">Statut</dt>
                        <dd class="col-sm-7">
                            @php
                                $badge = match ($order->status) {
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary',
                                };
                                $label = match ($order->status) {
                                    'pending' => 'En attente',
                                    'processing' => 'En cours',
                                    'completed' => 'Terminée',
                                    'cancelled' => 'Annulée',
                                    default => $order->status,
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }} rounded-pill">{{ $label }}</span>
                        </dd>
                        <dt class="col-sm-5 text-muted">Date</dt>
                        <dd class="col-sm-7">{{ $order->created_at->format('d/m/Y H:i') }}</dd>
                        <dt class="col-sm-5 text-muted">Paiement</dt>
                        <dd class="col-sm-7">
                            @php
                                $pmLabel = match ($order->payment_method) {
                                    'cash_on_delivery' => 'Paiement à la livraison',
                                    'credit_card' => 'Carte bancaire',
                                    'paypal' => 'PayPal',
                                    'bank_transfer' => 'Virement bancaire',
                                    default => $order->payment_method,
                                };
                            @endphp
                            {{ $pmLabel }}
                        </dd>
                        <dt class="col-sm-5 text-muted">Client</dt>
                        <dd class="col-sm-7">{{ $order->full_name ?? $order->user->name }}</dd>
                        <dt class="col-sm-5 text-muted">Téléphone</dt>
                        <dd class="col-sm-7">{{ $order->phone }}</dd>
                        <dt class="col-sm-5 text-muted">Ville</dt>
                        <dd class="col-sm-7">{{ $order->city }}</dd>
                    </dl>
                    @if ($order->notes)
                        <div class="mt-2">
                            <small class="text-muted d-block">Notes</small>
                            <p class="small mb-0">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card-modern bg-white">
                <div class="p-3 border-bottom">
                    <h5 class="fw-bold mb-0"><i class="bi bi-geo-alt me-2 text-primary"></i>Adresse de livraison</h5>
                </div>
                <div class="p-4">
                    <p class="small mb-0">
                        {{ $order->shipping_address }}<br>
                        {{ $order->city }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
