<x-guest-layout title="Inscription">
    <div class="text-center mb-4">
        <i class="bi bi-book-fill text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Inscription</h4>
        <p class="text-muted small">Créez votre compte EduMarket</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="name" value="Nom complet" />
            <x-text-input id="name" class="w-100" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Votre nom" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="exemple@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="w-100" type="password" name="password" required autocomplete="new-password" placeholder="Minimum 8 caractères" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <x-text-input id="password_confirmation" class="w-100" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Répétez le mot de passe" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3">
            <i class="bi bi-person-plus me-2"></i>S'inscrire
        </button>

        <div class="text-center small">
            Déjà inscrit ? <a href="{{ route('login') }}" class="text-decoration-none">Connectez-vous</a>
        </div>
    </form>
</x-guest-layout>
