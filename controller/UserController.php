<?php 

//CAS MODIFICATION DONNEES
if(isset($_POST['modify_data_submit'])){
    // On détermine l'ID à modifier : soit celui du champ caché, soit celui de la session
    $id_to_update = $_POST['target_id'] ?? $_SESSION['user_id'];

    // Dans controller/UserController.php
    $modifiedData = [
        'nom'            => $_POST['nom'],
        'prenom'         => $_POST['prenom'],
        'email'          => $_POST['mail'],
        'login'          => $_POST['username'],
        'dateNaissance'  => $_POST['dateNaissance'],
        'villeNaissance' => $_POST['villeNaissance'],
        'sexe'           => $_POST['sexe'],
        'Annee_BAC'      => $_POST['Annee_BAC']
    ];

    // Si l'admin a envoyé un rôle, on l'ajoute au tableau
    if(isset($_POST['admin_role'])){
        $modifiedData['admin'] = $_POST['admin_role'];
    }

    // On utilise notre ID déterminé plus haut
    if(!empty($_POST['password'])){
        $modifiedData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        update_user_full($connexion, $id_to_update, $modifiedData);
    } else {
        update_user_info_only($connexion, $id_to_update, $modifiedData);
    }

    // Redirection intelligente
    $redirect = isset($_POST['target_id']) ? 'view_users' : 'profile';
    $_SESSION['success'] = 'updated';
    header("Location: index.php?page=$redirect");
    exit();
}


?>