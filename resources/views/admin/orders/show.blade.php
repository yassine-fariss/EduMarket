<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold mb-0">Order #{{ $order->order_number ?? $order->id }}</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.orders.print', $order) }}" target="_blank" class="btn btn-outline-primary">
                Print Invoice
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Order info + status update --}}
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Status</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <select name="status" class="form-select form-select-lg mb-2">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Details</h5>
                </div>
                <div class="card-body small">
                    <dl class="row mb-0">
                        <dt class="col-5 text-muted">Order #</dt>
                        <dd class="col-7">#{{ $order->order_number ?? $order->id }}</dd>

                        <dt class="col-5 text-muted">Date</dt>
                        <dd class="col-7">{{ $order->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-5 text-muted">Payment</dt>
                        <dd class="col-7">
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
                        </dd>

                        <dt class="col-5 text-muted">Subtotal</dt>
                        <dd class="col-7">{{ number_format($order->total, 2) }} €</dd>
                    </dl>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Customer</h5>
                </div>
                <div class="card-body small">
                    <dl class="row mb-0">
                        <dt class="col-5 text-muted">Name</dt>
                        <dd class="col-7">{{ $order->full_name ?? $order->user?->name ?? '-' }}</dd>

                        <dt class="col-5 text-muted">Email</dt>
                        <dd class="col-7">{{ $order->user?->email ?? '-' }}</dd>

                        <dt class="col-5 text-muted">Phone</dt>
                        <dd class="col-7">{{ $order->phone ?? '-' }}</dd>

                        <dt class="col-5 text-muted">Address</dt>
                        <dd class="col-7">{{ $order->shipping_address }}</dd>

                        <dt class="col-5 text-muted">City</dt>
                        <dd class="col-7">{{ $order->city ?? '-' }}</dd>
                    </dl>

                    @if ($order->notes)
                        <hr>
                        <small class="text-muted d-block">Notes</small>
                        <p class="mb-0">{{ $order->notes }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Purchased products --}}
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Ordered Products</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
@if ($item->product?->image)
                                            @php
                                                $imgSrc = str_starts_with($item->product->image, 'http')
                                                    ? $item->product->image
                                                    : (str_starts_with($item->product->image, 'images/')
                                                        ? asset($item->product->image)
                                                        : asset('storage/' . $item->product->image));
                                            @endphp
                                            <img src="{{ $imgSrc }}"
                                                 alt="" class="rounded"
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                            <div>
                                                <span class="fw-medium">{{ $item->product?->title ?? 'Deleted product' }}</span>
                                                <small class="d-block text-muted">SKU: #{{ $item->product_id }}</small>
                                            </div>
                                        </div>
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
                                <td class="text-end fw-bold">{{ number_format($order->total, 2) }} €</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
