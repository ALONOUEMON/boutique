<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Valider ma commande</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Valider ma commande</h1>

        <a
            href="{{ route('cart.index') }}"
            class="btn btn-secondary"
        >
            Retour au panier
        </a>

    </div>


    {{-- Message d'erreur --}}
    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    @php
        $cartItems = \App\Models\CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = 0;
    @endphp


    @if($cartItems->isEmpty())

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <h3>Votre panier est vide</h3>

                <p class="text-muted">
                    Vous devez ajouter au moins un produit avant de passer une commande.
                </p>

                <a
                    href="{{ url('/') }}"
                    class="btn btn-primary"
                >
                    Voir les produits
                </a>

            </div>

        </div>

    @else

        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <h4 class="mb-0">
                    Récapitulatif de votre commande
                </h4>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-striped mb-0">

                        <thead class="table-dark">

                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach($cartItems as $item)

                            @if($item->product)

                                @php
                                    $lineTotal = $item->product->price * $item->quantity;
                                    $total += $lineTotal;
                                @endphp

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $item->product->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ number_format($item->product->price, 2, ',', ' ') }} €
                                    </td>

                                    <td>
                                        {{ $item->quantity }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ number_format($lineTotal, 2, ',', ' ') }} €
                                        </strong>
                                    </td>

                                </tr>

                            @endif

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <div class="card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h3>
                        Total à payer
                    </h3>

                    <h2 class="text-success">
                        {{ number_format($total, 2, ',', ' ') }} €
                    </h2>

                </div>


                <form
                    action="{{ route('order.store') }}"
                    method="POST"
                >

                    @csrf

                    <div class="alert alert-info">

                        <strong>Confirmation</strong>

                        <p class="mb-0 mt-2">
                            En cliquant sur « Confirmer la commande »,
                            votre commande sera enregistrée.
                        </p>

                    </div>


                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('cart.index') }}"
                            class="btn btn-secondary"
                        >
                            Modifier mon panier
                        </a>

                        <button
                            type="submit"
                            class="btn btn-success"
                        >
                            Confirmer la commande
                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif

</div>

</body>

</html>
