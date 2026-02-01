<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="softborder" id=home-container>
            <div class="page-title">
                <img src="assets/img/home-logo.webp" class="little-icon" alt="home-icon">
                <h1>Espace réservé</h1>
            </div>
            <h2>Bienvenue dans l'espace réservé <?php echo htmlspecialchars($username); ?></h2>
            <a class="link-color" href="index.php?page=view_users"><img src="" alt="">Accéder à la page d'administration des utilisateurs</a>
            <a class="link-color" href="index.php?page=accueil">Retourner à l'accueil</a>
            <a class="link-color" href="index.php?action=logout_request">Se déconnecter</a>

        </div>
    </main>
</body>
</html>