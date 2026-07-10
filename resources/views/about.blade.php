<x-customer-layout title="À propos">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active">À propos</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <i class="bi bi-book-fill text-primary" style="font-size: 4rem;"></i>
                    <h1 class="fw-bold mt-3">À propos d'EduMarket</h1>
                    <p class="text-muted">Votre partenaire pour la réussite éducative</p>
                </div>

                <div class="card-modern bg-white p-4 p-lg-5 mb-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i>Qui sommes-nous ?</h5>
                    <p class="text-muted">EduMarket est votre destination en ligne pour tout le matériel éducatif. Nous proposons une large gamme de produits allant des livres scolaires aux fournitures de bureau, en passant par les calculatrices, les outils de dessin et les kits pédagogiques.</p>
                    <p class="text-muted mb-0">Notre mission est de rendre l'éducation accessible à tous en fournissant des produits de qualité à des prix abordables. Nous travaillons avec les plus grandes marques et éditeurs pour garantir l'excellence de notre catalogue.</p>
                </div>

                <div class="card-modern bg-white p-4 p-lg-5 mb-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-heart text-danger me-2"></i>Nos valeurs</h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="text-center p-4 rounded-3" style="background: #2563EB08;">
                                <i class="bi bi-award text-primary fs-2 mb-2 d-block"></i>
                                <h6 class="fw-bold">Qualité</h6>
                                <p class="small text-muted mb-0">Des produits soigneusement sélectionnés</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 rounded-3" style="background: #05966908;">
                                <i class="bi bi-currency-euro text-success fs-2 mb-2 d-block"></i>
                                <h6 class="fw-bold">Accessibilité</h6>
                                <p class="small text-muted mb-0">Des prix justes pour tous</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 rounded-3" style="background: #7C3AED08;">
                                <i class="bi bi-mortarboard-fill text-purple fs-2 mb-2 d-block" style="color: #7C3AED;"></i>
                                <h6 class="fw-bold">Engagement</h6>
                                <p class="small text-muted mb-0">Au service de l'éducation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-modern bg-white p-4 p-lg-5">
                    <h5 class="fw-bold mb-3"><i class="bi bi-envelope text-primary me-2"></i>Contact</h5>
                    <div class="d-flex flex-wrap gap-4">
                        <div><i class="bi bi-envelope-fill text-muted me-2"></i>contact@edumarket.com</div>
                        <div><i class="bi bi-telephone-fill text-muted me-2"></i>+212 5XX XX XX XX</div>
                        <div><i class="bi bi-geo-alt-fill text-muted me-2"></i>Casablanca, Maroc</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
