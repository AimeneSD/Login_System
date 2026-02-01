<?php   

$displaybirthdate = date('d/m/Y', strtotime($userdata['dateNaissance']));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="softborder basic-container" id="profile-container">
            <div class="page-title">
                <img src="assets/img/profile-icon.webp" class="little-icon" alt="profile_icon">
                <h1>Profil</h1>
            </div>
            <?php if (isset($_SESSION['error'])): ?>
                <?php $msg = get_error_message($_SESSION['error']); ?>
                <?php if ($msg): ?>
                    <div class="alert-box alert-error">
                        <?= $msg ?>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <?php $msg = get_success_message($_SESSION['success']); ?>
                <?php if ($msg): ?>
                    <div class="alert-box alert-success">
                        <?= $msg ?>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>


            <div id="userdata-container">
                <div class="profile-row">
                    <span class="white-text profile-label">Pseudo :</span>
                    <span class="grey-text profile-value"><?= htmlspecialchars($userdata['login']) ?></span>
                </div>
                <div class="profile-row">
                    <span class="white-text profile-label">Nom :</span>
                    <span class="grey-text profile-value"><?= htmlspecialchars($userdata['nom']) ?></span>
                </div>
                <div class="profile-row">
                    <span class="white-text profile-label">Prénom :</span>
                    <span class="grey-text profile-value"><?= htmlspecialchars($userdata['prenom']) ?></span>
                </div>
                <div class="profile-row">
                    <span class="white-text profile-label">Email :</span>
                    <span class="grey-text profile-value"><?= htmlspecialchars($userdata['email']) ?></span>
                </div>
                <div class="profile-row">
                    <span class="white-text profile-label">Date de naissance :</span>
                    <span class="grey-text profile-value"><?= $displaybirthdate ?></span>
                </div>
                <div class="profile-row">
                    <span class="white-text profile-label">Ville de naissance :</span>
                    <span class="grey-text profile-value"><?= empty($userdata['villeNaissance']) ?  "Non renseigné" : htmlspecialchars($userdata['villeNaissance'])  ?></span>
                </div>
                <div class="profile-row">
                    <span class="white-text profile-label">Année du Bac :</span>
                    <span class="grey-text profile-value"><?= htmlspecialchars($userdata['Annee_BAC']) ?></span>
                </div>
                <div class="profile-row">
                    <span class="white-text profile-label">Genre :</span>
                    <span class="grey-text profile-value">
                        <?php echo ($userdata['sexe'] == 0) ? "Homme" : "Femme"; ?>
                    </span>
                </div>
            </div>
            <a class="link-color" href="index.php?page=modify_data">Modifier les informations</a>
            <a class="link-color" href="index.php?page=accueil">Retourner à l'accueil</a>
        </div>
    </main>
</body>
</html>