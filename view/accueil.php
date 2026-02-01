<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Personnel</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/accueil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="softborder" id=home-container>
            <div class="page-title">
                <img src="assets/img/home-logo.webp" class="little-icon" alt="home-icon">
                <h1>Accueil</h1>
            </div>
            <h2>Bienvenue dans votre espace personnel <?php echo htmlspecialchars($username); ?></h2>
            <a class="link-color" href="index.php?page=profile">Accéder au profil</a>
            <?php if($is_admin):?>
                <a class="link-color" href="index.php?page=admin">Accéder à l'espace réservé</a>
            <?php endif; ?>
            <a class="link-color" href="index.php?action=logout_request">Se déconnecter</a>
        </div>
    </main>
</body>
</html>