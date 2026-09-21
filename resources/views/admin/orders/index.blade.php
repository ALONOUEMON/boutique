<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Gestion des commandes</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body class="bg-light">


<div class="container py-5">


    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="mb-1">
                Gestion des commandes
            </h1>

            <p class="text-muted mb-0">
                Consultez et gérez les commandes des clients.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.dashboard') }}"
                class="btn btn-secondary"
            >
                Administration
            </a>


            <a
                href="{{ route('admin.orders.create') }}"
                class="btn btn-success"
            >
                + Nouvelle commande
            </a>

        </div>

    </div>


    {{-- MESSAGE DE SUCCÈS --}}
    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- MESSAGE D'ERREUR --}}
    @if (session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ERREURS DE VALIDATION --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Une erreur est survenue :
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- AUCUNE COMMANDE --}}
    @if ($orders->isEmpty())

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <h4>
                    Aucune commande
                </h4>

                <p class="text-muted">
                    Aucune commande n'est actuellement enregistrée.
                </p>


                <a
                    href="{{ route('admin.orders.create') }}"
                    class="btn btn-success"
                >
                    Créer une commande
                </a>

            </div>

        </div>


    @else


        {{-- TABLEAU DES COMMANDES --}}
        <div class="card shadow-sm">

            <div class="card-header bg-dark text-white">

                <strong>
                    Liste des commandes
                </strong>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-striped table-hover mb-0 align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Client
                                </th>

                                <th>
                                    Total
                                </th>

                                <th>
                                    Statut
                                </th>

                                <th>
                                    Date
                                </th>

                                <th class="text-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        @foreach ($orders as $order)

                            <tr>


                                {{-- ID --}}
                                <td>

                                    <strong>
                                        #{{ $order->id }}
                                    </strong>

                                </td>


                                {{-- CLIENT --}}
                                <td>

                                    @if ($order->user)

                                        <strong>
                                            {{ $order->user->name }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ $order->user->email }}
                                        </small>

                                    @else

                                        <span class="text-danger">
                                            Utilisateur supprimé
                                        </span>

                                    @endif

                                </td>


                                {{-- TOTAL --}}
                                <td>

                                    <strong>
                                        {{ number_format($order->total, 2, ',', ' ') }} €
                                    </strong>

                                </td>


                                {{-- STATUT --}}
                                <td>


                                    @if ($order->status === 'pending')

                                        <span class="badge bg-warning text-dark">
                                            En attente
                                        </span>


                                    @elseif ($order->status === 'paid')

                                        <span class="badge bg-success">
                                            Payée
                                        </span>


                                    @elseif ($order->status === 'shipped')

                                        <span class="badge bg-primary">
                                            Expédiée
                                        </span>


                                    @elseif ($order->status === 'cancelled')

                                        <span class="badge bg-danger">
                                            Annulée
                                        </span>


                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $order->status }}
                                        </span>

                                    @endif


                                </td>


                                {{-- DATE --}}
                                <td>

                                    @if ($order->created_at)

                                        {{ $order->created_at->format('d/m/Y') }}

                                        <br>

                                        <small class="text-muted">
                                            {{ $order->created_at->format('H:i') }}
                                        </small>

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- ACTIONS --}}
                                <td class="text-center">


                                    {{-- VOIR --}}
                                    <a
                                        href="{{ route('admin.orders.show', $order) }}"
                                        class="btn btn-sm btn-primary"
                                    >
                                        Voir
                                    </a>


                                    {{-- SUPPRIMER --}}
                                    <form
                                        action="{{ route('admin.orders.destroy', $order) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer la commande #{{ $order->id }} ?');"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                        >
                                            Supprimer
                                        </button>

                                    </form>


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


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>
