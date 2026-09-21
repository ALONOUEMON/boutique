<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gestion des produits</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Gestion des produits</h1>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.dashboard') }}"
                class="btn btn-secondary"
            >
                Retour au tableau de bord
            </a>

            <a
                href="{{ route('admin.products.create') }}"
                class="btn btn-primary"
            >
                + Ajouter un produit
            </a>

        </div>

    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($products->isEmpty())

        <div class="alert alert-info">
            Aucun produit n'est enregistré.
        </div>

    @else

        <div class="card shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-striped table-hover mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Catégories</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach ($products as $product)

                            <tr>

                                <td>
                                    {{ $product->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $product->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ number_format($product->price, 2, ',', ' ') }} €
                                </td>

                                <td>
                                    {{ $product->stock }}
                                </td>

                                <td>

                                    @forelse ($product->categories as $category)

                                        <span class="badge bg-primary me-1">
                                            {{ $category->name }}
                                        </span>

                                    @empty

                                        <span class="text-muted">
                                            Aucune catégorie
                                        </span>

                                    @endforelse

                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        <a
                                            href="{{ route('admin.products.show', $product) }}"
                                            class="btn btn-sm btn-info"
                                        >
                                            Voir
                                        </a>

                                        <a
                                            href="{{ route('admin.products.edit', $product) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('admin.products.destroy', $product) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');"
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

                                    </div>

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
