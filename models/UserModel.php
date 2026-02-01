<?php 
//Ce fichier contient le modèle en rapport avec les Utilisateurs


//On crée une fonction pour chercher un utilisateur par son mail
function verify_connection($connexion,$user_mail){
    $sql="SELECT * FROM adherents WHERE email=?";
    $stmt = mysqli_prepare($connexion, $sql);

    mysqli_stmt_bind_param($stmt, "s", $user_mail);
    mysqli_stmt_execute($stmt);
    $resultat=mysqli_stmt_get_result($stmt);
    //on retourne le tableau de données ou NULL si rien n'est trouvé
    return mysqli_fetch_assoc($resultat);
}

//on crée une fonction pour insérer un nouvel adhérent
function signup_user($connexion, $data){
    $sql='INSERT INTO adherents (nom, prenom, email, login, dateNaissance, villeNaissance, password, sexe, Annee_BAC) values (?,?,?,?,?,?,?,?,?)';
    $stmt=mysqli_prepare($connexion, $sql);


    mysqli_stmt_bind_param($stmt, "sssssssii", //on rajoute un s car villeNaissance est un string
        $data['nom'],
        $data['prenom'],
        $data['email'],
        $data['login'],
        $data['dateNaissance'],
        $data['villeNaissance'],
        $data['password'],
        $data['sexe'],
        $data['Annee_BAC']
    
    );
    return mysqli_stmt_execute($stmt);
}

//on crée une fonction pour récupérer le nom d'utilisateur de la session
function get_username_by_id($connexion, $id){
    $sql= "SELECT login FROM adherents WHERE id=?";
    $stmt=mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultat=mysqli_stmt_get_result($stmt);
    if($user_data=mysqli_fetch_assoc($resultat)){
        return $user_data['login'];
    }
    return 'Utilisateur';

}

// (utilisé pour l'affichage du profil) on crée une fonction pour récupérer l'ensemble des informations d'un utilisateur
function get_user_data_by_id($connexion, $id){
    $sql = "SELECT * FROM adherents WHERE id=?";
    $stmt=mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);
    
    return mysqli_fetch_assoc($resultat);
}


// (Utilisé pour modifier les infos d'un user) Version complète (avec mot de passe et autres)
function update_user_full($connexion, $id, $data){
    $sql ="UPDATE adherents SET nom = ?, prenom = ?, email = ?, login = ?, password = ?, dateNaissance = ?, villeNaissance = ?, sexe = ?, Annee_BAC = ? WHERE id = ?";
    $stmt = mysqli_prepare($connexion, $sql);

    // 9 paramètres au total : 6 strings (s) et 3 entiers (i)
    mysqli_stmt_bind_param($stmt, "sssssssiii",
        $data['nom'], $data['prenom'], $data['email'], $data['login'], 
        $data['password'], $data['dateNaissance'], $data['villeNaissance'], 
        $data['sexe'], $data['Annee_BAC'], $id
    );
    return mysqli_stmt_execute($stmt);
}

// (Utilisé pour modifier les infos d'un user sans toucher au mdp) Version sans mot de passe (mais tout le reste !)
function update_user_info_only($connexion, $id, $data){
    $sql ="UPDATE adherents SET nom = ?, prenom = ?, email = ?, login = ?, dateNaissance = ?, villeNaissance = ?, sexe = ?, Annee_BAC = ? WHERE id = ?";
    $stmt = mysqli_prepare($connexion, $sql);

    // 8 paramètres au total : 5 strings (s) et 3 entiers (i)
    mysqli_stmt_bind_param($stmt, "ssssssiii",
        $data['nom'], $data['prenom'], $data['email'], $data['login'], 
        $data['dateNaissance'], $data['villeNaissance'], $data['sexe'], $data['Annee_BAC'], $id
    );
    return mysqli_stmt_execute($stmt);
}



?>