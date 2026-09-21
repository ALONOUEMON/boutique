<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gestion des utilisateurs</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Gestion des utilisateurs</h1>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.dashboard') }}"
                class="btn btn-secondary"
            >
                Retour au tableau de bord
            </a>

            <a
                href="{{ route('admin.users.create') }}"
                class="btn btn-primary"
            >
                + Ajouter un utilisateur
            </a>

        </div>

    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($users->isEmpty())

        <div class="alert alert-info">
            Aucun utilisateur n'est enregistré.
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
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach ($users as $user)

                            <tr>

                                <td>
                                    {{ $user->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $user->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>

                                    @if ($user->role === 'admin')
                                        <span class="badge bg-danger">
                                            Administrateur
                                        </span>
                                    @else
                                        <span class="badge bg-info">
                                            Utilisateur
                                        </span>
                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        <a
                                            href="{{ route('admin.users.edit', $user) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');"
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
