<x-layouts.admin>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold mb-0">Catégories</h4>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Nouvelle catégorie
        </a>
    </div>

    <div class="card shadow-sm">
        @if ($categories->isEmpty())
            <div class="card-body text-center py-5">
                <p class="text-muted mb-0">Aucune catégorie pour le moment.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th class="text-center">Produits</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="fw-medium">{{ $category->name }}</td>
                                <td class="small text-muted">{{ $category->slug }}</td>
                                <td class="small text-muted text-truncate" style="max-width: 300px;">
                                    {{ $category->description ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $category->products_count > 0 ? 'primary' : 'secondary' }}">
                                        {{ $category->products_count }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="btn btn-sm btn-outline-primary">Modifier</a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                          class="d-inline" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                {{ $category->products_count > 0 ? 'disabled' : '' }}>
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white">
                <small class="text-muted">{{ $categories->count() }} catégorie(s)</small>
            </div>
        @endif
    </div>
</x-layouts.admin>
