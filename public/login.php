<?php
//Déterminer si le formulaire a été soumis !!!
//Utilisation d'une variable superglobale $_SERVER
// $_SERVER : tableau associatif contenant des informations sur la requête
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
require_once BASE_PROJET .
    '/src/database/user.db.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    </style>
    <title>Filmosphère</title>
</head>
<body class="bg-dark-subtle">
<!--Insertion d'un menu-->
<h1 class="text-center text-dark mt-3 mb-4">Formulaire</h1>
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
            <input type="password"
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
            <input type="password"
                   class="form-control <?= (isset($erreurs['mdp_confirmation'])) ? "border border-2 border-danger" : "" ?>""
            id="mdp" name="mdp_confirmation" value="<?= $mdp_utilisateur ?>" placeholder="Saisir votre mot de passe"
            aria-describedby="mdp_confirmation">
            <div id="emailHelp" class="form-text">Ne partagez jamais votre mot de passe !!!</div>
            <?php if (isset($erreurs['email'])): ?>
                <p class="form-text text-danger"><?= $erreurs['mdp'] ?></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
</div><
</form>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<?php require_once BASE_PROJET .
    '/src/_partials/footer.php'; ?>
</body>
</html>