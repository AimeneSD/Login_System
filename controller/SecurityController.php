<?php  

// On charge l'autoload de Composer une seule fois
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "models/SecurityModel.php";

// --- CAS 1 : L'UTILISATEUR DEMANDE UN LIEN (forgot_password) ---
if (isset($_POST['forgot_submit'])) {
    $email = $_POST['email'];
    $user = verify_connection($connexion, $email);

    if ($user) {
        $token = bin2hex(random_bytes(32));
        if (set_reset_token($connexion, $email, $token)) {
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            try {
                $mail->isSMTP();
                $mail->Host       = $_ENV['SMTP_HOST'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $_ENV['SMTP_USER'];
                $mail->Password   = $_ENV['SMTP_PASS'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
                $mail->Port       = $_ENV['SMTP_PORT'];

                $mail->setFrom('aimene9495@gmail.com', 'Ne pas répondre');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Reinitialisation de votre mot de passe';
                
                $resetLink = "https://sioslam.com/27_SAOUD/td5/index.php?page=reset_password&token=$token";
                $mail->Body = "Pour réinitialiser votre mot de passe, cliquez ici : <a href='$resetLink'>$resetLink</a>";

                $mail->send();
                $_SESSION['success'] = 'mail_sent';
                header("Location: index.php?page=login");
            } catch (Exception $e) {
                $_SESSION['success'] = 'mail_failed';
                header("Location: index.php?page=forgot_password");
            }
        }
    } else {
        // Sécurité : on affiche le même message même si l'email n'existe pas
        $_SESSION['success'] = 'mail_sent';
        header("Location: index.php?page=login");
    }
    exit();
}

// --- CAS 2 : VALIDATION DU NOUVEAU MOT DE PASSE ---
if (isset($_POST['reset_submit'])) {
    $user_id = $_POST['user_id'];
    $pass = $_POST['password'];
    $conf = $_POST['password_conf'];

    if ($pass !== $conf) {
        $_SESSION['error'] = 'diff_password';
        header("Location: index.php?page=reset_password&token=".$_POST['token']);
        exit();
    }

    $hashed = password_hash($pass, PASSWORD_DEFAULT);
    if (finalize_password_reset($connexion, $user_id, $hashed)) {
        $_SESSION['success'] = 'password_reset';
        header("Location: index.php?page=login");
    }
    exit();
}


?>