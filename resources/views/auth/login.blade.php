<x-guest-layout>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Connexion</h2>
        <p class="text-muted mb-0">
            Connectez-vous à votre compte
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-3"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
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
                autocomplete="current-password"
            >

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Se souvenir de moi -->
        <div class="form-check mb-3">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="form-check-input"
            >

            <label for="remember_me" class="form-check-label">
                Se souvenir de moi
            </label>
        </div>

        <!-- Mot de passe oublié -->
        @if (Route::has('password.request'))
            <div class="mb-3 text-end">
                <a
                    href="{{ route('password.request') }}"
                    class="text-decoration-none"
                >
                    Mot de passe oublié ?
                </a>
            </div>
        @endif

        <!-- Bouton connexion -->
        <div class="d-grid">
            <button
                type="submit"
                class="btn btn-primary"
            >
                Se connecter
            </button>
        </div>

    </form>

    <!-- Inscription -->
    @if (Route::has('register'))
        <div class="text-center mt-4">
            <span class="text-muted">
                Vous n'avez pas encore de compte ?
            </span>

            <a
                href="{{ route('register') }}"
                class="text-decoration-none fw-semibold"
            >
                S'inscrire
            </a>
        </div>
    @endif

</x-guest-layout>

