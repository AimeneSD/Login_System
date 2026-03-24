<?php

require_once 'models/UserModel.php';
require_once 'models/ErrorModel.php';

// Define the error input class based on whether a session error exists
$ErrorInputClass = isset($_SESSION['error']) ? 'input-error' : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="softborder " id="login_container">
            <div class="page-title">
                <h1 id="form-title">Je me connecte</h1>
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

            <form action="index.php?action=login_request" method="post">
                <div class="form-element">
                    <label class="form-label" for="email">Adresse e-mail</label>
                    <input type="text" name="email" id="email" class="<?=$ErrorInputClass?>" required>
                    <a class="link-color" href="index.php?page=forgot_password">Mot de passe oublié ?</a>
                </div>

                <div class="form-element">
                    <label class="form-label" for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="<?= $ErrorInputClass ?>" required>
                </div>
                <div class="form-element">
                    <input type="submit" name="login_submit" value="Se connecter">
                </div>
                <div><span class="white-text">Pas encore inscrit ? </span><a class="link-color" href="index.php?page=signup">Inscrivez-vous ici</a></div>
            </form>
        </div>
    </main>
</body>
</html>