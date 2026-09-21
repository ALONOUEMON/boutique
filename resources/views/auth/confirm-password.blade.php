<x-guest-layout>


<div class="text-center mb-4">
    <h2 class="fw-bold">Confirmer le mot de passe</h2>

    <p class="text-muted mb-0">
        Cette zone est sÃ©curisÃ©e. Veuillez confirmer votre mot de passe
        avant de continuer.
    </p>
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Mot de passe -->
    <div class="mb-3">
        <label for="password" class="form-label">
            Mot de passe
        </label>

        <input
            id="password"
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            required
            autocomplete="current-password"
            autofocus
        >

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Bouton -->
    <div class="d-grid mt-4">
        <button
            type="submit"
            class="btn btn-primary"
        >
            Confirmer
        </button>
    </div>

</form>

</x-guest-layout>

