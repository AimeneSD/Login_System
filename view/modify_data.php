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

            <?php if (isset($_SESSION['error'])): ?>
                <?php 
                    // On utilise ta fonction du ErrorModel
                    $msg = get_error_message($_SESSION['error']); 
                    if ($msg): 
                ?>
                    <div class="error-red-border error-red-bg" style="padding: 10px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
                        <span id="error-red-text"><?= $msg ?></span>
                    </div>
                <?php 
                    endif;
                    unset($_SESSION['error']); // On vide la session pour ne pas réafficher le message après un F5
                ?>
            <?php endif; ?>
            <form action="index.php?action=modify_request" method="post">
                <div class="form-element">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($userdata['login']) ?>" required>
                </div>
                <div class="form-element">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($userdata['nom']) ?>" required><br>
                </div>
                <div class="form-element">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($userdata['prenom']) ?>" required><br>
                </div>
                <div class="form-element">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="text" name="email" id="email" value="<?= htmlspecialchars($userdata['eemail']) ?>" required><br>
                </div>
                <div class="form-element">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password"><br>
                    <span class="white-text">12 caractères minimum</span><br>
                    <span class="white-text">1 symbole (!@#$%^&*...)</span><br>
                </div>
                <div class="form-element">
                    <label for="password_conf" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_conf" id="password_conf"><br>
                </div>
                <div class="form-element">
                    <label for="dateNaissance" class="form-label">Date de naissance</label>
                    <input type="date" name="dateNaissance" id="dateNaissance" value="<?= htmlspecialchars($userdata['dateNaissance']) ?>" required>
                </div>
                <div class="form-element">
                    <label for="villeNaissance" class="form-label">Ville de naissance</label>
                    <input type="text" name="villeNaissance" id="villeNaissance" value="<?= $userdata['villeNaissance'] ?? '' ?>">
                </div>
                <div class="form-element">
                    <label for="sexe" class="form-label">Genre:</label>

                    <div id="genrechoices">
                        <div class="genrechoice">
                            <input type="radio" name="sexe" id="genrechoice1" value="0" <?= ($userdata['sexe'] == '0') ? 'checked':'' ?>>
                            <label for="genrechoice1" class="form-label">Homme</label>
                        </div>
                        <div class="genrechoice">
                            <input type="radio" name="sexe" id="genrechoice2" value="1" <?= ($userdata['sexe'] == '1') ? 'checked':'' ?>>
                            <label for="genrechoice2" class="form-label">Femme</label>
                        </div>
                    </div>
                </div>
                <div class="form-element">
                    <label for="Annee_BAC" class="form-label">Année d'obtention du Baccalauréat</label>

                    <select name="Annee_BAC">
                        <?php 
                        $anneeActuelle= date('Y');
                        $anneeSelectionnee = $userdata['Annee_BAC'];
                        $anneedepart = 1960;

                        for($i = $anneeActuelle; $i>=1960; $i--){
                            $selected = ($i == $anneeSelectionnee)? "selected" : "";
                            echo "<option value='$i' $selected>$i</option>";
                        }; ?>
                    </select>
                </div>
                <div>
                    <input type="submit" name="modify_data_submit" value="Modifier">
                </div>
            </form>
            <br>
            <a class="link-color" href="index.php?page=profile">Retourner au profil</a>
        </div>
    </main>
</body>
</html>