<x-customer-layout title="Contact">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <i class="bi bi-envelope-paper-fill text-primary" style="font-size: 3rem;"></i>
                    <h1 class="fw-bold mt-3">Contactez-nous</h1>
                    <p class="text-muted">Une question ? Une suggestion ? Notre équipe vous répondra sous 24h.</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card-modern bg-white text-center p-4">
                            <i class="bi bi-geo-alt-fill text-primary fs-3 mb-2 d-block"></i>
                            <h6 class="fw-bold small">Adresse</h6>
                            <p class="small text-muted mb-0">123 Rue de l'Éducation<br>Casablanca, Maroc</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-modern bg-white text-center p-4">
                            <i class="bi bi-envelope-fill text-primary fs-3 mb-2 d-block"></i>
                            <h6 class="fw-bold small">Email</h6>
                            <p class="small text-muted mb-0">contact@edumarket.com</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-modern bg-white text-center p-4">
                            <i class="bi bi-telephone-fill text-primary fs-3 mb-2 d-block"></i>
                            <h6 class="fw-bold small">Téléphone</h6>
                            <p class="small text-muted mb-0">+212 5XX XX XX XX<br>Lun-Ven : 9h-18h</p>
                        </div>
                    </div>
                </div>

                <div class="card-modern bg-white p-4 p-lg-5">
                    <h5 class="fw-bold mb-4"><i class="bi bi-chat-dots text-primary me-2"></i>Envoyez-nous un message</h5>
                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <x-input-label for="name" value="Votre nom" />
                                <x-text-input id="name" class="w-100" type="text" name="name" :value="old('name')" required placeholder="Jean Dupont" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-label for="email" value="Votre email" />
                                <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required placeholder="jean@exemple.com" />
                                <x-input-error :messages="$errors->get('email')" />
                            </div>
                            <div class="col-12">
                                <x-input-label for="subject" value="Sujet" />
                                <x-text-input id="subject" class="w-100" type="text" name="subject" :value="old('subject')" required placeholder="Sujet de votre message" />
                                <x-input-error :messages="$errors->get('subject')" />
                            </div>
                            <div class="col-12">
                                <x-input-label for="message" value="Message" />
                                <textarea id="message" name="message" class="form-control" rows="5" required placeholder="Votre message...">{{ old('message') }}</textarea>
                                <x-input-error :messages="$errors->get('message')" />
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                    <i class="bi bi-send me-2"></i>Envoyer le message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
