<?php
session_start();

// Vérifie si l'ID du film est passé en paramètre dans l'URL
if (isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];

    // Vérifie si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Récupérer les données du formulaire
        $titre_commentaire = $_POST['titre_commentaire'];
        $avis_commentaire = $_POST['avis_commentaire'];
        $note_commentaire = $_POST['note_commentaire'];
        $date_commentaire = new DateTime();
        $date_commentaire = $date_commentaire->format('Y-m-d H:i:s');
        
        // Récupérer l'email de l'utilisateur à partir de la session
        $id_utilisateur = $_SESSION['id_utilisateur'];

        // Connexion à la base de données et insertion du commentaire
        require_once '../base.php';
        require_once BASE_PROJET . '/src/config/db-config.php';

        $requete = $pdo->prepare("INSERT INTO commentaire (titre_commentaire, avis_commentaire, note_commentaire, date_commentaire, id_film, id_utilisateur) VALUES (?, ?, ?, ?, ?, ?)");
        $requete->execute([$titre_commentaire, $avis_commentaire, $note_commentaire, $date_commentaire, $id_film,$id_utilisateur]);

        // Redirection vers la page des détails du film après l'ajout du commentaire
        header("Location: recup-param.php?id_film=$id_film");
        exit();
    }
} else {
    // Redirection vers une page d'erreur si l'ID du film n'est pas fourni dans l'URL
    header("Location: erreur.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Ajouter un commentaire</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="titre_commentaire" class="form-label">Titre :</label>
                <input type="text" id="titre_commentaire" name="titre_commentaire" class="form-control">
            </div>
            <div class="mb-3">
                <label for="avis_commentaire" class="form-label">Avis :</label>
                <textarea id="avis_commentaire" name="avis_commentaire" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="note_commentaire" class="form-label">Note :</label>
                <input type="number" id="note_commentaire" name="note_commentaire" min="0" max="5" step="0.5" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Ajouter le commentaire</button>
        </form>
    </div>
</body>
</html>
