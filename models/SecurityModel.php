<?php 

function verify_already_exists_email($connexion, $email){
    $sql = "SELECT id FROM adherents WHERE email = ?";

    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($resultat);

    return ($user !== null);//vérifie si la ligne (de l'utilisateur est défini avec l'adresse email entrée)
};


function set_reset_token($connexion, $email, $token){
    $sql = "UPDATE adherents SET reset_token = ?, reset_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $token, $email);

    return mysqli_stmt_execute($stmt);
}

function check_reset_token($connexion, $token){
    $sql = "SELECT id FROM adherents WHERE reset_token = ? AND reset_expires > NOW()";
    $stmt= mysqli_prepare($connexion,$sql);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_assoc($resultat);
}

function finalize_password_reset($connexion, $user_id, $hashed_password){
    $sql = "UPDATE adherents SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "si", $hashed_password, $user_id);

    return mysqli_stmt_execute($stmt);

}

?>