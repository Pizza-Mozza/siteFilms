<?php
session_start();

$email_utilisateur = $_SESSION['email'];


require_once '../base.php';
require_once BASE_PROJET . '/src/config/db-config.php';
require_once BASE_PROJET .
    '/src/_partials/header.php';

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les valeurs saisies par l'utilisateur
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $resume = $_POST['resume'];
    $date_sortie = $_POST['datedesortie'];
    $pays = $_POST['pays'];
    $image = $_POST['image'];
    // Validation des données
    if (empty($titre)) {
        $erreurs['titre'] = "Le titre est obligatoire";
    }
    // Ajoutez d'autres validations selon vos besoins...

    // Traiter les données
    if (empty($erreurs)) {
        // Préparation de la requête SQL
        $requete = $pdo->prepare("INSERT INTO `film` (`titre`, `duree`, `resume`, `date_sortie`, `pays`, `image`,`email_utilisateur`) VALUES (:titre, :duree, :resume, :date_sortie, :pays, :image, :email_utilisateur)");
        // Liaison des paramètres
        $requete->bindParam(':titre', $titre);
        $requete->bindParam(':duree', $duree);
        $requete->bindParam(':resume', $resume);
        $requete->bindParam(':date_sortie', $date_sortie);
        $requete->bindParam(':pays', $pays);
        $requete->bindParam(':image', $image);
        $requete->bindParam(':email_utilisateur', $email_utilisateur);
        // Exécution de la requête
        $requete->execute();

        // Redirection vers une autre page
        header("Location:/index.php");
        exit();
    }
}
?>
<?php if (!isset($_SESSION['email'])) {
    header("Location:../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Ajouter un film</title>
</head>
<body>
    <h1 class = "text-center mt-4 mb-5">Ajouter un film</h1>
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="titre" class="form-label">Titre :</label>
                        <input type="text" id="titre" name="titre" class="form-control">
                        <?php if (isset($erreurs['titre'])): ?>
                            <p class="text-danger"><?php echo $erreurs['titre']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="duree" class="form-label">Durée :</label>
                        <input type="text" id="duree" name="duree" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="resume" class="form-label">Résumé :</label>
                        <textarea id="resume" name="resume" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="datedesortie" class="form-label">Date de sortie :</label>
                        <input type="date" id="datedesortie" name="datedesortie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pays" class="form-label">Pays :</label>
                        <input type="text" id="pays" name="pays" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">URL de l'image :</label>
                        <input type="text" id="image" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
require_once BASE_PROJET .
    '/src/_partials/footer.php';?>
</html>
