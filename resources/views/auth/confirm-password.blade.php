<x-guest-layout title="Confirmer le mot de passe">
    <div class="text-center mb-4">
        <i class="bi bi-shield-fill-check text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Confirmez votre mot de passe</h4>
        <p class="text-muted small">Veuillez confirmer votre mot de passe avant de continuer.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="w-100" type="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill">
            <i class="bi bi-check2-circle me-2"></i>Confirmer
        </button>
    </form>
</x-guest-layout>
