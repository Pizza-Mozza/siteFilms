<?php
// Récupérer la liste des étudiants dans la table etudiant

// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require './config/db-config.php';

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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Filmosphère</title>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand text-danger" href="./index.php">Filmosphère</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Accueil
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Non implémenté</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Non implémenté</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">Inscription</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="search" placeholder="Search">
                    <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</head>
<body class=" bg-dark-subtle">
<h1 class="text-center mt-3">Bienvenue sur Filmosphère !</h1>
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