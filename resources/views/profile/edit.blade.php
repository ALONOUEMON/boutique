<x-app-layout>

    <x-slot name="header">
        <h2 class="h4 mb-0 fw-bold">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="container py-4">

        <div class="row justify-content-center">

            <div class="col-12 col-lg-8">

                <!-- Informations du profil -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">

                        <h5 class="card-title fw-bold mb-4">
                            Informations du profil
                        </h5>

                        @include('profile.partials.update-profile-information-form')

                    </div>
                </div>

                <!-- Mot de passe -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">

                        <h5 class="card-title fw-bold mb-4">
                            Modifier le mot de passe
                        </h5>

                        @include('profile.partials.update-password-form')

                    </div>
                </div>

                <!-- Suppression du compte -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">

                        <h5 class="card-title fw-bold mb-4">
                            Supprimer le compte
                        </h5>

                        @include('profile.partials.delete-user-form')

                    </div>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>

