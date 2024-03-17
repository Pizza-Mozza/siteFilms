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
</head>
<body class=" bg-secondary">
<div class="d-flex mt-2">
    <div class=" rounded-4 p-3 flex-fill">
        <div class="container ">
            <!-- Votre code -->
            <div class="row text-center  ">
                <?php foreach ($films as $film) : ?>
                    <div class="card border-dark  mb-3 me-2" style="max-width: 20rem;">
                        <div class="card-body">
                            <h4 class="card-title"><img src="<?= $film["image"] ?>" alt=""</h4>
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


</body>
</html>