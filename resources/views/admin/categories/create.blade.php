<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ajouter une catÃ©gorie</title>

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

    <h1>Ajouter une catÃ©gorie</h1>

    <p class="text-muted">
        CrÃ©er une nouvelle catÃ©gorie pour la boutique.
    </p>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.categories.store') }}"
                method="POST"
            >

                @csrf

                <div class="mb-3">

                    <label for="name" class="form-label">
                        Nom de la catÃ©gorie
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
                        rows="4"
                    >{{ old('description') }}</textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Ajouter la catÃ©gorie
                </button>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-secondary"
                >
                    Annuler
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>
