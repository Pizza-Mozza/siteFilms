<?php
require_once '../base.php';
require_once BASE_PROJET .
    '/src/config/db-config.php';
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
        header("Location: ../public/index.php");
        exit();
    }
}
?>