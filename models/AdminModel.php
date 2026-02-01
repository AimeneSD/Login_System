<?php

//Ce fichier est le modèle en rapport avec les fonctionnalités des admins



// (Utilisé pour récupérer l'ensemble des utilisateurs dans le back-office)
function get_all_users($connexion){
    $sql = "SELECT id, login, nom, prenom, email, admin FROM adherents";
    $resultat = mysqli_query($connexion, $sql);

    return mysqli_fetch_all($resultat, MYSQLI_ASSOC);
} 

// Mise à jour administrative (inclut le rôle, exclut le mot de passe)
function update_user_by_admin($connexion, $target_id, $data){
    $sql = "UPDATE adherents SET nom=?, prenom=?, email=?, login=?, dateNaissance=?, villeNaissance = ?, sexe=?, Annee_BAC=?, admin=? WHERE id = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssiiii", 
        $data['nom'], $data['prenom'], $data['email'], $data['login'], 
        $data['dateNaissance'], $data['villeNaissance'], $data['sexe'], 
        $data['Annee_BAC'], $data['admin'], $target_id);
    
    return mysqli_stmt_execute($stmt);
}

function delete_user($connexion, $id){
    $sql = "DELETE FROM adherents WHERE id = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    return mysqli_stmt_execute($stmt);

}



?>