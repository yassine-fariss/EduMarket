@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? "$title — " : '' }}Administration — {{ config('app.name', 'EduMarket') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex min-vh-100">
        {{-- Sidebar toggle (mobile) --}}
        <button class="btn btn-dark d-md-none position-fixed top-0 start-0 m-2 z-3" type="button"
                data-bs-toggle="collapse" data-bs-target="#adminSidebar" aria-controls="adminSidebar"
                aria-label="Basculer le menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>

        {{-- Sidebar --}}
        <nav id="adminSidebar" class="bg-dark text-white flex-shrink-0 d-flex flex-column collapse d-md-flex"
             style="width: 260px;">
            <div class="p-3 border-bottom border-secondary d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
                    <x-application-logo style="width: 28px; height: 28px;" />
                    <span class="fw-bold">{{ config('app.name', 'EduMarket') }}</span>
                    <span class="badge bg-warning text-dark ms-1" style="font-size: 0.6rem;">Admin</span>
                </a>
                <button class="btn btn-sm btn-outline-light d-md-none p-1" type="button"
                        data-bs-toggle="collapse" data-bs-target="#adminSidebar" aria-label="Fermer le menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            </div>

            <div class="p-3 border-bottom border-secondary d-none d-md-block">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 36px; height: 36px; font-size: 0.9rem; flex-shrink: 0;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="small text-truncate">
                        <div class="fw-medium text-truncate">{{ Auth::user()->name }}</div>
                        <div class="text-muted text-truncate" style="font-size: 0.75rem;">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <ul class="nav flex-column px-2 pt-3">
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link text-white rounded {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : 'text-white-50' }}">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M0 0h7v7H0V0zm9 0h7v7H9V0zM0 9h7v7H0V9zm9 0h7v7H9V9z"/></svg>
                        Tableau de bord
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.products.index') }}"
                       class="nav-link text-white rounded {{ request()->routeIs('admin.products.*') ? 'active bg-primary' : 'text-white-50' }}">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                        Produits
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.categories.index') }}"
                       class="nav-link text-white rounded {{ request()->routeIs('admin.categories.*') ? 'active bg-primary' : 'text-white-50' }}">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/></svg>
                        Catégories
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.orders.index') }}"
                       class="nav-link text-white rounded {{ request()->routeIs('admin.orders.*') ? 'active bg-primary' : 'text-white-50' }}">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
                        Commandes
                    </a>
                </li>
            </ul>

            <div class="mt-auto p-3 border-top border-secondary">
                <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm w-100 mb-2">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/><path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/></svg>
                    Retour au site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100">Déconnexion</button>
                </form>
            </div>
        </nav>

        {{-- Main content --}}
        <div class="d-flex flex-column flex-grow-1 min-vw-0">
            <x-flash-messages />

            <main class="flex-grow-1 bg-light pt-4 pt-md-0">
                <div class="p-3 p-lg-4">
                    {{ $slot }}
                </div>
            </main>

            <footer class="bg-white border-top py-3">
                <div class="px-4 d-flex justify-content-between align-items-center small text-muted">
                    <span>&copy; {{ date('Y') }} {{ config('app.name', 'EduMarket') }}. Administration.</span>
                    <span>v1.0</span>
                </div>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
