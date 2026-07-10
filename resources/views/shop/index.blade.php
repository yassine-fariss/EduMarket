<x-customer-layout title="Boutique">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active">Boutique</li>
            </ol>
        </nav>

        {{-- Active filters --}}
        @php
            $hasFilters = request()->filled(['search', 'category', 'sort', 'min_price', 'max_price']) || request()->boolean('in_stock');
        @endphp

        @if ($hasFilters)
            <div class="mb-3 d-flex flex-wrap gap-2 align-items-center">
                <small class="text-muted fw-medium me-1">Filtres actifs :</small>

                @if (request('search'))
                    <span class="badge bg-primary rounded-pill d-inline-flex align-items-center gap-1">
                        Recherche : "{{ request('search') }}"
                        <a href="{{ route('shop.index', array_merge(request()->except(['search', 'page']))) }}" class="text-white text-decoration-none ms-1" aria-label="Retirer le filtre recherche">&times;</a>
                    </span>
                @endif

                @if (request('category'))
                    <span class="badge bg-primary rounded-pill d-inline-flex align-items-center gap-1">
                        Catégorie : {{ $activeCategory ?? request('category') }}
                        <a href="{{ route('shop.index', array_merge(request()->except(['category', 'page']))) }}" class="text-white text-decoration-none ms-1" aria-label="Retirer le filtre catégorie">&times;</a>
                    </span>
                @endif

                @if (request('min_price') || request('max_price'))
                    <span class="badge bg-primary rounded-pill d-inline-flex align-items-center gap-1">
                        Prix : @if (request('min_price')) {{ number_format((float) request('min_price'), 2) }} € @else 0 € @endif
                        -
                        @if (request('max_price')) {{ number_format((float) request('max_price'), 2) }} € @else ∞ @endif
                        <a href="{{ route('shop.index', array_merge(request()->except(['min_price', 'max_price', 'page']))) }}" class="text-white text-decoration-none ms-1" aria-label="Retirer le filtre prix">&times;</a>
                    </span>
                @endif

                @if (request()->boolean('in_stock'))
                    <span class="badge bg-primary rounded-pill d-inline-flex align-items-center gap-1">
                        En stock uniquement
                        <a href="{{ route('shop.index', array_merge(request()->except(['in_stock', 'page']))) }}" class="text-white text-decoration-none ms-1" aria-label="Retirer le filtre stock">&times;</a>
                    </span>
                @endif

                @if (request('sort'))
                    <span class="badge bg-secondary rounded-pill d-inline-flex align-items-center gap-1">
                        Tri : {{ match (request('sort')) { 'oldest' => 'Plus anciens', 'price_asc' => 'Prix croissant', 'price_desc' => 'Prix décroissant', default => 'Plus récents' } }}
                        <a href="{{ route('shop.index', array_merge(request()->except(['sort', 'page']))) }}" class="text-white text-decoration-none ms-1">&times;</a>
                    </span>
                @endif

                <a href="{{ route('shop.index') }}" class="badge bg-danger text-decoration-none rounded-pill">Tout effacer</a>
            </div>
        @endif

        <div class="row g-4">
            {{-- Sidebar filters --}}
            <div class="col-lg-3">
                <div class="card-modern bg-white">
                    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0"><i class="bi bi-funnel me-1 text-primary"></i>Filtres</h6>
                        <a href="{{ route('shop.index') }}" class="small text-decoration-none">Réinitialiser</a>
                    </div>
                    <div class="p-3">
                        <form method="GET" action="{{ route('shop.index') }}">
                            @if (request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif

                            <div class="mb-3">
                                <label class="form-label small fw-medium text-muted">Catégorie</label>
                                <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">Toutes les catégories</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-medium text-muted">Prix</label>
                                <div class="row g-1">
                                    <div class="col-6">
                                        <input type="number" name="min_price" class="form-control form-control-sm"
                                               placeholder="Min" min="0" step="0.01" value="{{ request('min_price') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max_price" class="form-control form-control-sm"
                                               placeholder="Max" min="0" step="0.01" value="{{ request('max_price') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="hidden" name="in_stock" value="0">
                                <input type="checkbox" name="in_stock" class="form-check-input" id="inStock"
                                       value="1" {{ request()->boolean('in_stock') ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                <label class="form-check-label small" for="inStock">En stock uniquement</label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-medium text-muted">Trier par</label>
                                <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Plus récents</option>
                                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm w-100 rounded-pill">
                                <i class="bi bi-funnel me-1"></i>Appliquer les filtres
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Products grid --}}
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-3 mt-1">
                    <p class="text-muted small mb-0">
                        @if (request('search'))
                            Résultats pour <strong>"{{ request('search') }}"</strong> —
                        @endif
                        <strong>{{ $products->total() }}</strong> produit(s)
                    </p>
                    <select class="form-select form-select-sm w-auto rounded-pill" onchange="window.location.href=this.value">
                        <option value="{{ route('shop.index', array_merge(request()->except('per_page'), ['per_page' => 12])) }}" {{ request('per_page', 12) == 12 ? 'selected' : '' }}>12 par page</option>
                        <option value="{{ route('shop.index', array_merge(request()->except('per_page'), ['per_page' => 24])) }}" {{ request('per_page') == 24 ? 'selected' : '' }}>24 par page</option>
                        <option value="{{ route('shop.index', array_merge(request()->except('per_page'), ['per_page' => 48])) }}" {{ request('per_page') == 48 ? 'selected' : '' }}>48 par page</option>
                    </select>
                </div>

                @if ($products->isEmpty())
                    <div class="card-modern bg-white text-center py-5">
                        <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mb-2 mt-3">Aucun produit trouvé.</p>
                        <p class="small text-muted mb-3">Essayez de modifier vos filtres ou d'élargir votre recherche.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill">Voir tous les produits</a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4">
                                <x-product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-customer-layout>
