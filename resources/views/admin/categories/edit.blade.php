<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Modifier la catÃ©gorie</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Modifier la catÃ©gorie</h1>

        <a
            href="{{ route('admin.categories.index') }}"
            class="btn btn-secondary"
        >
            Retour aux catÃ©gories
        </a>

    </div>


    {{-- ERREURS --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Des erreurs sont prÃ©sentes :</strong>

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
                action="{{ route('admin.categories.update', $category) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                {{-- NOM --}}
                <div class="mb-3">

                    <label
                        for="name"
                        class="form-label"
                    >
                        Nom de la catÃ©gorie
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $category->name) }}"
                        required
                    >

                </div>


                {{-- DESCRIPTION --}}
                <div class="mb-4">

                    <label
                        for="description"
                        class="form-label"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="4"
                    >{{ old('description', $category->description) }}</textarea>

                </div>


                {{-- PRODUITS --}}
                <div class="mb-4">

                    <h4 class="mb-3">
                        Produits de cette catÃ©gorie
                    </h4>

                    <p class="text-muted">
                        SÃ©lectionnez les produits qui doivent appartenir
                        Ã  cette catÃ©gorie.
                    </p>


                    @if($products->isEmpty())

                        <div class="alert alert-warning">
                            Aucun produit n'existe encore.
                        </div>

                    @else

                        <div class="row">

                            @foreach($products as $product)

                                <div class="col-md-6 col-lg-4 mb-3">

                                    <div class="form-check border rounded p-3">

                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="product{{ $product->id }}"
                                            name="product_ids[]"
                                            value="{{ $product->id }}"
                                            {{ $category->products->contains($product->id) ? 'checked' : '' }}
                                        >

                                        <label
                                            class="form-check-label"
                                            for="product{{ $product->id }}"
                                        >

                                            <strong>
                                                {{ $product->name }}
                                            </strong>

                                            <br>

                                            <small class="text-muted">
                                                {{ number_format($product->price, 2, ',', ' ') }} â‚¬
                                            </small>

                                        </label>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>


                {{-- BOUTONS --}}
                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Enregistrer les modifications
                    </button>

                    <a
                        href="{{ route('admin.categories.index') }}"
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
