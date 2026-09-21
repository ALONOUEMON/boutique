<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Modifier le produit</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Modifier le produit</h1>

        <a href="{{ route('admin.products.index') }}"
           class="btn btn-secondary">
            Retour aux produits
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Des erreurs sont présentes :</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form
                action="{{ route('admin.products.update', $product) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nom du produit
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $product->name) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="4"
                    >{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">
                            Prix (€)
                        </label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            class="form-control"
                            step="0.01"
                            min="0"
                            value="{{ old('price', $product->price) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">
                            Stock
                        </label>

                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            class="form-control"
                            min="0"
                            value="{{ old('stock', $product->stock) }}"
                            required
                        >
                    </div>

                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">
                        Image
                    </label>

                    <input
                        type="text"
                        id="image"
                        name="image"
                        class="form-control"
                        value="{{ old('image', $product->image) }}"
                    >

                    <div class="form-text">
                        Laisse vide si le produit n'a pas d'image.
                    </div>
                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Catégories
                    </label>

                    @foreach ($categories as $category)

                        <div class="form-check">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="category{{ $category->id }}"
                                name="category_ids[]"
                                value="{{ $category->id }}"
                                {{ $product->categories->contains($category->id) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="category{{ $category->id }}"
                            >
                                {{ $category->name }}
                            </label>

                        </div>

                    @endforeach

                </div>

                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Enregistrer les modifications
                    </button>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-secondary"
                    >
                        Annuler
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>
