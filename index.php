<?php
session_start();

// Vérifier la connexion
if (!isset($_POST['email']) && !isset($_POST['mdp'])) {
    // Détruire la session si l'utilisateur n'a pas soumis le formulaire de connexion
    session_destroy();
}

if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {
    // Afficher le contenu personnalisé
    echo "<h1>Bienvenue " . $_SESSION['email'] . " !</h1>";
    echo "<p>Voici votre page spéciale.</p>";
    echo "<a href=\"?logout\">Se déconnecter</a>";

    // Afficher des informations et des actions spécifiques à l'utilisateur
    // ...

} else {
    // Afficher la page d'accueil standard
    echo "<h1>Page d'accueil</h1>";
    echo "<p>Veuillez vous connecter pour accéder à votre page spéciale.</p>";
    // Lien vers la page de connexion
    echo "<a href=\"login.php\">Se connecter</a>";
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php"); // ou vers une page de confirmation
    exit();
}

// ...


// Récupérer la liste des étudiants dans la table etudiant

// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require_once '../base.php';
require_once BASE_PROJET .
    '/src/config/db-config.php';
require_once BASE_PROJET .
    '/src/_partials/header.php';
// 2. Préparation de la requête
$requete = $pdo->prepare(query: "SELECT * FROM film");

// 3. Exécution de la requête
$requete->execute();

// 4. Récupération des enregistrements
// Un enregistrement = un tableau associatif
$films = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Filmosphère</title>
</head>
<body class=" bg-dark-subtle">
<h1 class="text-center mt-3 text-primary">Bienvenue sur Filmosphère !</h1>
<h3 class="text-center">Dernières sorties </h3>
<div class=" rounded-4 p-3 flex-fill">
    <div class="container ">
        <!-- Votre code -->
        <div class="row text-center  ">
            <p><i class="bi bi-camera-reels"></i> quoikoubekistant <i class="bi bi-camera-reels"></i></p>
        </div>
    </div>
</div>
<div class="d-flex mt-2">
    <div class=" rounded-4 p-3 flex-fill">
        <div class="container ">
            <!-- Votre code -->
            <div class="row text-center  ">
                <?php foreach ($films as $film) : ?>
                    <div class="card border-dark  mb-3 me-2 bg-light-subtle " style="max-width: 20rem;">
                        <div class="card-body shadow-lg p-3 mb-5 bg-body rounded">
                            <h4 class="card-title "><img class="w-100" src="<?= $film["image"] ?>" alt=""</h4>
                            <p class="card-text"><?= $film["titre"] ?></p>
                            <p> <?= $film["duree"] . " minutes" ?></p>
                            <p class="card-text">
                                <a class="btn btn-primary" role="button"
                                   href="recup-param.php?id_film=<?= $film['id_film'] ?>
                        ">Détails du film</a></p>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<footer>
    <section id="contact" class="bg-dark text-white">
        <div class="container mt-3">
            <div class="row">
                <div class="col col-6 col-lg-6">
                    <img class="img-fluid w-25" src="assets/images/plagiat.jpg" alt="">
                </div>
                <div class="col col-6 col-lg-6">
                    <h2 class="text-center">Contact</h2>

                    <p class="text-center"><i class="bi bi-telephone-fill"></i> 07 69 70 71 72</p>
                    <p class="text-center"><i class="bi bi-envelope-at-fill"></i>filmosphere@lorem.com</p>
                    <p class="text-center">Nous rejoindre:<a href="https://www.francetravail.fr/accueil/" target="_blank">J'adore le travail !!!</a></p>
                </div>
            </div>
        </div>
    </section>
</footer>
</body>
</html>