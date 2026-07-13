@props(['product'])

<div class="product-card">
    <a href="{{ route('shop.show', $product->slug) }}" class="text-decoration-none">
        <div class="card-img-wrapper">
@if ($product->image)
            @php
                $isExternal = filter_var($product->image, FILTER_VALIDATE_URL);
                $imgSrc = $isExternal ? $product->image : (str_starts_with($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image));
            @endphp
            <img src="{{ $imgSrc }}" alt="{{ $product->title }}" width="400" height="300" class="card-img-top" loading="lazy">
        @else
                <img src="https://placehold.co/400x300/6B7280/FFFFFF?text={{ urlencode($product->title) }}" alt="{{ $product->title }}" width="400" height="300" class="card-img-top" loading="lazy">
            @endif
        </div>
    </a>
    <div class="card-body d-flex flex-column">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="category-badge text-decoration-none">
                {{ $product->category->name }}
            </a>
            @if ($product->stock > 0)
                <span class="stock-badge bg-success bg-opacity-10 text-success">In Stock</span>
            @else
                <span class="stock-badge bg-danger bg-opacity-10 text-danger">Out of Stock</span>
            @endif
        </div>

        <h6 class="product-title">
            <a href="{{ route('shop.show', $product->slug) }}">
                {{ \Illuminate\Support\Str::limit($product->title, 50) }}
            </a>
        </h6>

        <div class="mt-auto">
            <div class="product-price">{{ number_format($product->price, 2) }} €</div>
            <div class="card-actions">
                <a href="{{ route('shop.show', $product->slug) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye me-1"></i> Details
                </a>
                @if ($product->stock > 0)
                    <form method="POST" action="{{ route('cart.add') }}" class="d-flex flex-grow-1" data-ajax-cart>
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-cart-plus me-1"></i> Add
                        </button>
                    </form>
                @else
                    <button class="btn btn-secondary btn-sm w-100" disabled>
                        <i class="bi bi-x-circle me-1"></i> Unavailable
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
