<?php
session_start();  // démarrage d'une session

// on vérifie que les données du formulaire sont présentes
if (isset($_POST['email']) && isset($_POST['mdp'])) {
    require 'fonctions.php';
    $bdd = getBdd();
    // cette requête permet de récupérer l'utilisateur depuis la BD
    $requete = "SELECT * FROM utilisateur WHERE email_utilisateur=? AND mdp_utilisateur=?";
    $resultat = $bdd->prepare($requete);
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $resultat->execute(array($email, $mdp));
    if ($resultat->rowCount() == 1) {
        // l'utilisateur existe dans la table
        // on ajoute ses infos en tant que variables de session
        $_SESSION['email'] = $email;
        $_SESSION['mdp'] = $mdp;
        // cette variable indique que l'authentification a réussi
        $authOK = true;
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Résultat de l'authentification</title>
</head>
<body>
<h1>Résultat de l'authentification</h1>
<?php
if (isset($authOK)) {
    echo "<p>Vous avez été reconnu(e) en tant que " . escape($email) . "</p>";
    echo "<p>Vous n'êtes même pas sensé voir cette page !</p>";
    header("Location:/index.php");
    exit();
}
else { ?>
    <p>Vous n'avez pas été reconnu(e)</p>
    <p><a href="/login.php">Nouvel essai</p>
<?php } ?>
</body>
</html>