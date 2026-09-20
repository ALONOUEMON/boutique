<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Boutique</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-5">

    <div class="container">

        <a
            href="{{ url('/') }}"
            class="navbar-brand"
        >
            Ma Boutique
        </a>

        <div class="d-flex gap-2">

            <a
                href="{{ route('cart.index') }}"
                class="btn btn-outline-light"
            >
                🛒 Panier
            </a>

            @auth

                @if(auth()->user()->isAdmin())

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="btn btn-warning"
                    >
                        Administration
                    </a>

                @endif

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

            @else

                <a
                    href="{{ route('login') }}"
                    class="btn btn-outline-light"
                >
                    Connexion
                </a>

                <a
                    href="{{ route('register') }}"
                    class="btn btn-primary"
                >
                    Inscription
                </a>

            @endauth

        </div>

    </div>

</nav>


<div class="container">

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    @php
        $products = \App\Models\Product::with('categories')
            ->latest()
            ->get();
    @endphp


    <div class="text-center mb-5">

        <h1>
            Nos produits
        </h1>

        <p class="text-muted">
            Découvrez les produits disponibles dans notre boutique.
        </p>

    </div>


    @if($products->isEmpty())

        <div class="alert alert-info text-center">
            Aucun produit n'est disponible pour le moment.
        </div>

    @else

        <div class="row g-4">

            @foreach($products as $product)

                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm">

                        @if($product->image)

                            <img
                                src="{{ $product->image }}"
                                class="card-img-top"
                                alt="{{ $product->name }}"
                                style="height: 220px; object-fit: cover;"
                            >

                        @else

                            <div
                                class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                style="height: 220px;"
                            >
                                Aucune image
                            </div>

                        @endif


                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">
                                {{ $product->name }}
                            </h5>


                            <p class="card-text text-muted">

                                {{ $product->description ?: 'Aucune description disponible.' }}

                            </p>


                            @if($product->categories->isNotEmpty())

                                <div class="mb-3">

                                    @foreach($product->categories as $category)

                                        <span class="badge bg-secondary">
                                            {{ $category->name }}
                                        </span>

                                    @endforeach

                                </div>

                            @endif


                            <div class="mt-auto">

                                <h4 class="text-success mb-2">

                                    {{ number_format($product->price, 2, ',', ' ') }} €

                                </h4>


                                @if($product->stock > 0)

                                    <p class="text-success">
                                        Stock disponible :
                                        {{ $product->stock }}
                                    </p>


                                    <form
                                        action="{{ route('cart.add', $product) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <div class="input-group">

                                            <input
                                                type="number"
                                                name="quantity"
                                                value="1"
                                                min="1"
                                                max="{{ $product->stock }}"
                                                class="form-control"
                                            >

                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >
                                                Ajouter au panier
                                            </button>

                                        </div>

                                    </form>

                                @else

                                    <div class="alert alert-danger mb-0">
                                        Produit en rupture de stock.
                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

</body>

</html>