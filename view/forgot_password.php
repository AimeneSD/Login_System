<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rénitialisation du mot de passe</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="softborder basic-container">
            <div class="page-title">
                <h1>Renitialisation du mot de passe</h1>
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


            <form action="index.php?action=reset_password_request" method="POST">
                <div class="form-element">
                    <input type="email" name="email" placeholder="Veuillez saisir l'adresse email associé au compte">
                </div>
                <div class="form-element">
                    <input type="submit" name="forgot_submit" value="Soumettre">
                </div>
            </form>
            <a class="link-color" href="index.php?page=login">Retourner à la connexion</a>
        </div>
    </main>
</body>
</html>