<?php  
// On charge l'autoloader de Composer
require_once 'vendor/autoload.php';
// On charge les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once 'config/db.php';
require_once 'models/UserModel.php';
require_once 'models/AdminModel.php';
require_once 'models/SecurityModel.php';
require_once 'models/ErrorModel.php';

session_start();
$userdata=null;
$isconnected = isset($_SESSION['user_id']); 
$is_admin = (isset($_SESSION['admin']) && $_SESSION['admin']==1);
if($isconnected){
    $userdata = get_user_data_by_id($connexion, $_SESSION['user_id']);
}

if(isset($_GET['action'])){//CAS GET POUR UNE REQUETE
    if($_GET['action']=='login_request' || $_GET['action']=='signup_request'){
        require_once 'controller/AuthController.php';

    }
    if($_GET['action']=='logout_request'){
        require_once 'controller/logout.php';
    }
    if($_GET['action']=='reset_password_request'){
        require_once 'controller/SecurityController.php';
    }

    if($_GET['action']=='modify_request'){
        require_once 'controller/UserController.php';
    }
    exit();
}

$page = strtolower($_GET['page'] ?? 'login');// stocke le GET du paramètre

if($isconnected && ($page == 'login' || $page == 'signup')){
    header("Location: index.php?page=accueil");
    exit();
}
if(!$isconnected && ($page == 'accueil' || $page == 'profile' || $page == 'modify_data')){
    $_SESSION['error'] = 'auth_required';
    header("Location: index.php");
    exit();
}


switch($page) {
    case 'login':
        require_once 'view/login.php';
        break;

    case 'signup':
        require_once 'view/signup.php';
        break;

    case 'forgot_password':
        require_once 'view/forgot_password.php';
        break;

    // Dans le switch($page) de index.php
    case 'reset_password':
        $token = $_GET['token'] ?? '';
        // On utilise ta fonction du SecurityModel pour vérifier le token
        $user = check_reset_token($connexion, $token);
        if ($user) {
            require_once 'view/reset_password.php';
        } else {
            $_SESSION['error'] = 'invalid_token';
            header("Location: index.php?page=login");
            exit();
        }
        break;

    case 'accueil':
        require_once 'config/db.php';
        $username = get_username_by_id($connexion, $_SESSION['user_id']);//Nom d'utilisateur
        require_once 'view/accueil.php';
        break;
        
    case 'profile':
    case 'modify_data':
        require_once 'config/db.php';
        $username = get_username_by_id($connexion, $_SESSION['user_id']);//Nom d'utilisateur
        $view = ($page == 'profile') ? 'profile.php' : 'modify_data.php';
        require_once "view/$view";
        break;

    case 'admin':
    case 'view_users':
        if(!$is_admin){
            $_SESSION['error']='access_denied';
            header("Location: index.php");
            exit();
        }else{
            $all_users = get_all_users($connexion);
            $username = get_username_by_id($connexion, $_SESSION['user_id']);//Nom d'utilisateur
            $view = ($page == 'admin') ? 'admin.php':'view_users.php';
            require_once "view/$view";
            break;
        };

    case 'modify_data_admin':
        if(!$is_admin){ // Sécurité : on vérifie que c'est bien un admin
            header("Location: index.php");
            exit();
        }
        
        $id_target = $_GET['id'] ?? null;
        if($id_target){
            // On récupère les infos de l'utilisateur CIBLE, pas de l'admin connecté
            $userdata_target = get_user_data_by_id($connexion, $id_target);
            require_once 'view/modify_data_admin.php';
        } else {
            header("Location: index.php?page=view_users");
        }
        break;

    case 'not_found':
        require_once 'view/not_found.php';
        break;

    default:
        require_once 'view/not_found.php';
        exit();
}

?>