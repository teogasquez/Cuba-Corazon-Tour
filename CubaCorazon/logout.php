<?php
//On demare la session
session_start();

//On empeche l'utilisateur non connecté de venir ici
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

//On suprime la partie "user" de la session
unset($_SESSION["user"]);

//on redirige l'utlilisateur
header("Location: index.php");