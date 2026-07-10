<x-guest-layout title="Connexion">
    <x-auth-session-status :status="session('status')" />

    <div class="text-center mb-4">
        <i class="bi bi-book-fill text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Connexion</h4>
        <p class="text-muted small">Connectez-vous à votre compte EduMarket</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="exemple@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="w-100" type="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label small">Se souvenir de moi</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3">
            <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
        </button>

        <div class="d-flex justify-content-between small">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">Mot de passe oublié ?</a>
            @endif
            <a href="{{ route('register') }}" class="text-decoration-none">Créer un compte</a>
        </div>
    </form>
</x-guest-layout>
