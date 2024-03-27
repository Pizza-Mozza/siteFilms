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
    echo "<p>Vous avez été reconnu(e) en tant que " . escape($email_utilisateur) . "</p>";
    echo '<a href="index.php">Poursuivre vers la page d\'accueil</a>';
}
else { ?>
    <p>Vous n'avez pas été reconnu(e)</p>
    <p><a href="login.php">Nouvel essai</p>
<?php } ?>

</body>
</html>