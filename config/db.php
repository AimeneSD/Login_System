<?php 
// On utilise les variables chargées depuis le .env
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db   = $_ENV['DB_NAME'];

$connexion = mysqli_connect($host, $user, $pass, $db);

if(!$connexion){
    error_log(mysqli_connect_error());
    die("La connection a échouée : ");
}


?>