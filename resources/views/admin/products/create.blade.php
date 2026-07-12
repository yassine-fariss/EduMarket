<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold mb-0">New Product</h4>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    @include('admin.products.form')
</x-layouts.admin>
