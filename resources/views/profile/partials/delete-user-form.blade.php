<section>
    <header class="mb-4">
        <h5 class="fw-bold text-danger">{{ __('Supprimer le compte') }}</h5>
        <p class="text-muted small">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront supprimées définitivement. Avant de supprimer votre compte, veuillez télécharger les données que vous souhaitez conserver.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Supprimer le compte') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h5 class="fw-bold mb-3">{{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}</h5>

            <p class="small text-muted mb-3">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront supprimées définitivement. Veuillez entrer votre mot de passe pour confirmer.') }}
            </p>

            <div class="mb-3">
                <x-input-label for="password" value="{{ __('Mot de passe') }}" />
                <x-text-input id="password" name="password" type="password" class="w-75" placeholder="{{ __('Mot de passe') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="d-flex justify-content-end gap-2">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-secondary-button>
                <x-danger-button>
                    {{ __('Supprimer le compte') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
