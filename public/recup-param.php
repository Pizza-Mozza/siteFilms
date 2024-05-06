<?php
session_start();

// Vérifie si l'ID du film est passé en paramètre
if (isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];

    // Connexion à la base de données db_intro
    require_once '../base.php';
    require_once BASE_PROJET . '/src/config/db-config.php';
    require_once BASE_PROJET . '/src/_partials/header.php';

    // Préparation de la requête pour sélectionner le film
    $requete = $pdo->prepare("SELECT * FROM film WHERE id_film = :id");
    $requete->bindParam(':id', $id_film);
    $requete->execute();

    // Récupération des données du film
    if ($film = $requete->fetch(PDO::FETCH_ASSOC)) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link href="assets/css/bootstrap.min.css" rel="stylesheet">
            <title>Document</title>
        </head>
        <body class="bg-secondary-subtle">
        <div class="container text-center">
            <div class="row p-5 d-md-block">
                <div>
                    <img src="<?= $film["image"] ?>" style="width: 250px; height: 350px">
                </div>
                <div class="text-md-center form-control">
                    <p><?= $film['titre'] ?></p>
                    <p><?= $film['duree'] ?> minutes</p>
                    <p><?= $film['resume'] ?></p>
                    <p>Posté par : <?= $film['email_utilisateur'] ?></p>
                </div>
            </div>
        </div>
        <!-- Bouton Ajouter un commentaire -->
        <div class="container mt-5">
            <a href="ajout-commentaire.php?id_film=<?= $id_film ?>" class="btn btn-primary">Ajouter un commentaire</a>
        </div>
        <!-- Affichage des commentaires -->
        <div class="container mt-5">
            <h2>Commentaires</h2>
            <?php
            // Requête pour récupérer les commentaires du film spécifique
            $requete_commentaires = $pdo->prepare("SELECT * FROM commentaire c Join utilisateur u on u.id_utilisateur = c.id_utilisateur WHERE id_film = :id");
            $requete_commentaires->bindParam(':id', $id_film);
            $requete_commentaires->execute();

            // Affichage des commentaires
            while ($commentaire = $requete_commentaires->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $commentaire['titre_commentaire'] . "</h5>";
                echo "<p class='card-text'>" . $commentaire['avis_commentaire'] . "</p>";
// Récupération de la note du commentaire
$note = $commentaire['note_commentaire'];

// Génération du code HTML des étoiles en fonction de la note
$etoilesRemplies = '';
for ($i = 1; $i <= 5; $i++) {
    // Vérifier si la note est entière
    if ($note == $i) {
        $etoilesRemplies .= "<i class='bi bi-star-fill'></i>";
    } 
    // Vérifier si la note contient un demi (0.5)
    elseif ($note == ($i - 0.5)) {
        $etoilesRemplies .= "<i class='bi bi-star-half'></i>";
    } 
    // Si la note est supérieure à i, afficher une étoile pleine
    elseif ($note > $i) {
        $etoilesRemplies .= "<i class='bi bi-star-fill'></i>";
    } 
    // Sinon, afficher une étoile vide
    else {
        $etoilesRemplies .= "<i class='bi bi-star'></i>";
    }
}

// Affichage du code HTML des étoiles
echo "<p class='card-text'>Note: " . $etoilesRemplies . "</p>";

 
                echo "<p class='card-text'>Posté par: " . $commentaire['pseudo_utilisateur'] . "</p>";
                echo "<p class='card-text'>Date et heure: " . $commentaire['date_commentaire'] . "</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <?php require_once BASE_PROJET . '/src/_partials/footer.php'; ?>
        </body>
        </html>
    <?php } else {
        echo "Film introuvable";
    }
} else {
    echo "Aucun ID de film fourni";
}
?>
