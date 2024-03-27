<?php
//session_start();  // démarrage d'une session
require_once '../base.php';
require_once BASE_PROJET .
    '/src/config/db-config.php';
require_once BASE_PROJET .
    '/src/_partials/header.php';

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
<form action="../login_post.php" method="post">
    <label for="email_utilisateur">email :</label>
    <input type="text" name="email_utilisateur" id="email_utilisateur" required />
    <label for="mdp_utilisateur">Mot de passe :</label>
    <input type="password" name="mdp_utilisateur" id="mdp_utilisateur" required />
    <input type="submit" value="Connexion">
</form>
</body>
