<x-guest-layout>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Réinitialiser le mot de passe</h2>

        <p class="text-muted mb-0">
            Choisissez votre nouveau mot de passe.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token de réinitialisation -->
        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
        >

        <!-- Adresse e-mail -->
        <div class="mb-3">
            <label for="email" class="form-label">
                Adresse e-mail
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                class="form-control @error('email') is-invalid @enderror"
                required
                autofocus
                autocomplete="username"
            >

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Nouveau mot de passe -->
        <div class="mb-3">
            <label for="password" class="form-label">
                Nouveau mot de passe
            </label>

            <input
                id="password"
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
                autocomplete="new-password"
            >

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirmation -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">
                Confirmer le nouveau mot de passe
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                required
                autocomplete="new-password"
            >

            @error('password_confirmation')
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
                Réinitialiser le mot de passe
            </button>
        </div>

    </form>

    <!-- Retour connexion -->
    <div class="text-center mt-4">
        <a
            href="{{ route('login') }}"
            class="text-decoration-none"
        >
            ← Retour à la connexion
        </a>
    </div>

</x-guest-layout>

