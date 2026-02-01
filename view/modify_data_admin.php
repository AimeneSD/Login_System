<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/modify.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="softborder basic-container" id="modify-cata-container">
            <div class="page-title">
                <img class="little-icon" src="assets/img/modify-icon.webp" alt="">
                <h1>Modifier</h1>
            </div>

            <form action="index.php?action=modify_request" method="post">
                <input type="hidden" name="target_id" value="<?= $userdata_target['id'] ?>">

                <div class="form-element">
                    <label class="form-label">Nom d'utilisateur (Login)</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($userdata_target['login']) ?>" required>
                </div>

                <div class="form-element">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" value="<?= htmlspecialchars($userdata_target['nom']) ?>" required>
                </div>

                <div class="form-element">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" value="<?= htmlspecialchars($userdata_target['prenom']) ?>" required>
                </div>

                <div class="form-element">
                    <label class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($userdata_target['email']) ?>" required>
                </div>

                <div class="form-element">
                    <label class="form-label">Date de naissance</label>
                    <input type="date" name="dateNaissance" value="<?= htmlspecialchars($userdata_target['dateNaissance']) ?>" required>
                </div>

                <div class="form-element">
                    <label class="form-label">Ville de naissance</label>
                    <input type="text" name="villeNaissance" value="<?= htmlspecialchars($userdata_target['villeNaissance'] ?? '') ?>">
                </div>

                <div class="form-element">
                    <label class="form-label">Rôle (1 = Admin, 0 = Membre)</label>
                    <input type="number" name="admin_role" min="0" max="1" value="<?= $userdata_target['admin'] ?>">
                </div>

                <input type="submit" name="modify_data_submit" value="Enregistrer les modifications">
            </form>
        </div>
    </main>
</body>