<x-guest-layout title="Vérification email">
    <div class="text-center mb-4">
        <i class="bi bi-envelope-check-fill text-primary fs-1"></i>
        <h4 class="fw-bold mt-2">Vérifiez votre email</h4>
        <p class="text-muted small">Merci de vous être inscrit ! Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">Un nouveau lien de vérification a été envoyé à votre adresse email.</div>
    @endif

    <div class="d-flex gap-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary rounded-pill">
                <i class="bi bi-arrow-repeat me-1"></i>Renvoyer l'email
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary rounded-pill">Déconnexion</button>
        </form>
    </div>
</x-guest-layout>
