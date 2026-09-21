<section>

    <div class="mb-4">
        <h2 class="h5 fw-bold mb-2">
            Modifier le mot de passe
        </h2>

        <p class="text-muted mb-0">
            Utilisez un mot de passe long et aléatoire pour sécuriser votre compte.
        </p>
    </div>

    <form
        method="post"
        action="{{ route('password.update') }}"
    >
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <div class="mb-3">
            <label
                for="update_password_current_password"
                class="form-label"
            >
                Mot de passe actuel
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif"
                autocomplete="current-password"
            >

            @if ($errors->updatePassword->has('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <!-- Nouveau mot de passe -->
        <div class="mb-3">
            <label
                for="update_password_password"
                class="form-label"
            >
                Nouveau mot de passe
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif"
                autocomplete="new-password"
            >

            @if ($errors->updatePassword->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <!-- Confirmation -->
        <div class="mb-3">
            <label
                for="update_password_password_confirmation"
                class="form-label"
            >
                Confirmer le nouveau mot de passe
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif"
                autocomplete="new-password"
            >

            @if ($errors->updatePassword->has('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <!-- Bouton -->
        <div class="d-flex align-items-center gap-3 mt-4">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Enregistrer
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success">
                    Mot de passe enregistré.
                </span>
            @endif

        </div>

    </form>

</section>

