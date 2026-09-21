<x-guest-layout>


<div class="text-center mb-4">
    <h2 class="fw-bold">VÃ©rification de l'adresse e-mail</h2>

    <p class="text-muted mb-0">
        Merci de vous Ãªtre inscrit ! Avant de continuer, veuillez vÃ©rifier
        votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer.
    </p>
</div>

<!-- Message de confirmation -->
@if (session('status') == 'verification-link-sent')
    <div class="alert alert-success" role="alert">
        Un nouveau lien de vÃ©rification a Ã©tÃ© envoyÃ© Ã  l'adresse e-mail
        indiquÃ©e lors de votre inscription.
    </div>
@endif

<!-- Actions -->
<div class="d-flex flex-column gap-3 mt-4">

    <!-- Renvoyer l'e-mail -->
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <div class="d-grid">
            <button
                type="submit"
                class="btn btn-primary"
            >
                Renvoyer l'e-mail de vÃ©rification
            </button>
        </div>
    </form>

    <!-- DÃ©connexion -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <div class="d-grid">
            <button
                type="submit"
                class="btn btn-outline-secondary"
            >
                Se dÃ©connecter
            </button>
        </div>
    </form>

</div>

</x-guest-layout>

