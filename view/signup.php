<?php 

$error= $_SESSION['error']?? "";
$error_message = get_error_message($error);


require_once 'models/UserModel.php';
require_once 'models/ErrorModel.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>

        <div class="softborder" id="login_container">
            
            <div class="page-title">
                <h1>Je crée un compte</h1>
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


            <form action="index.php?action=signup_request" method="post">
                <div class="form-element">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($_SESSION['inputs']['nom'] ?? '') ?>" required><br>
                </div>
                <div class="form-element">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($_SESSION['inputs']['prenom'] ?? '') ?>" required><br>
                </div>
                <div class="form-element">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="text" name="email" id="email" value="<?= htmlspecialchars($_SESSION['inputs']['email'] ?? '') ?>" required><br>
                </div>
                <div class="form-element">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($_SESSION['inputs']['username'] ?? '') ?>" required>
                </div>
                <div class="form-element">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" required><br>
                    <span class="white-text">12 caractères minimum</span><br>
                    <span class="white-text">1 symbole (!@#$%^&*...)</span><br>
                </div>
                <div class="form-element">
                    <label for="password_conf" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_conf" id="password_conf" required><br>
                </div>
                <div class="form-element">
                    <label for="dateNaissance" class="form-label">Date de naissance</label>
                    <input type="date" name="dateNaissance" id="dateNaissance" value="<?= htmlspecialchars($_SESSION['inputs']['dateNaissance'] ?? '') ?>" required>
                </div>
                <div class="form-element">
                    <label for="villeNaissance" class="form-label">Ville de naissance (Facultatif)</label>
                    <input type="text" name="villeNaissance" id="villeNaissance" value="<?= htmlspecialchars($_SESSION['inputs']['villeNaissance'] ?? '') ?>">
                </div>
                <div class="form-element">
                    <label for="sexe" class="form-label">Genre:</label>

                    <div id="genrechoices">
                        <div class="genrechoice">
                            <input type="radio" name="sexe" id="genrechoice1" value="0" <?= (isset($_SESSION['inputs']['sexe']) && $_SESSION['inputs']['sexe'] == '0') ? 'checked':'' ?>>
                            <label for="genrechoice1" class="form-label">Homme</label>
                        </div>
                        <div class="genrechoice">
                            <input type="radio" name="sexe" id="genrechoice2" value="1" <?= (isset($_SESSION['inputs']['sexe']) && $_SESSION['inputs']['sexe'] == '1') ? 'checked' : '' ?>>
                            <label for="genrechoice2" class="form-label">Femme</label>
                        </div>
                    </div>
                </div>
                <div class="form-element">
                    <label for="Annee_BAC" class="form-label">Année d'obtention du Baccalauréat</label>

                    <select name="Annee_BAC">
                        <?php 
                        
                        $anneeActuelle = date("Y");
                        $anneeSelectionnee = $_SESSION['inputs']['Annee_BAC'] ?? $anneeActuelle;//si la value à été stocké par le serveur elle l'affiche, sinon elle prend (garde) la valeur de $anneeActuelle
                        $anneedepart = 1960;

                        for($i = $anneeSelectionnee; $i>=1960; $i--){
                            $selected = ($i == $anneeSelectionnee)? "selected" : "";
                            echo "<option value='$i' $selected>$i</option>";
                        }; ?>
                    </select>
                </div>
                <div>
                    <input type="submit" name="signup_submit" value="S'inscrire">
                </div>
                <br>
                <div><span class="white-text">Vous avez déjà un compte ? </span><a class="link-color" href="index.php?page=login">Connectez-vous ici</a></div>
            </form>
        </div>
    </main>
</body>
</html>

<?php unset($_SESSION['inputs']) //évite que les values des inputs s'affichent la prochaine fois que l'user visite la page signup ?>