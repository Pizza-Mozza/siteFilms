<?php
// Déterminer si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Traitement des données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $resume = $_POST['resume'];
    $date_sortie = $_POST['date_sortie'];
    $pays = $_POST['pays'];
    $image = $_POST['image'];

    // Validation des données (facultatif, à adapter selon vos besoins)
    // ...

    // Connexion à la base de données
    require_once '../base.php';
    require_once BASE_PROJET . '/src/config/db-config.php';
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

    // Préparer la requête d'insertion
    $requete = $pdo->prepare("INSERT INTO `film` (`titre`, `duree`, `resume`, `date_sortie`, `pays`, `image`) VALUES (:titre, :duree, :resume, :date_sortie, :pays, :image)");

    // Lier les valeurs aux paramètres de la requête
    $requete->bindParam(':titre', $titre);
    $requete->bindParam(':duree', $duree);
    $requete->bindParam(':resume', $resume);
    $requete->bindParam(':date_sortie', $date_sortie);
    $requete->bindParam(':pays', $pays);
    $requete->bindParam(':image', $image);

    // Exécuter la requête
    $requete->execute();

    // Rediriger vers la page d'accueil
    header("Location: /index.php");
    exit();
}

// Chargement des erreurs (si présentes)
$erreurs = [];
if (isset($_SESSION['erreurs'])) {
    $erreurs = $_SESSION['erreurs'];
    unset($_SESSION['erreurs']);
}

// Chargement des données du formulaire (si présentes)
$titre = "";
$duree = "";
$resume = "";
$date_sortie = "";
$pays = "";
$image = "";
if (isset($_SESSION['formData'])) {
    $formData = $_SESSION['formData'];
    unset($_SESSION['formData']);

    $titre = $formData['titre'];
    $duree = $formData['duree'];
    $resume = $formData['resume'];
    $date_sortie = $formData['date_sortie'];
    $pays = $formData['pays'];
    $image = $formData['image'];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Filmosphère - Ajout d'un film</title>
</head>
<body class="bg-dark-subtle">
<h1 class="text-center text-dark">Ajout d'un film</h1>
<div class="w-50 mx-auto shadow p-4 bg-light-subtle">
    <form action="" method="post" novalidate>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text"
                   class="form-control <?= (isset($erreurs['titre'])) ? "border border-2 border-danger" : "" ?>"
                   id="titre" name="titre" value="<?= $titre ?>" placeholder="Saisir le titre du film"
                   aria-describedby="titreHelp">
            <div id="titreHelp" class="form-text">Indiquez le titre officiel du film.</div>
            <?php if (isset($erreurs['titre'])): ?>
                <p class="form-text text-danger"><?= $erreurs?>;
