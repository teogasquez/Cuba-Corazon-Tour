<?php
include "components/header.php";
include "components/navbar.php";

//On vérifie si on recoit un id de la part du post
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    //Ici je n'ai pas reçu d'id don je redirige l'utilisateur
    header("Location: index.php");
    exit();
}

//Ici jai recu un id de la part de post
$id = $_GET["id"];

//On se connecte à la BDD
require_once "db.php";

//On recupere l'article qu'on veut modifierdans la BDD avec une requete
$sql = "SELECT * FROM comments WHERE id = :id";
$req = $db->prepare($sql);
$req->bindvalue(":id", $id, PDO::PARAM_INT);
$req->execute();
$post = $req->fetch();

//On vérifie que le post est vide
if (!$post){
    http_response_code(404);
    echo "Désolé aucun poste trouvé !";
    exit();
}

$title = "CubaCorazon || $post->title";

//On vérifie si le post apppartient à l'utilisateur
if ($_SESSION["user"]["username"] == $post->author) {
    //On traite le formulaire
    if (!empty($_POST)) {
        if (!empty($_POST["title"]) && !empty($_POST["content"])) {
            //Ici le formulaire est complet
            //On recupere les info en les protegeant
            $postTitle = strip_tags($_POST["title"]);
            $postContent = strip_tags($_POST["content"]);
            $author = $post->author;

            //On peut enregistrer les donnés

            //Sql
            $sql = "UPDATE comments SET title = :title, content = :content, author = :author WHERE id = :id";
            $req = $db->prepare($sql);
            $req->bindvalue(":title", $postTitle);
            $req->bindvalue(":content", $postContent);
            $req->bindvalue(":author", $author);
            $req->bindvalue(":id", $id);

            if ($req->execute()) {
                http_response_code(500);
                echo "Désolé quelque chose n'a pas fonctionné";
                exit();
            }


            //Ici on a reussi a modifier le post
            header("Location: post.php?id=" .$id);
        }
    }



} else {
    header("Location: index.php");
}



?>

<section class="login-section">
    <div class="login-div">
        <p class="login-p">
            Modifiez votre commentaire
        </p>
    </div>
</section>
<section class="updatepost">
    <form method="post">
        <div class="champ">
            <label for="title" class="label">
                Titre
            </label>
            <div class="control">
                <input type="text" class="input" name="title" value=<?= $post->title ?>>
            </div>
            <div class="field">
                <label for="content" class="label">Contenu</label>
                <div class="control">
                    <textarea name="content" class="textarea" ><?= $post->content ?></textarea>
                </div>
            </div>
            <div class="control">
                <button class="button" type="submit">Modifier mon post</button>
            </div>
        </div>
    </form>
</section>
