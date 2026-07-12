<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold mb-0">Edit: {{ $category->name }}</h4>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    @include('admin.categories.form')
</x-layouts.admin>
