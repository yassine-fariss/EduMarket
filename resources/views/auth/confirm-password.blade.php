<x-guest-layout title="Confirm password">
    <div class="text-center mb-4">
        <i class="bi bi-shield-fill-check text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Confirm your password</h4>
        <p class="text-muted small">Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="w-100" type="password" name="password" required autocomplete="current-password" placeholder="Your password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill">
            <i class="bi bi-check2-circle me-2"></i>Confirm
        </button>
    </form>
</x-guest-layout>
