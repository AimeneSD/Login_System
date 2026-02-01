<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/view_users.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="softborder" id="manage-users-container">

        <div class="manage-users-title">
            <h1>Gestion des adhérents</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>login</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td><?= htmlspecialchars($user['nom']) ?></td>
                    <td><?= htmlspecialchars($user['prenom']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['admin']) ?></td>
                    <td>
                        <a href="index.php?page=modify_data_admin&id=<?= $user['id'] ?>" class="link-color">Modifier</a> |
                        <a href="index.php?action=admin_action&id_to_delete=<?= $user['id'] ?>" class="link-color" onclick="return confirm('Supprimer cet utilisateur ?');" style="color: #ff4d4d;">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <a class="link-color" href="index.php?page=admin">Retour au menu admin</a>
        </div>
        </div>
    </main>
</body>
</html>