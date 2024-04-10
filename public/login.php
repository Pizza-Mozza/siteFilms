<?php
session_start();
session_destroy();
require_once '../base.php';
require_once BASE_PROJET .
    '/src/config/db-config.php';
require_once BASE_PROJET .
    '/src/_partials/header.php';
require_once BASE_PROJET .
    '/public/fonctions.php';


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
$_SESSION['email'] = $email_utilisateur;
$_SESSION['mdp'] =$mdp_utilisateur;
$mdp_no_hash = password_verify($mdp_utilisateur, PASSWORD_DEFAULT);?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
<h1 class="text-center mb-5 mt-5">Connexion utilisateur</h1>
<div class="w-50 mx-auto shadow p-4 bg-light-subtle mt-3 mb-5">
<form action="/login_post.php" method="post">
    <div class="mb-1 text-center">
    <label for="email">email :</label>
    </div>
    <div class="mb-3 text-center">
    <input type="text" name="email" id="email" required />
    </div>
    <div class="mb-1 text-center">
    <label for="mdp">Mot de passe :</label>
    </div>
    <div class="mb-4 text-center">
    <input type="password" name="mdp" id="mdp" required />
    </div>
    <div class="text-center">
    <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>
</div>

<p><br><br><br><br><br><br><br><br><br></p>
</body>
<?php
require_once BASE_PROJET .
    '/src/_partials/footer.php';?>
</html>