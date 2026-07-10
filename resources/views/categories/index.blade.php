<x-customer-layout title="Catégories">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active">Catégories</li>
            </ol>
        </nav>

        <div class="text-center mb-5">
            <h2 class="fw-bold section-title section-title-center">Nos catégories</h2>
            <p class="text-muted">Explorez notre large gamme de produits par catégorie</p>
        </div>

        <div class="row g-4">
            @php
                $catIcons = ['bi-book', 'bi-mortarboard-fill', 'bi-pencil', 'bi-calculator-fill', 'bi-brush', 'bi-cpu', 'bi-boxes', 'bi-flask', 'bi-translate', 'bi-palette', 'bi-scissors', 'bi-rulers'];
                $catColors = ['#2563EB', '#7C3AED', '#DC2626', '#059669', '#D97706', '#0891B2', '#4F46E5', '#16A34A', '#CA8A04', '#DB2777', '#0D9488', '#9333EA'];
            @endphp
            @foreach ($categories as $i => $category)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="category-card p-4 text-center">
                        <div class="cat-icon mx-auto" style="background: {{ $catColors[$i % count($catColors)] }}15; color: {{ $catColors[$i % count($catColors)] }};">
                            <i class="{{ $catIcons[$i % count($catIcons)] }}"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">{{ $category->name }}</h5>
                        <p class="small text-muted mb-2">{{ $category->products_count }} produit(s)</p>
                        @if ($category->description)
                            <p class="small text-muted mb-0">{{ Str::limit($category->description, 80) }}</p>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-customer-layout>
