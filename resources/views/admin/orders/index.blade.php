<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold mb-0">Orders</h4>
    </div>

    {{-- Filters --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.orders.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-medium">Search</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Order #, customer..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">From</label>
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">To</label>
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">Filter</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Orders table --}}
    <div class="card shadow-sm">
        @if ($orders->isEmpty())
            <div class="card-body text-center py-5">
                <p class="text-muted mb-0">No orders found.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="fw-medium">#{{ $order->order_number ?? $order->id }}</td>
                                <td class="small">{{ $order->full_name ?? $order->user?->name ?? '-' }}</td>
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
                                            'pending' => 'Pending',
                                            'processing' => 'Processing',
                                            'completed' => 'Completed',
                                            'cancelled' => 'Cancelled',
                                            default => $order->status,
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ $label }}</span>
                                </td>
                                <td class="small">
                                    @php
                                        $pmLabel = match ($order->payment_method) {
                                            'cash_on_delivery' => 'Cash on Delivery',
                                            'credit_card' => 'Credit Card',
                                            'paypal' => 'PayPal',
                                            'bank_transfer' => 'Bank Transfer',
                                            default => $order->payment_method,
                                        };
                                    @endphp
                                    {{ $pmLabel }}
                                </td>
                                <td class="small">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="btn btn-sm btn-outline-primary">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        {{ $orders->firstItem() }}-{{ $orders->lastItem() }} of {{ $orders->total() }} order(s)
                    </small>
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layouts.admin>
