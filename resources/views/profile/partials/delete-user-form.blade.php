<section>

    <div class="mb-4">
        <h2 class="h5 fw-bold mb-2">
            Supprimer le compte
        </h2>

        <p class="text-muted mb-0">
            Une fois votre compte supprimÃ©, toutes ses ressources et donnÃ©es
            seront dÃ©finitivement supprimÃ©es. Avant de supprimer votre compte,
            pensez Ã  tÃ©lÃ©charger les donnÃ©es que vous souhaitez conserver.
        </p>
    </div>

    <!-- Bouton supprimer -->
    <button
        type="button"
        class="btn btn-danger"
        data-bs-toggle="modal"
        data-bs-target="#confirmUserDeletion"
    >
        Supprimer le compte
    </button>

    <!-- Modal de confirmation -->
    <div
        class="modal fade"
        id="confirmUserDeletion"
        tabindex="-1"
        aria-labelledby="confirmUserDeletionLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- En-tÃªte -->
                <div class="modal-header">
                    <h5
                        class="modal-title fw-bold"
                        id="confirmUserDeletionLabel"
                    >
                        Confirmer la suppression
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer"
                    ></button>
                </div>

                <!-- Corps -->
                <div class="modal-body">

                    <p>
                        ÃŠtes-vous sÃ»r de vouloir supprimer votre compte ?
                    </p>

                    <p class="text-muted">
                        Une fois votre compte supprimÃ©, toutes ses ressources
                        et donnÃ©es seront dÃ©finitivement supprimÃ©es.
                        Entrez votre mot de passe pour confirmer.
                    </p>

                    <!-- Formulaire -->
                    <form
                        method="post"
                        action="{{ route('profile.destroy') }}"
                        id="deleteAccountForm"
                    >
                        @csrf
                        @method('delete')

                        <div class="mb-3">
                            <label
                                for="delete_password"
                                class="form-label"
                            >
                                Mot de passe
                            </label>

                            <input
                                id="delete_password"
                                name="password"
                                type="password"
                                class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif"
                                placeholder="Mot de passe"
                            >

                            @if ($errors->userDeletion->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </form>

                </div>

                <!-- Pied du modal -->
                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        form="deleteAccountForm"
                        class="btn btn-danger"
                    >
                        Supprimer dÃ©finitivement
                    </button>

                </div>

            </div>
        </div>
    </div>

    {{-- RÃ©ouvrir automatiquement le modal s'il y a une erreur --}}
    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalElement = document.getElementById('confirmUserDeletion');

                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            });
        </script>
    @endif

</section>

