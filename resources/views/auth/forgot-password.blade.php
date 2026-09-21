<x-guest-layout>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Mot de passe oubliÃ©</h2>

        <p class="text-muted mb-0">
            Entrez votre adresse e-mail et nous vous enverrons un lien
            pour rÃ©initialiser votre mot de passe.
        </p>
    </div>

    <!-- Message de statut -->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Adresse e-mail -->
        <div class="mb-3">
            <label for="email" class="form-label">
                Adresse e-mail
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required
                autofocus
                autocomplete="email"
            >

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Bouton -->
        <div class="d-grid">
            <button
                type="submit"
                class="btn btn-primary"
            >
                Envoyer le lien de rÃ©initialisation
            </button>
        </div>

    </form>

    <!-- Retour connexion -->
    <div class="text-center mt-4">
        <a
            href="{{ route('login') }}"
            class="text-decoration-none"
        >
            â† Retour Ã  la connexion
        </a>
    </div>

</x-guest-layout>

