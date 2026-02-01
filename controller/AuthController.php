<?php 

require_once "config/db.php";
require_once "models/UserModel.php";

if(isset($_POST['login_submit'])){//CAS DE CONNEXION
    $user_mail=$_POST['email'];
    $user_pass=$_POST['password'];

    $user = verify_connection($connexion,$user_mail);

    if($user && password_verify($user_pass, $user['password'])){
        $_SESSION['user_id'] = $user['id'];//on stocke l'id de l'utilisateur dans la session
        $_SESSION['admin'] = $user['admin'];//on stocke le rôle admin de l'utilisateur dans la session 
        header("Location: index.php?page=accueil");
    }
    else{
        $_SESSION['error']='auth_failed';
        header("Location: index.php?page=login");
    }
    exit();
}//CAS DE CONNEXION


if(isset($_POST['signup_submit'])){// CAS D'INSCRIPTION

    $email = $_POST['email'];
    if (verify_already_exists_email($connexion, $email)) {//on vérifie si l'adresse email est déjà associée à un compte
        $_SESSION['error'] = 'email_exists';
        $_SESSION['inputs'] = $_POST; // on garde les saisies pour ne pas tout perdre
        header("Location: index.php?page=signup");
        exit();
    }
    
    //ON VERIFIE QUE LES MOTS DE PASSES (CONFIRMATION) SONT IDENTIQUES
    if($_POST['password']!=$_POST['password_conf']){ 
        // on stocke les saisies (sauf les mots de passe)
        $_SESSION['inputs'] = $_POST;//on récupère l'ensemble des values des champs du formulaire qu'on stocke dans la session
        unset($_SESSION['inputs']['password'], $_SESSION['inputs']['password_conf']);// ON UNSET L'ELEMENT PASSWORD POUR QUE L'USER A LES CHAMPS MDP VIDES
        $_SESSION['error']='diff_password';//ON STOCKE LE TYPE D'ERREUR DANS LA SESSION
        header("Location: index.php?page=signup");
        exit();
    }

    //ON VERIFIE QUE LE MOT DE PASSE EST FORT
    $strong_pass_pattern='/[!@#$%^&*(),.?":{}|<>]/';
    if(!preg_match($strong_pass_pattern, $_POST['password']) || strlen($_POST['password']) < 12){
        // On stocke les saisies (sauf les mots de passe)
        $_SESSION['inputs'] = $_POST;//on récupère l'ensemble des values des champs du formulaire qu'on stocke dans la session
        unset($_SESSION['inputs']['password'], $_SESSION['inputs']['password_conf']);//ON UNSET L'ELEMENT PASSWORD POUR QUE L'USER A LES CHAMPS MDP VIDES

        $_SESSION['error'] = 'weak_password';//ON STOCKE LE TYPE D'ERREUR DANS LA SESSION
        header('Location: index.php?page=signup');
        exit();
    }
    //INPUTS FACULTATIFS:
    $ville = empty($_POST['villeNaissance']) ?  null : $_POST['villeNaissance']; // CHANGEMENT ICI !!!!!!!!!!
    
    //si les conditions sont passées, on crée un tableau associatif qui contiendra les données du formulaire d'inscription
    $signupData=[
    'nom'       => $_POST['nom'],
    'prenom'    =>$_POST['prenom'],
    'email'     =>$_POST['email'],
    'login'     =>$_POST['username'],
    'dateNaissance' =>$_POST['dateNaissance'],
    'villeNaissance' =>$ville,// CHANGEMENT ICI !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    'password'    =>password_hash($_POST['password'], PASSWORD_DEFAULT),
    'sexe'      =>$_POST['sexe'],
    'Annee_BAC'  =>$_POST['Annee_BAC']
    ];
    
    
    if(signup_user($connexion, $signupData)){
        $_SESSION['success'] = 'accountcreated';
        header("Location: index.php?page=login");
    }
    else{
        $_SESSION['error'] = 'db_error';
        header("Location: index.php?page=signup");
    }
    exit();
}//CAS D'INSCRIPTION



?>