<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DÃ©tail du produit</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>DÃ©tail du produit</h1>

        <a href="{{ route('admin.products.index') }}"
           class="btn btn-secondary">
            Retour aux produits
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h2 class="mb-4">{{ $product->name }}</h2>

            <div class="mb-3">
                <strong>Description :</strong>
                <p class="mt-2">
                    {{ $product->description ?: 'Aucune description' }}
                </p>
            </div>

            <div class="mb-3">
                <strong>Prix :</strong>
                <span class="ms-2">
                    {{ number_format($product->price, 2, ',', ' ') }} â‚¬
                </span>
            </div>

            <div class="mb-3">
                <strong>Stock :</strong>
                <span class="ms-2">
                    {{ $product->stock }}
                </span>
            </div>

            <div class="mb-3">
                <strong>CatÃ©gories :</strong>

                <div class="mt-2">
                    @forelse($product->categories as $category)
                        <span class="badge bg-primary me-1">
                            {{ $category->name }}
                        </span>
                    @empty
                        <span class="text-muted">
                            Aucune catÃ©gorie
                        </span>
                    @endforelse
                </div>
            </div>

            <div class="mb-4">
                <strong>Image :</strong>

                @if($product->image)
                    <div class="mt-2">
                        <img
                            src="{{ $product->image }}"
                            alt="{{ $product->name }}"
                            class="img-fluid"
                            style="max-width: 300px;"
                        >
                    </div>
                @else
                    <span class="text-muted ms-2">
                        Aucune image
                    </span>
                @endif
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('admin.products.edit', $product) }}"
                   class="btn btn-warning">
                    Modifier
                </a>

                <form
                    action="{{ route('admin.products.destroy', $product) }}"
                    method="POST"
                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Supprimer
                    </button>
                </form>

            </div>

        </div>
    </div>

</div>

</body>
</html>
