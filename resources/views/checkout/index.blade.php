<x-customer-layout title="Commander">
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Panier</a></li>
                <li class="breadcrumb-item active">Commander</li>
            </ol>
        </nav>

        <h2 class="fw-bold mb-4">Finaliser la commande</h2>

        @php $items = app(\App\Services\CartService::class)->get(); @endphp

        <div class="row g-4">
            <div class="col-lg-7">
                <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form">
                    @csrf

                    <div class="card-modern bg-white mb-4">
                        <div class="p-3 border-bottom">
                            <h5 class="fw-bold mb-0"><i class="bi bi-person me-2 text-primary"></i>Informations personnelles</h5>
                        </div>
                        <div class="p-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <x-input-label for="full_name" value="Nom complet" />
                                    <x-text-input id="full_name" class="w-100" type="text" name="full_name"
                                                  :value="old('full_name', auth()->user()->name)" required
                                                  placeholder="Jean Dupont" />
                                    <x-input-error :messages="$errors->get('full_name')" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-label for="phone" value="Téléphone" />
                                    <x-text-input id="phone" class="w-100" type="text" name="phone"
                                                  :value="old('phone')" required placeholder="06 12 34 56 78" />
                                    <x-input-error :messages="$errors->get('phone')" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-label for="city" value="Ville" />
                                    <x-text-input id="city" class="w-100" type="text" name="city"
                                                  :value="old('city')" required placeholder="Casablanca" />
                                    <x-input-error :messages="$errors->get('city')" />
                                </div>
                                <div class="col-12">
                                    <x-input-label for="shipping_address" value="Adresse de livraison" />
                                    <textarea id="shipping_address" name="shipping_address"
                                              class="form-control" rows="3" required
                                              placeholder="Numéro, rue, quartier, code postal...">{{ old('shipping_address') }}</textarea>
                                    <x-input-error :messages="$errors->get('shipping_address')" />
                                </div>
                                <div class="col-12">
                                    <x-input-label for="notes" value="Notes (optionnel)" />
                                    <textarea id="notes" name="notes" class="form-control" rows="2"
                                              placeholder="Instructions de livraison, etc.">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-modern bg-white mb-4">
                        <div class="p-3 border-bottom">
                            <h5 class="fw-bold mb-0"><i class="bi bi-credit-card me-2 text-primary"></i>Mode de paiement</h5>
                        </div>
                        <div class="p-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method"
                                       id="pm_cod" value="cash_on_delivery"
                                       {{ old('payment_method', 'cash_on_delivery') === 'cash_on_delivery' ? 'checked' : '' }} required>
                                <label class="form-check-label fw-medium" for="pm_cod">
                                    Paiement à la livraison
                                </label>
                                <p class="small text-muted mb-0 ms-4">Payez en espèces ou par carte directement au livreur.</p>
                            </div>
                            <x-input-error :messages="$errors->get('payment_method')" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill" id="submit-btn">
                        <i class="bi bi-check2-circle me-2"></i>Confirmer la commande
                    </button>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="card-modern bg-white">
                    <div class="p-3 border-bottom">
                        <h5 class="fw-bold mb-0"><i class="bi bi-cart3 me-2 text-primary"></i>Récapitulatif</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Qté</th>
                                    <th class="text-end">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="small">
                                            <div class="d-flex align-items-center gap-2">
                                                @php
                                                    $isExternal = filter_var($item['image'] ?? '', FILTER_VALIDATE_URL);
                                                    $imgSrc = $isExternal ? $item['image'] : (str_starts_with($item['image'] ?? '', 'images/') ? asset($item['image']) : asset('storage/' . $item['image']));
                                                @endphp
                                                @if ($item['image'])
                                                    <img src="{{ $imgSrc }}" alt="{{ $item['title'] }}"
                                                         class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted"
                                                         style="width: 40px; height: 40px; font-size: 0.7rem;">N/A</div>
                                                @endif
                                                {{ $item['title'] }}
                                            </div>
                                        </td>
                                        <td class="text-center small">x{{ $item['quantity'] }}</td>
                                        <td class="text-end small">{{ number_format($item['price'] * $item['quantity'], 2) }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="2" class="fw-bold">Total</td>
                                    <td class="text-end fw-bold fs-5" style="color: var(--primary);">
                                        {{ number_format(collect($items)->sum(fn ($i) => $i['price'] * $i['quantity']), 2) }} €
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="card-modern bg-white mt-3 p-3">
                    <p class="small text-muted mb-1"><i class="bi bi-truck me-1"></i> <strong>Livraison :</strong> Calculée à la confirmation</p>
                    <p class="small text-muted mb-0"><i class="bi bi-shield-check me-1"></i> <strong>Paiement :</strong> À la livraison (espèces ou carte)</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.getElementById('checkout-form')?.addEventListener('submit', function () {
        document.getElementById('submit-btn').disabled = true;
        document.getElementById('submit-btn').innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Traitement en cours...';
    });
    </script>
    @endpush
</x-customer-layout>
