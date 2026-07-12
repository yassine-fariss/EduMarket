<x-guest-layout title="Reset password">
    <div class="text-center mb-4">
        <i class="bi bi-shield-lock-fill text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">New password</h4>
        <p class="text-muted small">Choose a secure new password.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" value="New password" />
            <x-text-input id="password" class="w-100" type="password" name="password" required autocomplete="new-password" placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password_confirmation" value="Confirm password" />
            <x-text-input id="password_confirmation" class="w-100" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill">
            <i class="bi bi-check2-circle me-2"></i>Reset password
        </button>
    </form>
</x-guest-layout>
