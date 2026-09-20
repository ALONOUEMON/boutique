<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>

<body style="margin:0; padding:40px; font-family:Arial,sans-serif; background:#f1f5f9;">

    <h1 style="font-size:40px;">
        Panneau d'administration
    </h1>

    <p>
        Bienvenue, {{ auth()->user()->name }}.
    </p>

    <div style="display:flex; gap:20px; margin-top:30px; flex-wrap:wrap;">

        <div style="background:#2563eb; color:white; padding:30px; width:220px;">
            <h2>Produits</h2>
            <p>Gérer les produits de la boutique.</p>
        </div>

        <div style="background:#16a34a; color:white; padding:30px; width:220px;">
            <h2>Catégories</h2>
            <p>Gérer les catégories.</p>
        </div>

        <div style="background:#9333ea; color:white; padding:30px; width:220px;">
            <h2>Utilisateurs</h2>
            <p>Gérer les utilisateurs.</p>
        </div>

        <div style="background:#ea580c; color:white; padding:30px; width:220px;">
            <h2>Commandes</h2>
            <p>Gérer les commandes.</p>
        </div>

    </div>

</body>
</html>