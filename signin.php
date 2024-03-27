<?php
//Déterminer si le formulaire a été soumis !!!
//Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête
/**
 * @var PDO $pdo
 */
require './config/db-config.php';
require_once 'header.php';

$erreurs = [];
$pseudo_utilisateur="";
$email_utilisateur = "";
$email_confirmation = "";
$mdp_confirmation ="";
$mdp_utilisateur ="";
$prenom="";
$nom="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Le formulaire est soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif

    $email = $_POST ['email'];
    $pseudo = $_POST ['pseudo'];
    $mdp = $_POST ['mdp'];
    $mdp_confirmation = $_POST['mdp_confirmation'];
    $email_confirmation = $_POST['email_confirmation'];
    $email_utilisateur = $_POST['email'];
    //hashage du mdp
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    if ($email_utilisateur != $email_confirmation) {
        $erreurs['email_confirmation'] = "Les adresses email ne correspondent pas";
    }


    // Validation des données
    if (empty($pseudo)) {
        $erreurs['pseudo'] = "Le pseudo est obligatoire";
    }
    if (empty($email)) {
        $erreurs['email_utilisateur'] = "L'email est obligatoire";
    }
    if ($email != $email_confirmation) {
        $erreurs['email_confirmation'] = "Les adresses email ne correspondent pas";
    }
    if ($mdp != $mdp_confirmation) {
        $erreurs['mdp_confirmation'] = "Les mots de passes ne correspondent pas";
    }
    if (empty($mdp)) {
        $erreurs['mdp_utilisateur'] = "Le mdp est obligatoire";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'email n'est pas valide";
    }
    // Vérification de la longueur du mot de passe
    if (strlen($mdp) < 8 || strlen($mdp) > 14) {
        $erreurs['mdp'] = "Le mot de passe doit contenir entre 8 et 14 caractères";
    }

// Vérification de la présence d'au moins une lettre minuscule, une lettre majuscule et un chiffre dans le mot de passe
    if (!preg_match('/[a-z]/', $mdp) || !preg_match('/[A-Z]/', $mdp) || !preg_match('/[0-9]/', $mdp)) {
        $erreurs['mdp'] = "Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre";
    }

    var_dump($erreurs);

    // Traiter les données
    if (empty($erreurs)) {
        // Traitement des données (insertion dans une base de données)
        // Rediriger l'utilisateur vers une autre page du site (souvent la page d'acceuil)
        $requete = $pdo->prepare(query: "INSERT INTO `utilisateur` (`pseudo_utilisateur`, `email_utilisateur`, `mdp_utilisateur`) VALUES (:pseudo, :email, :mdp)");
        $requete->bindParam(':pseudo', $pseudo);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mdp', $mdp_hash);
        var_dump($erreurs);
        $requete->execute();

        $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
        $idUtilisateur = $pdo->lastInsertId();
        header("Location: ../index.php");
        exit();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Filmosphère</title>
</head>
<body class="bg-dark-subtle">
<!--Insertion d'un menu-->
<h1 class="text-center text-dark">Formulaire</h1>
<div class="w-50 mx-auto shadow p-4 bg-light-subtle">
    <form action="" method="post" novalidate>
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo*</label>
            <input type="text"
                   class="form-control <?= (isset($erreurs['pseudo'])) ? "border border-2 border-danger" : "" ?>"
                   id="pseudo" name="pseudo" value="<?= $pseudo_utilisateur ?>" placeholder="Saisir votre pseudo"
                   aria-describedby="text">
            <div id="pseudo" class="form-text">Ne choisissez pas un pseudo que vous regretterez !!!</div>
            <?php if (isset($erreurs['pseudo'])): ?>
                <p class="form-text text-danger"><?= $erreurs['pseudo'] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email*</label>
            <input type="email"
                   class="form-control <?= (isset($erreurs['email'])) ? "border border-2 border-danger" : "" ?>""
            id="exampleInputEmail1" name="email" value="<?= $email_utilisateur ?>" placeholder="Saisir votre mail"
            aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Ne partagez jamais votre adresse email !!!</div>
            <?php if (isset($erreurs['email'])): ?>
                <p class="form-text text-danger"><?= $erreurs['email'] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Confirmez votre Email*</label>
            <input type="email"
                   class="form-control <?= (isset($erreurs['email_confirmation'])) ? "border border-2 border-danger" : "" ?>""
            id="exampleInputEmail1" name="email_confirmation" value="<?= $email_confirmation ?>" placeholder="Confirmez votre mail"
            aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Ne partagez jamais votre adresse email !!!</div>
            <?php if (isset($erreurs['email_confirmation'])): ?>
                <p class="form-text text-danger"><?= $erreurs['email_confirmation'] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mot de Passe*</label>
            <input type="text"
                   class="form-control <?= (isset($erreurs['mdp'])) ? "border border-2 border-danger" : "" ?>""
            id="mdp" name="mdp" value="<?= $mdp_utilisateur ?>" placeholder="Saisir votre mot de passe"
            aria-describedby="mdp">
            <div id="emailHelp" class="form-text">Ne partagez jamais votre mot de passe !!!</div>
            <?php if (isset($erreurs['email'])): ?>
                <p class="form-text text-danger"><?= $erreurs['mdp'] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Confirmez votre Mot de Passe*</label>
            <input type="text"
                   class="form-control <?= (isset($erreurs['mdp_confirmation'])) ? "border border-2 border-danger" : "" ?>""
            id="mdp" name="mdp_confirmation" value="<?= $mdp_utilisateur ?>" placeholder="Saisir votre mot de passe"
            aria-describedby="mdp_confirmation">
            <div id="emailHelp" class="form-text">Ne partagez jamais votre mot de passe !!!</div>
            <?php if (isset($erreurs['email'])): ?>
                <p class="form-text text-danger"><?= $erreurs['mdp'] ?></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
</div>
</form>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>