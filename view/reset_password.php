<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de mot de passe</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/view_users.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <main>
        <div class="softborder basic-container">
            <div class="page-title">
                <h1>Nouveau mot de passe</h1>
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

            
            <form action="index.php?action=reset_password_request" method="post">
                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                
                <div class="form-element">
                    <input type="password" name="password" placeholder="Nouveau mot de passe" required>
                </div>
                <div class="form-element">
                    <input type="password" name="password_conf" placeholder="Confirmez le mot de passe" required>
                </div>
                <div class="form-element">
                    <input type="submit" name="reset_submit" value="Changer le mot de passe">
                </div>
            </form>
        </div>
    </main>
</body>
</html>