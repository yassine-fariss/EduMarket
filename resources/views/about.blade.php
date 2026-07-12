<x-customer-layout title="About">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a></li>
                <li class="breadcrumb-item active">About</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <i class="bi bi-book-fill text-primary" style="font-size: 4rem;"></i>
                    <h1 class="fw-bold mt-3">About EduMarket</h1>
                    <p class="text-muted">Your partner for educational success</p>
                </div>

                <div class="card-modern bg-white p-4 p-lg-5 mb-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i>Who Are We?</h5>
                    <p class="text-muted">EduMarket is your online destination for all educational supplies. We offer a wide range of products from textbooks to office supplies, including calculators, drawing tools, and educational kits.</p>
                    <p class="text-muted mb-0">Our mission is to make education accessible to everyone by providing quality products at affordable prices. We work with the biggest brands and publishers to ensure the excellence of our catalog.</p>
                </div>

                <div class="card-modern bg-white p-4 p-lg-5 mb-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-heart text-danger me-2"></i>Our Values</h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="text-center p-4 rounded-3" style="background: #2563EB08;">
                                <i class="bi bi-award text-primary fs-2 mb-2 d-block"></i>
                                <h6 class="fw-bold">Quality</h6>
                                <p class="small text-muted mb-0">Carefully selected products</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 rounded-3" style="background: #05966908;">
                                <i class="bi bi-currency-euro text-success fs-2 mb-2 d-block"></i>
                                <h6 class="fw-bold">Affordability</h6>
                                <p class="small text-muted mb-0">Fair prices for everyone</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 rounded-3" style="background: #7C3AED08;">
                                <i class="bi bi-mortarboard-fill text-purple fs-2 mb-2 d-block" style="color: #7C3AED;"></i>
                                <h6 class="fw-bold">Commitment</h6>
                                <p class="small text-muted mb-0">Serving education</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-modern bg-white p-4 p-lg-5">
                    <h5 class="fw-bold mb-3"><i class="bi bi-envelope text-primary me-2"></i>Contact</h5>
                    <div class="d-flex flex-wrap gap-4">
                        <div><i class="bi bi-envelope-fill text-muted me-2"></i>contact@edumarket.com</div>
                        <div><i class="bi bi-telephone-fill text-muted me-2"></i>+212 5XX XX XX XX</div>
                        <div><i class="bi bi-geo-alt-fill text-muted me-2"></i>Casablanca, Morocco</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
