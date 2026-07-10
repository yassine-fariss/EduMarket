<x-layouts.admin>
    <h4 class="fw-bold mb-4">Tableau de bord</h4>

    {{-- Stats cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#0d6efd" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                    </div>
                    <div>
                        <p class="fs-4 fw-bold mb-0">{{ $stats['products'] }}</p>
                        <p class="small text-muted mb-0">Produits</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#198754" viewBox="0 0 16 16"><path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/></svg>
                    </div>
                    <div>
                        <p class="fs-4 fw-bold mb-0">{{ $stats['categories'] }}</p>
                        <p class="small text-muted mb-0">Catégories</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-info bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#0dcaf0" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/></svg>
                    </div>
                    <div>
                        <p class="fs-4 fw-bold mb-0">{{ $stats['customers'] }}</p>
                        <p class="small text-muted mb-0">Clients</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#ffc107" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
                    </div>
                    <div>
                        <p class="fs-4 fw-bold mb-0">{{ $stats['orders'] }}</p>
                        <p class="small text-muted mb-0">Commandes</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#198754" viewBox="0 0 16 16"><path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/></svg>
                    </div>
                    <div>
                        <p class="fs-4 fw-bold mb-0">{{ number_format($stats['revenue'], 2) }} €</p>
                        <p class="small text-muted mb-0">Revenu total</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        {{-- Monthly sales chart --}}
        <div class="col-lg-7">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Ventes mensuelles (12 mois)</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="220"></canvas>
                </div>
            </div>
        </div>

        {{-- Most sold products --}}
        <div class="col-lg-5">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Produits les plus vendus</h5>
                </div>
                @if ($mostSold->isEmpty())
                    <div class="card-body text-center py-5">
                        <p class="text-muted mb-0">Aucune vente pour le moment.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Qté</th>
                                    <th class="text-end">CA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mostSold as $item)
                                    <tr>
                                        <td class="small text-truncate" style="max-width: 200px;">
                                            <div class="fw-medium text-truncate">{{ $item->product?->title ?? 'Supprimé' }}</div>
                                            <div class="text-muted" style="font-size: 0.7rem;">{{ $item->product?->category?->name ?? '' }}</div>
                                        </td>
                                        <td class="text-center fw-medium">{{ $item->total_qty }}</td>
                                        <td class="text-end small">{{ number_format($item->total_revenue, 2) }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Recent orders --}}
        <div class="col-lg-7">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0">Commandes récentes</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                </div>
                @if ($recentOrders->isEmpty())
                    <div class="card-body text-center py-5">
                        <p class="text-muted mb-0">Aucune commande pour le moment.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>N°</th>
                                    <th>Client</th>
                                    <th>Total</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <td class="fw-medium">#{{ $order->order_number ?? $order->id }}</td>
                                        <td class="small">{{ $order->user?->name ?? $order->full_name }}</td>
                                        <td>{{ number_format($order->total, 2) }} €</td>
                                        <td>
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
                                            <span class="badge bg-{{ $badge }}">{{ $label }}</span>
                                        </td>
                                        <td class="small">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Low stock products --}}
        <div class="col-lg-5">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold mb-0">Stock faible</h5>
                    <span class="badge bg-danger">{{ $lowStockProducts->count() }}</span>
                </div>
                @if ($lowStockProducts->isEmpty())
                    <div class="card-body text-center py-5">
                        <p class="text-muted mb-0">Tous les stocks sont suffisants.</p>
                    </div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach ($lowStockProducts as $product)
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="small text-truncate me-2">
                                    <div class="fw-medium text-truncate">{{ $product->title }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">
                                        {{ $product->category?->name ?? 'Sans catégorie' }}
                                    </div>
                                </div>
                                <span class="badge bg-{{ $product->stock === 0 ? 'danger' : ($product->stock < 3 ? 'warning text-dark' : 'secondary') }} flex-shrink-0">
                                    {{ $product->stock }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-footer bg-white">
                        <a href="{{ route('admin.products.index', ['status' => 'active']) }}" class="btn btn-sm btn-outline-primary w-100">Gérer les stocks</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Chiffre d\'affaires (€)',
                data: @json($totals),
                backgroundColor: 'rgba(13, 110, 253, 0.6)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1,
                borderRadius: 4,
                yAxisID: 'y',
            }, {
                label: 'Commandes',
                data: @json($counts),
                backgroundColor: 'rgba(25, 135, 84, 0.6)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 1,
                borderRadius: 4,
                yAxisID: 'y1',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: { boxWidth: 12, padding: 12, font: { size: 11 } }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    position: 'left',
                    ticks: { callback: v => v + ' €', font: { size: 10 } }
                },
                y1: {
                    beginAtZero: true,
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    ticks: { precision: 0, font: { size: 10 } }
                }
            }
        }
    });
    </script>
    @endpush
</x-layouts.admin>
