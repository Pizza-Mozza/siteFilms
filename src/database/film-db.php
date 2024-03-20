<?php
function getfilm(){
// 2. Préparation de la requête
    $requete = $pdo->prepare(query: "SELECT * FROM film");

// 3. Exécution de la requête
    $requete->execute();

// 4. Récupération des enregistrements
// Un enregistrement = un tableau associatif
    $films = $requete->fetchAll(PDO::FETCH_ASSOC);
}
require_once '../../base.php';
require_once BASE_PROJET . '/src/config/db-config.php';

?>