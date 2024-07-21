<?php
//On demare la session
session_start();
//On vérifi esi on recoit un id de la part de post
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: index.php");
    exit();
}

//Ici j'ai un id je le stocke dans une variable
$id = $_GET["id"];

//on se connecte a la bdd
require_once "db.php";

//On recupere le post concenré
$sql = "SELECT * FROM comments WHERE id= :id";
$req = $db->prepare($sql);
$req->bindvalue(":id", $id, PDO::PARAM_INT);
$req->execute();
$post = $req->fetch();

//On verifie que le post existe
if (!$post){
    http_response_code(404);
    echo "Désolé aucun poste trouvé !";
    exit();
}

//on verifie que le poste appartient à l'utilisateur
if ($_SESSION["user"]["username"] == $post->author){
    //Ici l'utilisateur a le droit de suprimer le post
    $sql = "DELETE FROM comments WHERE id= :id";
    $req = $db->prepare($sql);
    $req->bindvalue(":id", $id, PDO::PARAM_INT);
    $req->execute();
    header("Location: index.php");
} else {
    header("Location: index.php");
}
?>