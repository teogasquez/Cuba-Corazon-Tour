<?php

//Consatnte d'environement

const DBHOST = "localhost";
const DBUSER = "root";
const DBPASS = "";
const DBNAME = "corazon_tour";

//On crée notre dns de connexion
$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

try {
    //On instancie PDO
    $db = new PDO($dsn, DBUSER, DBPASS);
    //On configure nos echande avec la BDD en utf8
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);



}catch (PDOException $exception) {
    //On arrête le code et on affiche l'erreur en cas de probleme
    die($exception->getMessage());
}
