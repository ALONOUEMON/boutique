<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administration</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        .admin-card {
            text-decoration: none;
            color: white;
            display: block;
            transition: transform 0.2s, opacity 0.2s;
            height: 100%;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            opacity: 0.9;
            color: white;
        }

        .card-products {
            background-color: #2563eb;
        }

        .card-categories {
            background-color: #16a34a;
        }

        .card-users {
            background-color: #9333ea;
        }

        .card-orders {
            background-color: #ea580c;
        }
    </style>
</head>

<body class="bg-light">

{{-- NAVBAR ADMIN --}}
<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">

        <a
            href="{{ route('admin.dashboard') }}"
            class="navbar-brand fw-bold"
        >
            ðŸ› ï¸ Administration
        </a>

        <div class="d-flex align-items-center gap-2">

            <a
                href="{{ url('/') }}"
                class="btn btn-outline-light btn-sm"
            >
                ðŸ  Boutique
            </a>

            <a
                href="{{ route('profile.edit') }}"
                class="btn btn-outline-light btn-sm"
            >
                ðŸ‘¤ {{ auth()->user()->name }}
            </a>

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="d-inline"
            >
                @csrf

                <button
                    type="submit"
                    class="btn btn-danger btn-sm"
                >
                    ðŸšª DÃ©connexion
                </button>
            </form>

        </div>
    </div>
</nav>


<div class="container py-5">

    {{-- TITRE --}}
    <div class="mb-5">
        <h1 class="display-5 fw-bold">
            Panneau d'administration
        </h1>

        <p class="lead mt-3">
            Bienvenue, {{ auth()->user()->name }}.
        </p>

        <p class="text-muted">
            Vous Ãªtes connectÃ© en tant qu'administrateur.
        </p>
    </div>


    {{-- CARTES --}}
    <div class="row g-4">

        {{-- PRODUITS --}}
        <div class="col-md-6 col-lg-3">
            <a
                href="{{ route('admin.products.index') }}"
                class="admin-card card-products rounded p-4 shadow-sm"
            >
                <h2 class="h3 fw-bold">
                    Produits
                </h2>

                <p class="mt-4 mb-0">
                    GÃ©rer les produits de la boutique.
                </p>

                <div class="mt-4">
                    <strong>
                        â†’ GÃ©rer les produits
                    </strong>
                </div>
            </a>
        </div>


        {{-- CATEGORIES --}}
        <div class="col-md-6 col-lg-3">
            <a
                href="{{ route('admin.categories.index') }}"
                class="admin-card card-categories rounded p-4 shadow-sm"
            >
                <h2 class="h3 fw-bold">
                    CatÃ©gories
                </h2>

                <p class="mt-4 mb-0">
                    GÃ©rer les catÃ©gories.
                </p>

                <div class="mt-4">
                    <strong>
                        â†’ GÃ©rer les catÃ©gories
                    </strong>
                </div>
            </a>
        </div>


        {{-- UTILISATEURS --}}
        <div class="col-md-6 col-lg-3">
            <a
                href="{{ route('admin.users.index') }}"
                class="admin-card card-users rounded p-4 shadow-sm"
            >
                <h2 class="h3 fw-bold">
                    Utilisateurs
                </h2>

                <p class="mt-4 mb-0">
                    GÃ©rer les utilisateurs.
                </p>

                <div class="mt-4">
                    <strong>
                        â†’ GÃ©rer les utilisateurs
                    </strong>
                </div>
            </a>
        </div>


        {{-- COMMANDES --}}
        <div class="col-md-6 col-lg-3">
            <a
                href="{{ route('admin.orders.index') }}"
                class="admin-card card-orders rounded p-4 shadow-sm"
            >
                <h2 class="h3 fw-bold">
                    Commandes
                </h2>

                <p class="mt-4 mb-0">
                    GÃ©rer les commandes.
                </p>

                <div class="mt-4">
                    <strong>
                        â†’ GÃ©rer les commandes
                    </strong>
                </div>
            </a>
        </div>

    </div>

</div>

</body>
</html>
