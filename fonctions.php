<?php
function getBdd() {
return new PDO("mysql:host=localhost:3306;dbname=db_cinema;charset=utf8",
"root", "",
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
foreach ($logins as $login){
    if ($login["email_utilisateur"]==$email #COMMENTAIRE:EMAIL FORMULAIRE ){
    $id_bdd = $login["id_utilisateur"];
    $mdp_bdd = $login["mdp_utilisateur"];
    $test++;
}
}
function pdologin(){
    $pdo = getConnexion();
    $requete_films = $pdo->prepare("SELECT * FROM utilisateur");
    $requete_films->execute();
    $login = $requete_films->fetchAll(PDO::FETCH_ASSOC);
    return $login;
}
