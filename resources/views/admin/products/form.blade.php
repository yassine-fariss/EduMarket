@php
    $isEdit = isset($product);
@endphp

@push('scripts')
<script>
document.getElementById('generate-slug')?.addEventListener('click', function () {
    const title = document.getElementById('title').value;
    document.getElementById('slug').value = title
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-|-$/g, '');
});
</script>
@endpush

<form method="POST" action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Informations</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <x-input-label for="title" value="Titre *" />
                        <x-text-input id="title" class="w-100" type="text" name="title"
                                      :value="old('title', $isEdit ? $product->title : '')" required />
                        <x-input-error :messages="$errors->get('title')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="slug" value="Slug *" />
                        <div class="input-group">
                            <x-text-input id="slug" class="w-100" type="text" name="slug"
                                          :value="old('slug', $isEdit ? $product->slug : '')" required />
                            <button type="button" class="btn btn-outline-secondary" id="generate-slug"
                                    title="Générer depuis le titre">⟳</button>
                        </div>
                        <div class="form-text">Identifiant unique pour l'URL. Lettres, chiffres et tirets.</div>
                        <x-input-error :messages="$errors->get('slug')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="description" value="Description *" />
                        <textarea id="description" name="description" class="form-control" rows="6" required>{{ old('description', $isEdit ? $product->description : '') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" />
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <x-input-label for="price" value="Prix (€) *" />
                            <x-text-input id="price" class="w-100" type="number" step="0.01" min="0"
                                          name="price"
                                          :value="old('price', $isEdit ? $product->price : '')" required />
                            <x-input-error :messages="$errors->get('price')" />
                        </div>

                        <div class="col-md-4">
                            <x-input-label for="stock" value="Stock *" />
                            <x-text-input id="stock" class="w-100" type="number" min="0"
                                          name="stock"
                                          :value="old('stock', $isEdit ? $product->stock : '')" required />
                            <x-input-error :messages="$errors->get('stock')" />
                        </div>

                        <div class="col-md-4">
                            <x-input-label for="status" value="Statut *" />
                            <select id="status" name="status" class="form-select">
                                <option value="active" {{ old('status', $isEdit ? $product->status : 'active') === 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="draft" {{ old('status', $isEdit ? $product->status : '') === 'draft' ? 'selected' : '' }}>Brouillon</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Catégorie *</h5>
                </div>
                <div class="card-body">
                    <select name="category_id" class="form-select" required>
                        <option value="">Sélectionner...</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $isEdit ? $product->category_id : '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" />
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Image</h5>
                </div>
                <div class="card-body">
                    @if ($isEdit && $product->image)
                        @php $isExternal = filter_var($product->image, FILTER_VALIDATE_URL); @endphp
                        <div class="mb-3">
                            <img src="{{ $isExternal ? $product->image : (str_starts_with($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image)) }}"
                                 alt="{{ $product->title }}"
                                 class="img-fluid rounded mb-2"
                                 style="max-height: 180px; object-fit: cover;">
                            <p class="small text-muted mb-0">Image actuelle</p>
                        </div>
                    @endif

                    <div class="mb-3">
                        <x-input-label for="image" value="{{ $isEdit && $product->image ? 'Nouvelle image' : 'Image' }}" />
                        <input type="file" id="image" name="image" class="form-control"
                               accept="image/jpeg,image/png,image/jpg,image/webp">
                        <div class="form-text">JPEG, PNG ou WebP. Max 2 Mo.</div>
                        <x-input-error :messages="$errors->get('image')" />
                    </div>

                    @if ($isEdit && $product->image)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                            <label class="form-check-label small" for="remove_image">
                                Supprimer l'image actuelle
                            </label>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    {{ $isEdit ? 'Mettre à jour' : 'Créer le produit' }}
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </div>
    </div>
</form>
