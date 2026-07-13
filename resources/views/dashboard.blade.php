<x-app-layout title="Dashboard">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h4 class="fw-bold mb-0">Dashboard</h4>
            <p class="text-muted small mb-0">Welcome, {{ $user->name }}</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary rounded-pill btn-sm">
                <i class="bi bi-gear me-1"></i>My Profile
            </a>
        </div>
    </div>

    <div class="stat-card d-flex align-items-center gap-3 mb-4">
        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
             style="width: 56px; height: 56px; font-size: 1.3rem; flex-shrink: 0;">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
            <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
            <p class="text-muted small mb-0">
                <i class="bi bi-calendar3 me-1"></i> Member since {{ $user->created_at->format('F d, Y') }}
            </p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="stat-icon" style="background: #2563EB15;">
                        <i class="bi bi-box-seam text-primary"></i>
                    </div>
                    <div>
                        <p class="fs-4 fw-bold text-primary mb-0">{{ $stats['total'] }}</p>
                    </div>
                </div>
                <p class="small text-muted mb-0">Total Orders</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="stat-icon" style="background: #F59E0B15;">
                        <i class="bi bi-hourglass-split text-accent"></i>
                    </div>
                    <p class="fs-4 fw-bold text-accent mb-0">{{ $stats['pending'] }}</p>
                </div>
                <p class="small text-muted mb-0">Pending</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="stat-icon" style="background: #0891B215;">
                        <i class="bi bi-arrow-repeat text-info"></i>
                    </div>
                    <p class="fs-4 fw-bold text-info mb-0">{{ $stats['processing'] }}</p>
                </div>
                <p class="small text-muted mb-0">Processing</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="stat-icon" style="background: #22C55E15;">
                        <i class="bi bi-check-circle text-success"></i>
                    </div>
                    <p class="fs-4 fw-bold text-success mb-0">{{ $stats['completed'] }}</p>
                </div>
                <p class="small text-muted mb-0">Completed</p>
            </div>
        </div>
        <div class="col-6 col-md">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="stat-icon" style="background: #DC262615;">
                        <i class="bi bi-x-circle text-danger"></i>
                    </div>
                    <p class="fs-4 fw-bold text-danger mb-0">{{ $stats['cancelled'] }}</p>
                </div>
                <p class="small text-muted mb-0">Cancelled</p>
            </div>
        </div>
    </div>

    <div class="card-modern bg-white">
        <div class="p-3 d-flex align-items-center justify-content-between border-bottom">
            <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Recent Orders</h5>
            @if ($stats['total'] > 0)
                <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
            @endif
        </div>
        @if ($recentOrders->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-2 mb-3">You haven't placed any orders yet.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill">Browse the shop</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentOrders as $order)
                            <tr>
                                <td class="fw-medium">#{{ $order->order_number ?? $order->id }}</td>
                                <td class="small">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>{{ $order->total_qty }}</td>
                                <td class="fw-medium">{{ number_format($order->total, 2) }} €</td>
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
                                            'pending' => 'Pending',
                                            'processing' => 'Processing',
                                            'completed' => 'Completed',
                                            'cancelled' => 'Cancelled',
                                            default => $order->status,
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge }} rounded-pill">{{ $label }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        Details <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
