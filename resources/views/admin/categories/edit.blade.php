<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Modifier la catégorie</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Modifier la catégorie</h1>

        <a
            href="{{ route('admin.categories.index') }}"
            class="btn btn-secondary"
        >
            Retour aux catégories
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
                action="{{ route('admin.categories.update', $category) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nom de la catégorie
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

                <div class="mb-4">
                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="4"
                    >{{ old('description', $category->description) }}</textarea>
                </div>

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