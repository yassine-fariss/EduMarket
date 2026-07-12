<x-guest-layout title="Email verification">
    <div class="text-center mb-4">
        <i class="bi bi-envelope-check-fill text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Verify your email</h4>
        <p class="text-muted small">Thanks for signing up! Before getting started, please verify your email address by clicking the link we just sent you.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">A new verification link has been sent to your email address.</div>
    @endif

    <div class="d-flex gap-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary rounded-pill">
                <i class="bi bi-arrow-repeat me-1"></i>Resend email
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary rounded-pill">Logout</button>
        </form>
    </div>
</x-guest-layout>
