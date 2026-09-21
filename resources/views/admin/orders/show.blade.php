<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DÃ©tail de la commande</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>
            Commande #{{ $order->id }}
        </h1>

        <a
            href="{{ route('admin.orders.index') }}"
            class="btn btn-secondary"
        >
            Retour aux commandes
        </a>

    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Informations client --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <strong>Informations du client</strong>
        </div>

        <div class="card-body">

            @if ($order->user)

                <p class="mb-1">
                    <strong>Nom :</strong>
                    {{ $order->user->name }}
                </p>

                <p class="mb-0">
                    <strong>Email :</strong>
                    {{ $order->user->email }}
                </p>

            @else

                <p class="mb-0 text-muted">
                    Utilisateur supprimÃ©
                </p>

            @endif

        </div>

    </div>

    {{-- Informations commande --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <strong>Informations de la commande</strong>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4">
                    <strong>NumÃ©ro :</strong>
                    #{{ $order->id }}
                </div>

                <div class="col-md-4">
                    <strong>Date :</strong>
                    {{ $order->created_at?->format('d/m/Y H:i') }}
                </div>

                <div class="col-md-4">

                    <strong>Statut :</strong>

                    @if ($order->status === 'pending')

                        <span class="badge bg-warning text-dark">
                            En attente
                        </span>

                    @elseif ($order->status === 'paid')

                        <span class="badge bg-success">
                            PayÃ©e
                        </span>

                    @elseif ($order->status === 'shipped')

                        <span class="badge bg-primary">
                            ExpÃ©diÃ©e
                        </span>

                    @elseif ($order->status === 'cancelled')

                        <span class="badge bg-danger">
                            AnnulÃ©e
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            {{ $order->status }}
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- Produits --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <strong>Produits commandÃ©s</strong>
        </div>

        <div class="card-body p-0">

            @if ($order->items->isEmpty())

                <div class="p-3">
                    <div class="alert alert-info mb-0">
                        Aucun produit dans cette commande.
                    </div>
                </div>

            @else

                <div class="table-responsive">

                    <table class="table table-striped mb-0">

                        <thead class="table-dark">

                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>QuantitÃ©</th>
                                <th>Sous-total</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach ($order->items as $item)

                            <tr>

                                <td>
                                    @if ($item->product)
                                        {{ $item->product->name }}
                                    @else
                                        Produit supprimÃ©
                                    @endif
                                </td>

                                <td>
                                    {{ number_format($item->price, 2, ',', ' ') }} â‚¬
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    {{ number_format($item->price * $item->quantity, 2, ',', ' ') }} â‚¬
                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </div>

    {{-- Total --}}
    <div class="card shadow-sm mb-4">

        <div class="card-body text-end">

            <h3>
                Total :
                {{ number_format($order->total, 2, ',', ' ') }} â‚¬
            </h3>

        </div>

    </div>

    {{-- Modification du statut --}}
    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Modifier le statut</strong>
        </div>

        <div class="card-body">

            <form
                action="{{ route('admin.orders.updateStatus', $order) }}"
                method="POST"
            >

                @csrf

                <div class="row align-items-end">

                    <div class="col-md-8">

                        <label
                            for="status"
                            class="form-label"
                        >
                            Nouveau statut
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select"
                            required
                        >

                            <option
                                value="pending"
                                {{ $order->status === 'pending' ? 'selected' : '' }}
                            >
                                En attente
                            </option>

                            <option
                                value="paid"
                                {{ $order->status === 'paid' ? 'selected' : '' }}
                            >
                                PayÃ©e
                            </option>

                            <option
                                value="shipped"
                                {{ $order->status === 'shipped' ? 'selected' : '' }}
                            >
                                ExpÃ©diÃ©e
                            </option>

                            <option
                                value="cancelled"
                                {{ $order->status === 'cancelled' ? 'selected' : '' }}
                            >
                                AnnulÃ©e
                            </option>

                        </select>

                    </div>

                    <div class="col-md-4 mt-3 mt-md-0">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Mettre Ã  jour le statut
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>
