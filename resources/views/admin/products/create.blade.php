<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ajouter un produit</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
            Administration
        </a>

        <span class="text-white">
            {{ auth()->user()->name }}
        </span>

    </div>
</nav>

<div class="container py-5">

    <div class="mb-4">

        <h1>Ajouter un produit</h1>

        <p class="text-muted">
            Ajouter un nouveau produit à la boutique.
        </p>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Veuillez corriger les erreurs suivantes :</strong>

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
                action="{{ route('admin.products.store') }}"
                method="POST"
            >

                @csrf

                <div class="mb-3">

                    <label for="name" class="form-label">
                        Nom du produit
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        rows="5"
                    >{{ old('description') }}</textarea>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label for="price" class="form-label">
                            Prix (€)
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            class="form-control"
                            value="{{ old('price') }}"
                            min="0"
                            step="0.01"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label for="stock" class="form-label">
                            Stock
                        </label>

                        <input
                            type="number"
                            name="stock"
                            id="stock"
                            class="form-control"
                            value="{{ old('stock', 0) }}"
                            min="0"
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
                        name="image"
                        id="image"
                        class="form-control"
                        value="{{ old('image') }}"
                        placeholder="exemple.jpg"
                    >

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Catégories
                    </label>

                    @forelse($categories as $category)

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="category_ids[]"
                                value="{{ $category->id }}"
                                id="category_{{ $category->id }}"
                                {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="category_{{ $category->id }}"
                            >
                                {{ $category->name }}
                            </label>

                        </div>

                    @empty

                        <div class="alert alert-warning">
                            Aucune catégorie n'existe encore.
                        </div>

                    @endforelse

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Ajouter le produit
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