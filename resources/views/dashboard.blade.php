<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mon espace</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a
            href="{{ url('/') }}"
            class="navbar-brand"
        >
            Ma Boutique
        </a>

        <div class="d-flex gap-2">

            <a
                href="{{ url('/') }}"
                class="btn btn-outline-light"
            >
                Boutique
            </a>

            <a
                href="{{ route('cart.index') }}"
                class="btn btn-outline-light"
            >
                🛒 Panier
            </a>

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="d-inline"
            >
                @csrf

                <button
                    type="submit"
                    class="btn btn-danger"
                >
                    Déconnexion
                </button>
            </form>

        </div>

    </div>

</nav>


<div class="container py-5">

    <div class="text-center mb-5">

        <h1>
            Bienvenue {{ auth()->user()->name }} !
        </h1>

        <p class="text-muted">
            Bienvenue dans votre espace client.
        </p>

    </div>


    <div class="row g-4">

        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <div class="display-4 mb-3">
                        🛍️
                    </div>

                    <h4>
                        Boutique
                    </h4>

                    <p class="text-muted">
                        Découvrez nos produits et ajoutez-les à votre panier.
                    </p>

                    <a
                        href="{{ url('/') }}"
                        class="btn btn-primary"
                    >
                        Voir les produits
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <div class="display-4 mb-3">
                        🛒
                    </div>

                    <h4>
                        Mon panier
                    </h4>

                    <p class="text-muted">
                        Consultez les produits présents dans votre panier.
                    </p>

                    <a
                        href="{{ route('cart.index') }}"
                        class="btn btn-success"
                    >
                        Voir mon panier
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <div class="display-4 mb-3">
                        📦
                    </div>

                    <h4>
                        Mes commandes
                    </h4>

                    <p class="text-muted">
                        Consultez l'historique de vos commandes.
                    </p>

                    <a
                        href="{{ route('order.history') }}"
                        class="btn btn-info"
                    >
                        Voir mes commandes
                    </a>

                </div>

            </div>

        </div>

    </div>


    <div class="card shadow-sm mt-5">

        <div class="card-body">

            <h4>
                Mon compte
            </h4>

            <hr>

            <p class="mb-2">
                <strong>Nom :</strong>
                {{ auth()->user()->name }}
            </p>

            <p class="mb-0">
                <strong>Email :</strong>
                {{ auth()->user()->email }}
            </p>

        </div>

    </div>

</div>

</body>

</html>
