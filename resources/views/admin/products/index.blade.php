<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold mb-0">Products</h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            + New Product
        </a>
    </div>

    {{-- Search & filters --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.products.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-medium">Search</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Title, description..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-medium">Category</label>
                        <select name="category" class="form-select">
                            <option value="">All</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">Filter</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Products table --}}
    <div class="card shadow-sm">
        @if ($products->isEmpty())
            <div class="card-body text-center py-5">
                <p class="text-muted mb-0">No products found.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th class="text-end">Price</th>
                            <th class="text-center">Stock</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    @if ($product->image)
                                        @php
                                            $isExternal = filter_var($product->image, FILTER_VALIDATE_URL);
                                            $imageUrl = $isExternal ? $product->image : (str_starts_with($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image));
                                        @endphp
                                        <img src="{{ $imageUrl }}"
                                             alt="{{ $product->title }}"
                                             class="rounded"
                                             style="width: 48px; height: 48px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted"
                                             style="width: 48px; height: 48px; font-size: 0.7rem;">
                                            N/A
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-medium">{{ $product->title }}</td>
                                <td class="small">{{ $product->category?->name ?? '-' }}</td>
                                <td class="text-end">{{ number_format($product->price, 2) }} €</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $product->stock > 5 ? 'success' : ($product->stock > 0 ? 'warning text-dark' : 'danger') }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td>
                                    @if ($product->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                          class="d-inline" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} product(s)
                    </small>
                    {{ $products->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layouts.admin>
