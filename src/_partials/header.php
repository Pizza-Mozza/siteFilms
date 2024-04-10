<?php
if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {
} else {

}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php"); // ou vers une page de confirmation
exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Filmosphère</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand text-primary" href="/index.php">Filmosphère</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/index.php">Accueil
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-link">
                <?php
                if (!isset($_SESSION['email']) && !isset($_SESSION['mdp'])) {
                    // Afficher le contenu personnalisé
                    echo "<a href='login.php'>Connexion</a>";}
                ?>
                </li>
                <li class="nav-link">
                    <?php
                    if (!isset($_SESSION['email']) && !isset($_SESSION['mdp'])) {
                        // Afficher le contenu personnalisé
                        echo "<a href='signin.php'>Inscription</a>";}
                    ?>
                </li>
                <li class="nav-link">
                    <?php
                    if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {
                    // Afficher le contenu personnalisé
                    echo "<a href='ajout-film.php'>Cliquer ici pour ajouter vos films</a>";}
                    ?>
                </li>
                <li class="nav-link">
                    <?php
                    if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {
                        // Afficher le contenu personnalisé
                        echo "<a href=\"?logout\">Se déconnecter</a>";}?>
                </li>

            </ul>
        </div>
    </div>
</nav>
</body>
</html>