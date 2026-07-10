<x-guest-layout title="Mot de passe oublié">
    <div class="text-center mb-4">
        <i class="bi bi-key-fill text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Mot de passe oublié ?</h4>
        <p class="text-muted small">Saisissez votre adresse email pour recevoir un lien de réinitialisation.</p>
    </div>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required autofocus placeholder="exemple@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill">
            <i class="bi bi-send me-2"></i>Envoyer le lien
        </button>
    </form>
</x-guest-layout>
