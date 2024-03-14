<?php
//Déterminer si le formulaire a été soumis !!!
//Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête
/**
 * @var PDO $pdo
 */
require './config/db-config.php';
$erreurs = [];
$pseudo_utilisateur="";
$email_utilisateur = "";
$mdp_utilisateur ="";
$prenom="";
$nom="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Le formulaire est soumis !
    // Traiter les données du formulaire
    // Récupérer les valeurs saisies par l'utilisateur
    // Superglobale $_POST : tableau associatif

    $email = $_POST ['email'];
    echo $prenom, $nom, $email;

    // Validation des données
    if (empty($prenom)) {
        $erreurs['prenom'] = "Le prénom est obligatoire";
    }
    if (empty($nom)) {
        $erreurs['nom'] = "Le nom est obligatoire";
    }
    if (empty($email)) {
        $erreurs['email'] = "L'email est obligatoire";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'email n'est pas valide";
    }
    if (empty($mdp)) {
        $erreurs['mdp'] = "le mot de passe est incorrect";
    }

    // Traiter les données
    if (empty($erreurs)) {
        // Traitement des données (insertion dans une base de données)
        // Rediriger l'utilisateur vers une autre page du site (souvent la page d'acceuil)
        $requete = $pdo->prepare(query: "INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo_utilisateur`, `email_utilisateur`, `mdp_utilisateur`) VALUES (None, '?', '?', '?')");
        $requete->bindParam(1, $pseudo_utilisateur);
        $requete->bindParam(2, $email_utilisateur);
        $requete->bindParam(3, $mdp_utilisateur);

        $requete->execute();

        $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
        $idUtilisateur = $connexionPDO->lastInsertId();
        header("Location: ../index.php");
        exit();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../assets/css/vapor-bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gluten:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Gluten', cursive;
        }
    </style>
    <title>Document</title>
</head>
<body>
<!--Insertion d'un menu-->
<h1>Formulaire</h1>
<div class="w-50 mx-auto shadow p-4 bg-primary">
    <form action="" method="post" novalidate>
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo*</label>
            <input type="text"
                   class="form-control <?= (isset($erreurs['pseudo'])) ? "border border-2 border-danger" : "" ?>"
                   id="pseudo" name="pseudo" value="<?= $pseudo_utilisateur ?>" placeholder="Saisir votre pseudo"
                   aria-describedby="text">
            <div id="pseudo" class="form-text">Ne partagez jamais votre pseudo !!!</div>
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
            <label for="exampleInputEmail1" class="form-label">Mot de Passe*</label>
            <input type="text"
                   class="form-control <?= (isset($erreurs['mdp'])) ? "border border-2 border-danger" : "" ?>""
            id="mdp" name="mdp" value="<?= $mdp_utilisateur ?>" placeholder="Saisir votre mot de passe"
            aria-describedby="mdp">
            <div id="emailHelp" class="form-text">Ne partagez jamais votre adresse mot de passe !!!</div>
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