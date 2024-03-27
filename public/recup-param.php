<?php
// Récupère le paramètre d'URL 'prenom'
// Tester la présence du paramètre
// Récupère le paramètre d'URL 'prenom'
// Tester la présence du paramètre
if (isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];

// 1. Connexion à la base de donnée db_intro
require_once '../base.php';
require_once BASE_PROJET .
    '/src/config/db-config.php';
require_once BASE_PROJET .
    '/src/_partials/header.php';
// 2. Préparation de la requête
    $requete = $pdo->prepare(query: "SELECT * FROM film WHERE id_film = :id");

// 3. Lier le paramètre
    $requete->bindParam(':id', $id_film);

// 4. Exécution de la requête
    $requete->execute();

// 5. Récupération du film (vérifier si trouvé)
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <title>Document</title>
    </head>
    <body class="bg-secondary">
    <div class="container text-center">
    <div class="row p-5 d-md-block">
    <div class=" ">
    <?php
    if ($film = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
        <?php echo "<img src='{$film['image']}' alt='' </img>"; ?>
        </div>
        <div class="text-md-center form-control ">
        <?php
        echo "<p>{$film['resume']}</p>"; // Assuming you have a "resume" attribute in your table
    } else {
        echo "Film introuvable";
    }
} else {
    echo "Aucun ID de film fourni";
}
?>
    </div>
    </div>

</body>
    </html>
