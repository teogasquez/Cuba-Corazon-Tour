<?php

//On vérifie si on recoit un id de la part de blog.php


if (!isset($_GET["id"]) || empty($_GET["id"])) {
    //ici je n'ai pas d'id
    header("location: index.php");
    exit();
}

//ICI J'AI UN ID
$id = $_GET["id"];


require_once "db.php";

$sql = "SELECT * FROM comments WHERE id = ?";
$req = $db->prepare($sql);
$req->bindValue(1, $id, PDO::PARAM_INT);
$req->execute();
$post = $req->fetch();

$title = "CubaCorazon || $post->title";

include "components/header.php";
include "components/navbar.php";


//On vérifie si le post est vide
if (!$post) {
    http_response_code(404);
    echo "Votre commentaire est vide";
    echo "<a href='index.php' class='retour-post'>Retour<a/>";
}
?>


<section class="login-section">
    <div class="login-div">
        <p class="login-p">
            <?= $post->title ?>
        </p>
    </div>
</section>

<section class="comments">
        <div class="header-com">
            <h4><?= strip_tags($post->title)?></h4>
        </div>
        <div class="com-content">
            <div class="content">
                <p><?= strip_tags($post->content)?></p>
                <p> Ecrit par : <?= $post->created_at ?></p>
                <p> Créé le : <?= $post->created_at ?></p>
            </div>
        </div>
    <footer>
        <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["username"] === $post->author):?>
            <a href="updatepost.php?id=<?= $post->id ?>" class="button-a">Modifier</a>
            <a href="deletepost.php?id=<?= $post->id ?>" class="button-a">Suprimer</a>
            <a href="index.php" class="button-a">Retour</a>
        <?php else: ?>
            <a class="button-a" href="index.php?id=<?= $post->id ?>">Retour</a>
        <?php endif; ?>
    </footer>
</section>