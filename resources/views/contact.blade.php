<x-customer-layout title="Contact">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <i class="bi bi-envelope-paper-fill text-primary" style="font-size: 3rem;"></i>
                    <h1 class="fw-bold mt-3">Contact Us</h1>
                    <p class="text-muted">A question? A suggestion? Our team will respond within 24 hours.</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card-modern bg-white text-center p-4">
                            <i class="bi bi-geo-alt-fill text-primary fs-3 mb-2 d-block"></i>
                            <h6 class="fw-bold small">Address</h6>
                            <p class="small text-muted mb-0">123 Education Street<br>Casablanca, Morocco</p>
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
                            <h6 class="fw-bold small">Phone</h6>
                            <p class="small text-muted mb-0">+212 5XX XX XX XX<br>Mon-Fri: 9 AM-6 PM</p>
                        </div>
                    </div>
                </div>

                <div class="card-modern bg-white p-4 p-lg-5">
                    <h5 class="fw-bold mb-4"><i class="bi bi-chat-dots text-primary me-2"></i>Send Us a Message</h5>
                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <x-input-label for="name" value="Your name" />
                                <x-text-input id="name" class="w-100" type="text" name="name" :value="old('name')" required placeholder="John Doe" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                            <div class="col-md-6">
                                <x-input-label for="email" value="Your email" />
                                <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required placeholder="john@example.com" />
                                <x-input-error :messages="$errors->get('email')" />
                            </div>
                            <div class="col-12">
                                <x-input-label for="subject" value="Subject" />
                                <x-text-input id="subject" class="w-100" type="text" name="subject" :value="old('subject')" required placeholder="Message subject" />
                                <x-input-error :messages="$errors->get('subject')" />
                            </div>
                            <div class="col-12">
                                <x-input-label for="message" value="Message" />
                                <textarea id="message" name="message" class="form-control" rows="5" required placeholder="Your message...">{{ old('message') }}</textarea>
                                <x-input-error :messages="$errors->get('message')" />
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
