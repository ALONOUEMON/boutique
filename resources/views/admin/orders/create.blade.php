<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>CrÃ©er une commande</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    {{-- EN-TÃŠTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>CrÃ©er une commande</h1>

        <a
            href="{{ route('admin.orders.index') }}"
            class="btn btn-secondary"
        >
            Retour aux commandes
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
                action="{{ route('admin.orders.store') }}"
                method="POST"
            >

                @csrf


                {{-- CLIENT --}}
                <div class="mb-4">

                    <label
                        for="user_id"
                        class="form-label fw-bold"
                    >
                        Client
                    </label>

                    <select
                        name="user_id"
                        id="user_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- SÃ©lectionner un client --
                        </option>

                        @foreach ($users as $user)

                            <option
                                value="{{ $user->id }}"
                                {{ old('user_id') == $user->id ? 'selected' : '' }}
                            >
                                {{ $user->name }}
                                â€” {{ $user->email }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- STATUT --}}
                <div class="mb-4">

                    <label
                        for="status"
                        class="form-label fw-bold"
                    >
                        Statut
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select"
                        required
                    >

                        <option
                            value="pending"
                            {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}
                        >
                            En attente
                        </option>

                        <option
                            value="paid"
                            {{ old('status') === 'paid' ? 'selected' : '' }}
                        >
                            PayÃ©e
                        </option>

                        <option
                            value="shipped"
                            {{ old('status') === 'shipped' ? 'selected' : '' }}
                        >
                            ExpÃ©diÃ©e
                        </option>

                        <option
                            value="cancelled"
                            {{ old('status') === 'cancelled' ? 'selected' : '' }}
                        >
                            AnnulÃ©e
                        </option>

                    </select>

                </div>


                {{-- PRODUITS --}}
                <div class="mb-4">

                    <h4 class="mb-3">
                        Produits de la commande
                    </h4>

                    <p class="text-muted">
                        SÃ©lectionnez les produits et indiquez les quantitÃ©s.
                    </p>


                    @if ($products->isEmpty())

                        <div class="alert alert-warning">
                            Aucun produit disponible.
                        </div>

                    @else

                        @foreach ($products as $index => $product)

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="row align-items-center">

                                        {{-- PRODUIT --}}
                                        <div class="col-md-7">

                                            <div class="form-check">

                                                <input
                                                    type="checkbox"
                                                    class="form-check-input product-checkbox"
                                                    id="product{{ $product->id }}"
                                                    name="products[{{ $index }}][id]"
                                                    value="{{ $product->id }}"
                                                >

                                                <label
                                                    class="form-check-label"
                                                    for="product{{ $product->id }}"
                                                >

                                                    <strong>
                                                        {{ $product->name }}
                                                    </strong>

                                                    <br>

                                                    <span class="text-muted">
                                                        {{ number_format($product->price, 2, ',', ' ') }} â‚¬
                                                        â€”
                                                        Stock :
                                                        {{ $product->stock }}
                                                    </span>

                                                </label>

                                            </div>

                                        </div>


                                        {{-- QUANTITÃ‰ --}}
                                        <div class="col-md-5 mt-3 mt-md-0">

                                            <label
                                                for="quantity{{ $product->id }}"
                                                class="form-label"
                                            >
                                                QuantitÃ©
                                            </label>

                                            <input
                                                type="number"
                                                id="quantity{{ $product->id }}"
                                                name="products[{{ $index }}][quantity]"
                                                class="form-control"
                                                min="1"
                                                max="{{ $product->stock }}"
                                                value="1"
                                            >

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @endif

                </div>


                {{-- BOUTONS --}}
                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        CrÃ©er la commande
                    </button>

                    <a
                        href="{{ route('admin.orders.index') }}"
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
