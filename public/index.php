<?php
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
require_once BASE_PROJET .
    '/src/database/film-db.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Filmosphère</title>

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
                                   href="./detailfilm.php?id_film=<?= $film['id_film'] ?>
                        ">Détails du film</a></p>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php require_once BASE_PROJET .
'/src/_partials/footer.php'; ?>
</body>
</html>