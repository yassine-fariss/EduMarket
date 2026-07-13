<x-customer-layout>
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($product->title, 40) }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            {{-- Image --}}
            <div class="col-lg-6">
                <div class="card-modern bg-white">
                    <div class="d-flex align-items-center justify-content-center" style="min-height: 420px;">
                        @if ($product->image)
                            @php
                                $isExternal = filter_var($product->image, FILTER_VALIDATE_URL);
                                $imgSrc = $isExternal ? $product->image : (str_starts_with($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image));
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $product->title }}" width="500" height="400" class="img-fluid p-4" style="max-height: 400px; object-fit: contain;">
                        @else
                            <img src="https://placehold.co/500x400/6B7280/FFFFFF?text={{ urlencode($product->title) }}" alt="{{ $product->title }}" width="500" height="400" class="img-fluid p-4">
                        @endif
                    </div>
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-6">
                <span class="category-badge d-inline-block mb-3">{{ $product->category->name }}</span>

                <h1 class="fw-bold mb-3" style="font-size: 1.75rem;">{{ $product->title }}</h1>

                <div class="d-flex align-items-center gap-2 mb-3">
                    @if ($product->stock > 0)
                        <span class="badge bg-success rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i> In Stock</span>
                        <small class="text-muted">{{ $product->stock }} unit(s) available</small>
                    @else
                        <span class="badge bg-danger rounded-pill px-3 py-2"><i class="bi bi-x-circle me-1"></i> Out of Stock</span>
                    @endif
                </div>

                <div class="mb-4">
                    <span class="display-5 fw-bold" style="color: var(--primary);">{{ number_format($product->price, 2) }} €</span>
                    <small class="text-muted ms-2">incl. tax</small>
                </div>

                <hr>

                <h6 class="fw-bold mb-2"><i class="bi bi-card-text me-2 text-primary"></i>Description</h6>
                <p class="text-muted mb-4">{{ $product->description }}</p>

                @if ($product->stock > 0)
                    <form method="POST" action="{{ route('cart.add') }}" class="cart-add-form" data-ajax-cart>
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-auto">
                                <label class="form-label fw-medium small mb-1">Quantity</label>
                                <div class="input-group" style="width: 130px;">
                                    <button type="button" class="btn btn-outline-secondary qty-down" onclick="qtyStep(-1)">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" name="quantity" id="qty-input"
                                           class="form-control text-center fw-bold border-start-0 border-end-0"
                                           value="1" min="1" max="{{ $product->stock }}" style="width: 50px;">
                                    <button type="button" class="btn btn-outline-secondary qty-up" onclick="qtyStep(1)">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">
                                    <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex gap-3 mt-4 pt-3 small text-muted border-top">
                        <span><i class="bi bi-truck me-1"></i> Delivery 2-5 days</span>
                        <span><i class="bi bi-arrow-repeat me-1"></i> 14-day returns</span>
                        <span><i class="bi bi-lock me-1"></i> Secure payment</span>
                    </div>
                @else
                    <button class="btn btn-secondary btn-lg w-100 rounded-pill" disabled>
                        <i class="bi bi-x-circle me-2"></i>Out of Stock
                    </button>
                @endif
            </div>
        </div>

        @if ($related->isNotEmpty())
            <section class="mt-5 pt-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0 section-title">Similar Products</h3>
                    <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="btn btn-outline-primary rounded-pill btn-sm">
                        View all <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="row g-4">
                    @foreach ($related as $rel)
                        <div class="col-6 col-md-3">
                            <x-product-card :product="$rel" />
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    @push('scripts')
    <script>
    function qtyStep(step) {
        const input = document.getElementById('qty-input');
        let val = parseInt(input.value) || 1;
        val += step;
        if (val < 1) val = 1;
        if (val > parseInt(input.max)) val = parseInt(input.max);
        input.value = val;
    }
    </script>
    @endpush
</x-customer-layout>
