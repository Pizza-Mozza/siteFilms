<?php
session_start();  // démarrage d'une session
require_once '../base.php';
require_once BASE_PROJET .
    '/src/config/db-config.php';
require_once BASE_PROJET .
    '/src/_partials/header.php';
require_once BASE_PROJET .
    '/public/fonctions.php';
$_SESSION['email'] ='mc@feur.fr';
$_SESSION['mdp'] ='X@mpp123';

/**
 * @var PDO $pdo
 */

$erreurs = [];
$pseudo_utilisateur="";
$email_utilisateur = "";
$email_confirmation = "";
$mdp_confirmation ="";
$mdp_utilisateur ="";
$prenom="";
$nom="";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
<h1>Connexion utilisateur</h1>
<form action="/login_post.php" method="post">
    <label for="email">email :</label>
    <input type="text" name="email" id="email" required />
    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" id="mdp" required />
    <input type="submit" value="Connexion">
</form>
</body>
