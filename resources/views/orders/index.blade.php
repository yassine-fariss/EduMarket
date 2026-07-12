<x-app-layout title="My Orders">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">My Orders</h4>
            <p class="text-muted small mb-0">Your purchase history</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Dashboard
        </a>
    </div>

    @if ($orders->isEmpty())
        <div class="card-modern bg-white text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
            <p class="text-muted mb-3 mt-3">You haven't placed any orders yet.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill">Browse the shop</a>
        </div>
    @else
        <div class="card-modern bg-white">
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
                        @foreach ($orders as $order)
                            <tr>
                                <td class="fw-medium">#{{ $order->order_number ?? $order->id }}</td>
                                <td class="small">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $order->items_count }}</td>
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
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</x-app-layout>
