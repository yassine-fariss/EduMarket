<x-customer-layout title="Order confirmed">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <div class="mb-3">
                        <span class="display-4 text-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                    </div>
                    <h2 class="fw-bold">Order Confirmed!</h2>
                    <p class="text-muted">Thank you for your order. You will receive a confirmation email shortly.</p>
                </div>

                <div class="card-modern bg-white mb-4">
                    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0"><i class="bi bi-receipt me-2 text-primary"></i>Order #{{ $order->order_number }}</h5>
                        <span class="badge bg-warning rounded-pill">Pending</span>
                    </div>
                    <div class="p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <small class="text-muted d-block"><i class="bi bi-calendar me-1"></i> Date</small>
                                <span class="fw-medium">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted d-block"><i class="bi bi-credit-card me-1"></i> Payment</small>
                                <span class="fw-medium">Cash on Delivery</span>
                            </div>
                            <div class="col-12">
                                <small class="text-muted d-block"><i class="bi bi-geo-alt me-1"></i> Shipping Address</small>
                                <span>
                                    {{ $order->full_name }}<br>
                                    {{ $order->shipping_address }}<br>
                                    {{ $order->city }}<br>
                                    {{ $order->phone }}
                                </span>
                            </div>
                            @if ($order->notes)
                                <div class="col-12">
                                    <small class="text-muted d-block"><i class="bi bi-chat me-1"></i> Notes</small>
                                    <span>{{ $order->notes }}</span>
                                </div>
                            @endif
                        </div>

                        <h6 class="fw-bold mb-3">Ordered Items</h6>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Price</th>
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
                                                            $isExternal = filter_var($item->product->image, FILTER_VALIDATE_URL);
                                                            $imgSrc = $isExternal ? $item->product->image : (str_starts_with($item->product->image, 'images/') ? asset($item->product->image) : asset('storage/' . $item->product->image));
                                                        @endphp
                                                        <img src="{{ $imgSrc }}" alt="{{ $item->product->title }}"
                                                             class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                                    @endif
                                                    {{ $item->product->title }}
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
                                        <td class="text-end fw-bold fs-5" style="color: var(--primary);">{{ number_format($order->total, 2) }} €</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-center d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-bag me-2"></i>Continue Shopping
                    </a>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-eye me-2"></i>View Details
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
