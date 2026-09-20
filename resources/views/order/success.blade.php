<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Commande confirmée</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm">

        <div class="card-body text-center py-5">

            <div class="mb-4">
                <span class="display-1">✅</span>
            </div>

            <h1 class="text-success">
                Commande confirmée !
            </h1>

            <p class="lead mt-3">
                Merci pour votre commande.
            </p>

            <p>
                Votre commande
                <strong>#{{ $order->id }}</strong>
                a bien été enregistrée.
            </p>

        </div>

    </div>


    <div class="card shadow-sm mt-4">

        <div class="card-header">
            <h4 class="mb-0">
                Récapitulatif de la commande
            </h4>
        </div>

        <div class="card-body">

            <div class="row mb-4">

                <div class="col-md-6">
                    <strong>Numéro de commande :</strong>
                    #{{ $order->id }}
                </div>

                <div class="col-md-6">
                    <strong>Statut :</strong>

                    @if($order->status === 'pending')
                        <span class="badge bg-warning text-dark">
                            En attente
                        </span>
                    @elseif($order->status === 'paid')
                        <span class="badge bg-success">
                            Payée
                        </span>
                    @elseif($order->status === 'shipped')
                        <span class="badge bg-primary">
                            Expédiée
                        </span>
                    @elseif($order->status === 'cancelled')
                        <span class="badge bg-danger">
                            Annulée
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            {{ $order->status }}
                        </span>
                    @endif

                </div>

            </div>


            <div class="table-responsive">

                <table class="table table-striped">

                    <thead class="table-dark">

                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>

                    </thead>

                    <tbody>

                    @foreach($order->items as $item)

                        @if($item->product)

                            <tr>

                                <td>
                                    {{ $item->product->name }}
                                </td>

                                <td>
                                    {{ number_format($item->price, 2, ',', ' ') }} €
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    <strong>
                                        {{ number_format($item->price * $item->quantity, 2, ',', ' ') }} €
                                    </strong>
                                </td>

                            </tr>

                        @endif

                    @endforeach

                    </tbody>

                </table>

            </div>


            <div class="d-flex justify-content-end mt-4">

                <h3>
                    Total :
                    <span class="text-success">
                        {{ number_format($order->total, 2, ',', ' ') }} €
                    </span>
                </h3>

            </div>

        </div>

    </div>


    <div class="d-flex justify-content-center gap-3 mt-4">

        <a
            href="{{ route('order.history') }}"
            class="btn btn-primary"
        >
            Voir mes commandes
        </a>

        <a
            href="{{ url('/') }}"
            class="btn btn-secondary"
        >
            Retour à la boutique
        </a>

    </div>

</div>

</body>

</html>