<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier l'utilisateur</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Modifier l'utilisateur</h1>

        <a
            href="{{ route('admin.users.index') }}"
            class="btn btn-secondary"
        >
            Retour aux utilisateurs
        </a>
    </div>

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
                action="{{ route('admin.users.update', $user) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nom
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Adresse e-mail
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Nouveau mot de passe
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                    >

                    <div class="form-text">
                        Laisse vide pour conserver le mot de passe actuel.
                        Minimum 8 caractÃ¨res si tu souhaites le modifier.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">
                        Confirmer le nouveau mot de passe
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                    >
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">
                        RÃ´le
                    </label>

                    <select
                        id="role"
                        name="role"
                        class="form-select"
                        required
                    >
                        <option
                            value="user"
                            {{ old('role', $user->role) === 'user' ? 'selected' : '' }}
                        >
                            Utilisateur
                        </option>

                        <option
                            value="admin"
                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}
                        >
                            Administrateur
                        </option>
                    </select>
                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Enregistrer les modifications
                    </button>

                    <a
                        href="{{ route('admin.users.index') }}"
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
