<x-customer-layout>
    {{-- Hero --}}
    <section class="hero-section">
        <div class="container position-relative z-1">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 animate-in">
                    <span class="badge bg-accent text-dark mb-3 px-3 py-2 rounded-pill fw-medium">
                        <i class="bi bi-star-fill me-1"></i> La rentrée scolaire 2025-2026
                    </span>
                    <h1 class="display-4 fw-bold text-white mb-3">
                        Tout pour la<br><span class="text-accent">réussite scolaire</span>
                    </h1>
                    <p class="lead text-white-50 mb-4 fs-5">
                        Livres, fournitures, calculatrices, kits pédagogiques et matériel de classe.
                        Découvrez notre sélection complète de produits éducatifs aux meilleurs prix.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('shop.index') }}" class="btn btn-accent btn-lg px-5 fw-semibold rounded-pill">
                            <i class="bi bi-bag-check me-2"></i>Shop Now
                        </a>
                        <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                            <i class="bi bi-info-circle me-2"></i>En savoir plus
                        </a>
                    </div>
                    <div class="d-flex gap-4 mt-4 pt-2">
                        <div>
                            <div class="text-white fw-bold h5 mb-0">100+</div>
                            <small class="text-white-50">Produits</small>
                        </div>
                        <div>
                            <div class="text-white fw-bold h5 mb-0">12</div>
                            <small class="text-white-50">Catégories</small>
                        </div>
                        <div>
                            <div class="text-white fw-bold h5 mb-0">-30%</div>
                            <small class="text-white-50">Sur les fournitures</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center hero-illustration animate-in animate-in-delay-2">
                    <i class="bi bi-journal-richtext" style="font-size: 16rem; color: rgba(255,255,255,0.12);"></i>
                    <div class="position-relative d-inline-block">
                        <div class="position-absolute top-0 start-0 translate-middle bg-accent rounded-circle p-3 shadow-lg">
                            <i class="bi bi-pencil-fill text-dark fs-4"></i>
                        </div>
                        <div class="position-absolute bottom-0 end-0 translate-middle bg-success rounded-circle p-3 shadow-lg">
                            <i class="bi bi-calculator-fill text-white fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title section-title-center">Produits phares</h2>
                <p class="text-muted">Les produits les plus populaires de la semaine</p>
            </div>
            <div class="row g-4">
                @foreach ($featured as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('shop.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                    Voir tous les produits <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title section-title-center">Nos catégories</h2>
                <p class="text-muted">Explorez notre large gamme de produits par catégorie</p>
            </div>
            <div class="row g-3">
                @php
                    $catIcons = ['bi-book', 'bi-mortarboard-fill', 'bi-pencil', 'bi-calculator-fill', 'bi-brush', 'bi-cpu', 'bi-boxes', 'bi-flask', 'bi-translate', 'bi-palette', 'bi-scissors', 'bi-rulers'];
                    $catColors = ['#2563EB', '#7C3AED', '#DC2626', '#059669', '#D97706', '#0891B2', '#4F46E5', '#16A34A', '#CA8A04', '#DB2777', '#0D9488', '#9333EA'];
                @endphp
                @foreach ($categories as $i => $category)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="category-card p-3">
                            <div class="cat-icon" style="background: {{ $catColors[$i % count($catColors)] }}15; color: {{ $catColors[$i % count($catColors)] }};">
                                <i class="{{ $catIcons[$i % count($catIcons)] }}"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1 small">{{ $category->name }}</h6>
                            <small class="text-muted">{{ $category->products_count }} produit(s)</small>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title section-title-center">Pourquoi choisir EduMarket ?</h2>
                <p class="text-muted">Nous nous engageons pour votre réussite</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon" style="background: #2563EB15; color: #2563EB;">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h6 class="fw-bold">Livraison rapide</h6>
                        <p class="small text-muted mb-0">Expédition sous 24h et livraison en 2-5 jours ouvrés partout au Maroc.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon" style="background: #05966915; color: #059669;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h6 class="fw-bold">Qualité garantie</h6>
                        <p class="small text-muted mb-0">Tous nos produits sont sélectionnés pour leur qualité et leur conformité.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon" style="background: #D9770615; color: #D97706;">
                            <i class="bi bi-currency-euro"></i>
                        </div>
                        <h6 class="fw-bold">Meilleurs prix</h6>
                        <p class="small text-muted mb-0">Des prix compétitifs toute l'année avec des promotions régulières.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="why-card">
                        <div class="why-icon" style="background: #7C3AED15; color: #7C3AED;">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h6 class="fw-bold">Support client</h6>
                        <p class="small text-muted mb-0">Une équipe à votre écoute du lundi au vendredi de 9h à 18h.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Nouveautés --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h2 class="section-title mb-1">Nouveautés</h2>
                    <p class="text-muted mb-0">Les derniers produits ajoutés à notre catalogue</p>
                </div>
                <a href="{{ route('shop.index', ['sort' => 'newest']) }}" class="btn btn-outline-primary rounded-pill btn-sm">
                    Voir tout <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="row g-4">
                @foreach ($newest as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-5" style="background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 100%);">
        <div class="container text-center">
            <h2 class="fw-bold text-white mb-3">Prêt à équiper votre scolarité ?</h2>
            <p class="lead text-white-50 mb-4 mx-auto" style="max-width: 600px;">
                Rejoignez des milliers d'étudiants et enseignants qui nous font confiance
                pour leurs fournitures éducatives.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('shop.index') }}" class="btn btn-accent btn-lg px-5 fw-semibold rounded-pill">
                    <i class="bi bi-bag-check me-2"></i>Explorer la boutique
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                    <i class="bi bi-person-plus me-2"></i>Créer un compte
                </a>
            </div>
        </div>
    </section>
</x-customer-layout>
