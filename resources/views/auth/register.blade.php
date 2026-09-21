<x-guest-layout>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Créer un compte</h2>
        <p class="text-muted mb-0">
            Inscrivez-vous pour continuer
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom -->
        <div class="mb-3">
            <label for="name" class="form-label">
                Nom
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                required
                autofocus
                autocomplete="name"
            >

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

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
                autocomplete="username"
            >

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

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
                autocomplete="new-password"
            >

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">
                Confirmer le mot de passe
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

        <!-- Actions -->
        <div class="d-flex justify-content-between align-items-center mt-4">

            <a
                href="{{ route('login') }}"
                class="text-decoration-none"
            >
                Déjà inscrit ?
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                S'inscrire
            </button>

        </div>

    </form>

</x-guest-layout>

