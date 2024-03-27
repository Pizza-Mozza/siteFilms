<?php
//session_start();  // démarrage d'une session
require 'fonctions.php';
$bdd = getBdd();
$requete = "SELECT * FROM utilisateur WHERE email_utilisateur=? AND mdp_utilisateur=?";
$resultat = $bdd->prepare($requete);
$resultat->execute(array($email_utilisateur, $mdp_utilisateur));

// on vérifie que les données du formulaire sont présentes
if (isset($_POST['email_utilisateur']) && isset($_POST['mdp_utilisateur'])) {
// cette requête permet de récupérer l'utilisateur depuis la BD
    $email_utilisateur = $_POST['email_utilisateur'];
    $mdp_utilisateur = $_POST['mdp_utilisateur'];
    if ($resultat->rowCount() == 1) {
// l'utilisateur existe dans la table
// on ajoute ses infos en tant que variables de session
        $_SESSION['email_utilisateur'] = $email_utilisateur;
        $_SESSION['mdp_utilisateur'] = $mdp_utilisateur;
// cette variable indique que l'authentification a réussi
        $authOK = true;
    }
}
/**
 * @var PDO $pdo
 */
require_once 'header.php';

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
<form action="login_post.php" method="post">
    <label for="email_utilisateur">email :</label>
    <input type="text" name="email_utilisateur" id="email_utilisateur" required />
    <label for="mdp_utilisateur">Mot de passe :</label>
    <input type="password" name="mdp_utilisateur" id="mdp_utilisateur" required />
    <input type="submit" value="Connexion">
</form>
</body>
</html>