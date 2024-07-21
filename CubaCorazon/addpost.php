<?php
$title = "CubaCorazon || Ajouter un article";
include "components/header.php";
include "components/navbar.php";

//On verifie le formulaire
if (!empty($_POST)) {
    if (isset($_POST["title"], $_POST["content"]) && !empty($_POST["title"]) && !empty($_POST["content"])) {
        //Ici le formulaire est rempli
        //On recupere les infos donnés par les utilisateurs
        $postTitle = strip_tags($_POST["title"]);
        $postContent = strip_tags($_POST["content"]);
        $postCreated_at = date("Y-m-d H:i:s");
        $author = $_SESSION["user"]["username"];

        //On peut enregistrer les donnés
        //On se connect a notre base de données
        require_once "db.php";

        var_dump($_POST);

        //SQL pour la requete préparée
        $sql = "INSERT INTO comments (title, content, created_at, author) VALUES (?, ?, ?, ?)";

        //On prepare la requete
        $req = $db->prepare($sql);
        //On bind les valeurs
        $req->bindValue(1, $postTitle);
        $req->bindValue(2, $postContent);
        $req->bindValue(3, $postCreated_at);
        $req->bindValue(4, $author);
        //On execute la requête
        if (!$req->execute()) {
            die("une erreur c'est produite");
        } else {
            //Si vous souhaitez l'id de nouveau post créer
            $id = $db->lastInsertId();
            header("Location: index.php");
        }
    } else {
        die("le formulaire est incomplet");
    }
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
                <input type="text" class="input" name="title" >
            </div>
            <div class="field">
                <label for="content" class="label">Contenu</label>
                <div class="control">
                    <textarea name="content" class="textarea" ></textarea>
                </div>
            </div>
            <div class="control">
                <button class="button" type="submit">Ajouter un commentaire</button>
            </div>
        </div>
    </form>
</section>
