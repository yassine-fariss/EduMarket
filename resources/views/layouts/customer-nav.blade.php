<nav class="navbar navbar-expand-lg navbar-edumarket fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 text-white fw-bold" href="{{ route('home') }}">
            <i class="bi bi-book-fill fs-4 text-accent"></i>
            <span class="fs-5">{{ config('app.name', 'EduMarket') }}</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Menu">
            <i class="bi bi-list text-white fs-4"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-fill me-1"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop.*') ? 'active' : '' }}" href="{{ route('shop.index') }}">
                        <i class="bi bi-shop me-1"></i> Boutique
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="bi bi-grid-fill me-1"></i> Catégories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="bi bi-envelope-fill me-1"></i> Contact
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <form class="search-form d-none d-md-block" action="{{ route('shop.index') }}" method="GET" role="search">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher un produit..."
                               value="{{ request('search') }}" aria-label="Rechercher">
                        <button class="btn" type="submit" aria-label="Lancer la recherche">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <a class="nav-link cart-link text-white-75 {{ request()->routeIs('cart.*') ? 'active' : '' }}"
                   href="{{ route('cart.index') }}" aria-label="Panier">
                    <i class="bi bi-cart3 fs-5"></i>
                    @php $cartCount = app(\App\Services\CartService::class)->count(); @endphp
                    @if ($cartCount > 0)
                        <span class="cart-badge" id="cart-badge">{{ $cartCount }}</span>
                    @else
                        <span class="cart-badge d-none" id="cart-badge">0</span>
                    @endif
                </a>

                @auth
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light rounded-pill dropdown-toggle d-flex align-items-center gap-1"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}">
                                <i class="bi bi-box-seam me-2"></i>Mes commandes
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear me-2"></i>Mon profil
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light rounded-pill">
                        <i class="bi bi-person me-1"></i> Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-accent rounded-pill d-none d-md-inline-block">
                        Inscription
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
