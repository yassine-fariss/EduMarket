<x-guest-layout title="Forgot password">
    <div class="text-center mb-4">
        <i class="bi bi-key-fill text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Forgot your password?</h4>
        <p class="text-muted small">Enter your email address and we'll send you a reset link.</p>
    </div>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill">
            <i class="bi bi-send me-2"></i>Send reset link
        </button>
    </form>
</x-guest-layout>
