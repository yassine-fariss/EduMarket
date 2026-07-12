<x-guest-layout title="Register">
    <div class="text-center mb-4">
        <i class="bi bi-book-fill text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Register</h4>
        <p class="text-muted small">Create your EduMarket account</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="name" value="Full name" />
            <x-text-input id="name" class="w-100" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="w-100" type="password" name="password" required autocomplete="new-password" placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password_confirmation" value="Confirm password" />
            <x-text-input id="password_confirmation" class="w-100" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3">
            <i class="bi bi-person-plus me-2"></i>Sign up
        </button>

        <div class="text-center small">
            Already registered? <a href="{{ route('login') }}" class="text-decoration-none">Sign in</a>
        </div>
    </form>
</x-guest-layout>
