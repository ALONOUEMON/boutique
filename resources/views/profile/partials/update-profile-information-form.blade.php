<section>

    <div class="mb-4">
        <h2 class="h5 fw-bold mb-2">
            Informations du profil
        </h2>

        <p class="text-muted mb-0">
            Modifiez les informations de votre compte et votre adresse e-mail.
        </p>
    </div>

    <!-- Formulaire de renvoi de vérification -->
    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <!-- Formulaire de modification du profil -->
    <form
        method="post"
        action="{{ route('profile.update') }}"
    >
        @csrf
        @method('patch')

        <!-- Nom -->
        <div class="mb-3">
            <label for="name" class="form-label">
                Nom
            </label>

            <input
                id="name"
                name="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
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

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">
                Adresse e-mail
            </label>

            <input
                id="email"
                name="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            >

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Vérification de l'adresse e-mail -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div class="alert alert-warning" role="alert">

                <p class="mb-2">
                    Votre adresse e-mail n'est pas encore vérifiée.
                </p>

                <button
                    form="send-verification"
                    type="submit"
                    class="btn btn-link p-0 text-decoration-none"
                >
                    Renvoyer l'e-mail de vérification
                </button>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-3 mb-0">
                        Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                    </div>
                @endif

            </div>

        @endif

        <!-- Bouton sauvegarder -->
        <div class="d-flex align-items-center gap-3 mt-4">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Enregistrer
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success">
                    Enregistré.
                </span>
            @endif

        </div>

    </form>

</section>

