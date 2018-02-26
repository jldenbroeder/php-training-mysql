<?php
// Connexion à la base de données MySQL en LOCALHOST
$db = "reunion_island"; // Nom de la base de données
try
{
  // Sans affichage d'erreur des requetes
//  $bdd = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', 'root', '');
  $bdd = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
//  die('Erreur : ' . $e->getMessage());
  die('ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage());
}

//try {
//    $strConnection = 'mysql:host=localhost;dbname=ma_base'; //Ligne 1
//    $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); 
//    $pdo = new PDO($connStr, 'Utilisateur', 'Mot de passe', $arrExtraParam); // Instancie la connexion
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Ligne 4
//}
//catch(PDOException $e) {
//    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
//    die($msg);
//}
?>