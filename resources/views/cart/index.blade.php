<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mon panier</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>🛒 Votre panier</h1>

        <a href="{{ url('/') }}" class="btn btn-secondary">
            Continuer mes achats
        </a>
    </div>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Message d'erreur --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Erreurs de validation --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Une erreur est survenue :</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if($items->isEmpty())

        <div class="card shadow-sm">
            <div class="card-body text-center py-5">

                <h3>Votre panier est vide</h3>

                <p class="text-muted">
                    Vous n'avez encore ajouté aucun produit à votre panier.
                </p>

                <a href="{{ url('/') }}" class="btn btn-primary">
                    Voir les produits
                </a>

            </div>
        </div>

    @else

        @php
            $total = 0;
        @endphp

        <div class="card shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-striped table-hover align-middle mb-0">

                        <thead class="table-dark">

                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach($items as $item)

                            @php

                                if (auth()->check()) {
                                    $product = $item->product;
                                    $quantity = $item->quantity;
                                } else {
                                    $product = \App\Models\Product::find($item['product_id']);
                                    $quantity = $item['quantity'];
                                }

                            @endphp

                            @if($product)

                                @php
                                    $lineTotal = $product->price * $quantity;
                                    $total += $lineTotal;
                                @endphp

                                <tr>

                                    {{-- Produit --}}
                                    <td>
                                        <strong>
                                            {{ $product->name }}
                                        </strong>
                                    </td>

                                    {{-- Prix --}}
                                    <td>
                                        {{ number_format($product->price, 2, ',', ' ') }} €
                                    </td>

                                    {{-- Quantité --}}
                                    <td>

                                        <form
                                            action="{{ route('cart.update', $product) }}"
                                            method="POST"
                                            class="d-flex gap-2"
                                        >

                                            @csrf

                                            <input
                                                type="number"
                                                name="quantity"
                                                value="{{ $quantity }}"
                                                min="1"
                                                max="{{ $product->stock }}"
                                                class="form-control"
                                                style="width: 90px;"
                                                required
                                            >

                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >
                                                Modifier
                                            </button>

                                        </form>

                                        <small class="text-muted">
                                            Stock disponible :
                                            {{ $product->stock }}
                                        </small>

                                    </td>

                                    {{-- Total ligne --}}
                                    <td>
                                        <strong>
                                            {{ number_format($lineTotal, 2, ',', ' ') }} €
                                        </strong>
                                    </td>

                                    {{-- Actions --}}
                                    <td>

                                        <form
                                            action="{{ route('cart.remove', $product) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                            >
                                                Supprimer
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endif

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- Total du panier --}}
        <div class="card shadow-sm mt-4">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <h4 class="mb-0">
                        Total du panier
                    </h4>

                    <h3 class="mb-0 text-success">
                        {{ number_format($total, 2, ',', ' ') }} €
                    </h3>

                </div>

                <hr>

                @auth

                    <div class="text-end">

                        <a
                            href="{{ route('order.create') }}"
                            class="btn btn-success btn-lg"
                        >
                            Valider la commande
                        </a>

                    </div>

                @else

                    <div class="alert alert-warning mb-0">

                        Vous devez être connecté pour valider votre commande.

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-warning ms-2"
                        >
                            Se connecter
                        </a>

                    </div>

                @endauth

            </div>

        </div>

    @endif

</div>

</body>
</html>
