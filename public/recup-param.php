<?php
session_start();

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


var_dump($erreurs);

// Traiter les données
if (empty($erreurs)) {
    // Traitement des données (insertion dans une base de données)
    // Rediriger l'utilisateur vers une autre page du site (souvent la page d'acceuil)
    $requete = $pdo->prepare(query: "INSERT INTO `commentaire` (`idcommentaire`, `titre`, `avis`,`note`,`date`,`id-user`,`id-film`) VALUES (:idcommentaire, :titre, :avis,:note,:date,:iduser,:idfilm");
    $requete->bindParam(':idcommentaire', $id_commentaire);
    $requete->bindParam(':titre', $titre);
    $requete->bindParam(':avis', $avis);
    $requete->bindParam(':note', $note);
    $requete->bindParam(':date', $date);
    $requete->bindParam(':iduser', $iduser);
    $requete->bindParam(':idfilm', $idfilm);
    var_dump($erreurs);
    $requete->execute();

    $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
    $idUtilisateur = $pdo->lastInsertId();
    header("Location:/index.php");
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
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <title>Document</title>
    </head>
    <body class="bg-secondary-subtle">
    <div class="container text-center">
    <div class="row p-5 d-md-block">
    <div class=" ">
    <?php
    if ($film = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
        <img src="<?= $film["image"] ?>" style="width: 250px ;height:350px" </img>
        </div>
        <div class="text-md-center form-control ">
        <?php
        echo "<p>{$film['titre']}</p>";
        echo "<p>{$film['duree']} minutes</p>";
        echo "<p>{$film['resume']}</p>";
        echo "<p>Posté par : {$film['email_utilisateur']}</p>";

        // Assuming you have a "resume" attribute in your table
    } else {
        echo "Film introuvable";
    }
} else {
    echo "Aucun ID de film fourni";
}
?>
    </div>
    </div>
    </div>
    <div class="container text-center bg-light">
        <div class="row p-5 d-md-block">
        <p>Commentaires</p>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Commentaire</label>
            </div>
        </div>
    </div>

</body>
    <?php
    require_once BASE_PROJET .
        '/src/_partials/footer.php';?>
</html>
