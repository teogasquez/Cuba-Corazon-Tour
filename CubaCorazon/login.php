<?php

$title = "CubaCorazon || Login";
include "components/header.php";
include "components/navbar.php";

if(!empty($_POST)) {

    if(isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

        //On vérifie si l'email est bien un email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("L'adress email est incorrecte:");
        }

        //On peut enregistrer notre user
        //On se connecte à la BDD
        require_once "db.php";

        //Requête préparée
        $sql = "SELECT * FROM user WHERE email = :email";
        $req = $db->prepare($sql);
        $req->bindValue(":email", $_POST["email"]);
        $req->execute();
        $user = $req->fetch();

        //Si l'email entré dans le formulaire n'existe pas dans la BDD
        if(!$user) {
            die("Infomrations de connexion incorrectes");
        }

        //Ici, j'ai un utilisateur inscrit en BDD
        //Je compare les mots de passe
        if(!password_verify($_POST["password"], $user->password)) {
            die("Infomrations de connexion incorrectes");
        }

        //Ici on a un utilisateur qui a le droit de se connecter
        //On stock les infos dans la session
        $_SESSION["user"] = [
            "id" => $user->id,
            "username" => $user->username,
            "email" => $user->email
        ];
        header("Location: index.php");
    } else {
        die("Le formulaire est incomplet:");
    }
}

?>

<section class="login-section">
    <div class="login-div">
        <p class="login-p">
            Je me connecte a mon prochain voyage
        </p>
    </div>
</section>

<div class="form">
    <form method="post" class="login-form">
        <div class="header">
            <header class="header-p">
                J'accede à la liberté

            </header>
        </div>
        <div class="champ">
            <label for="email" class="label">Adresse email</label>
            <input type="email" name="email" class="input" placeholder=" Votre adresse email...">
        </div>
        <div class="champ">
            <label for="password" class="label">Mot de passe</label>
            <input type="password" name="password" class="input" placeholder=" Votre mot de passe...">
        </div>
        <div class="div-button">
            <button type="submit" class="button">Se Connecter</button>
        </div>
        <div class="div-button">
            <button type="button" class="button">
                <a href="register.php" class="href">S'inscrire</a>
            </button>
        </div>

    </form>
</div>
<?php
include "components/footer.php";
