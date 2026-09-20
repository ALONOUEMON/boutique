<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mes commandes</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Mes commandes</h1>

        <a
            href="{{ url('/') }}"
            class="btn btn-secondary"
        >
            Retour à la boutique
        </a>

    </div>


    @if($orders->isEmpty())

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <h3>Aucune commande</h3>

                <p class="text-muted">
                    Vous n'avez pas encore passé de commande.
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

        <div class="card shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-striped table-hover mb-0 align-middle">

                        <thead class="table-dark">

                            <tr>
                                <th>Commande</th>
                                <th>Total</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach($orders as $order)

                            <tr>

                                <td>
                                    <strong>
                                        #{{ $order->id }}
                                    </strong>
                                </td>

                                <td>
                                    <strong>
                                        {{ number_format($order->total, 2, ',', ' ') }} €
                                    </strong>
                                </td>

                                <td>

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

                                </td>

                                <td>
                                    {{ $order->created_at->format('d/m/Y à H:i') }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('order.success', $order) }}"
                                        class="btn btn-sm btn-primary"
                                    >
                                        Voir
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @endif

</div>

</body>

</html>