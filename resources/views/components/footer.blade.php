<footer class="footer-edumarket pt-5 pb-3 mt-auto">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-book-fill fs-3 text-accent"></i>
                    <h5 class="mb-0">{{ config('app.name', 'EduMarket') }}</h5>
                </div>
                <p class="small mb-3">
                    Votre boutique en ligne de référence pour tout le matériel éducatif.
                    Livres, fournitures, calculatrices, kits pédagogiques et bien plus.
                </p>
                <div class="social-links d-flex gap-2">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="mb-3">Liens rapides</h6>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="mb-2"><a href="{{ route('shop.index') }}">Boutique</a></li>
                    <li class="mb-2"><a href="{{ route('categories.index') }}">Catégories</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}">À propos</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="mb-3">Contact</h6>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>123 Rue de l'Éducation, Casablanca
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>contact@edumarket.com
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>+212 5XX XX XX XX
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-clock me-2"></i>Lun - Ven : 9h - 18h
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="mb-3">Newsletter</h6>
                <p class="small mb-3">Recevez nos offres et nouveautés.</p>
                <form class="newsletter">
                    <div class="input-group input-group-sm">
                        <input type="email" class="form-control" placeholder="Votre email" aria-label="Email">
                        <button class="btn btn-accent" type="submit">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="my-4 border-secondary opacity-25">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small mb-0">
                    &copy; {{ date('Y') }} {{ config('app.name', 'EduMarket') }}. Tous droits réservés.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <div class="d-flex gap-3 justify-content-center justify-content-md-end small">
                    <a href="#">Mentions légales</a>
                    <a href="#">Politique de confidentialité</a>
                    <a href="#">CGV</a>
                </div>
            </div>
        </div>
    </div>
</footer>
