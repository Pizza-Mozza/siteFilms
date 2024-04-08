<?php
function getBdd() {
return new PDO("mysql:host=localhost:3306;dbname=db_cinema;charset=utf8",
"root", "",
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
function pdologin(){
    $pdo = getConnexion();
    $requete_films = $pdo->prepare("SELECT * FROM utilisateur");
    $requete_films->execute();
    $login = $requete_films->fetchAll(PDO::FETCH_ASSOC);
    return $login;
}
function escape($valeur)
{
    // Convertit les caractères spéciaux en entités HTML
    return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
}