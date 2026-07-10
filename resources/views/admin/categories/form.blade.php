@php $isEdit = isset($category); @endphp

<form method="POST" action="{{ $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">{{ $isEdit ? 'Modifier la catégorie' : 'Nouvelle catégorie' }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <x-input-label for="name" value="Nom *" />
                        <x-text-input id="name" class="w-100" type="text" name="name"
                                      :value="old('name', $isEdit ? $category->name : '')" required />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="slug" value="Slug *" />
                        <div class="input-group">
                            <x-text-input id="slug" class="w-100" type="text" name="slug"
                                          :value="old('slug', $isEdit ? $category->slug : '')" required />
                            <button type="button" class="btn btn-outline-secondary" id="generate-slug"
                                    title="Générer depuis le nom">⟳</button>
                        </div>
                        <div class="form-text">Identifiant unique pour l'URL. Lettres, chiffres et tirets.</div>
                        <x-input-error :messages="$errors->get('slug')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="description" value="Description" />
                        <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $isEdit ? $category->description : '') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" />
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Mettre à jour' : 'Créer la catégorie' }}
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('generate-slug')?.addEventListener('click', function () {
    const name = document.getElementById('name').value;
    document.getElementById('slug').value = name
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-|-$/g, '');
});
</script>
@endpush
