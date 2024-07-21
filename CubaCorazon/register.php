<?php
$title ="CubaCorazon || Inscription";
include "components/header.php";
include "components/navbar.php";

//On vérifie si le formulaire est envoyé
if (!empty($_POST)) {
    //Ici le formulaire est envoye
    //On vérifie que tous les champs soient rempli
    if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["nom"], $_POST["prenom"])  && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])  && !empty($_POST["nom"])  && !empty($_POST["prenom"])) {
        //Ici le formulaire est complet
        //On peut recuperer les donnée et les proteger
        $username = strip_tags($_POST["username"]);
        $email = strip_tags($_POST["email"]);
        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        //On vérifie si l'email est un email
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("L'adresse email n'est pas valide");
        }
        //Ici on a un email valide
        //On hache le mots de passe
        $password = password_hash($_POST["password"] , PASSWORD_ARGON2ID);

        //Ici on peut faire des controles supplementaire

        //On peut enregistrer notre user
        //On se connecte a la bdd
        require_once "db.php";

        //Requete preparée
        $sql = "INSERT INTO user (username, email, password, nom, prenom) VALUES (?, ?, ?, ?, ?)";
        $req = $db->prepare($sql);
        $req->bindValue(1, $username);
        $req->bindValue(2, $_POST["email"]);
        $req->bindValue(3, $password);
        $req->bindValue(4, $nom);
        $req->bindValue(5, $prenom);
        $req->execute();

        //On recupere l'id de l'utilisateur crée
        $id = $db->lastInsertId();
        //On stock dans $_SESSION les informations de l'utilisateur
        $_SESSION["user"] = [
            "id" => $id,
            "username" => $username,
            "email" => $_POST["email"],
            "nom" => $nom,
            "prenom" => $prenom
        ];
        //On redirige l'utilisateur vers la page blog
        header("Location: index.php");

    } else{
        die("Le formulaire est incomplet");
    }
}

?>


    <div class="form">

        <section class="login-section">
            <div class="login-div">
                <p class="login-p">
                    Je me connecte a mon prochain voyage
                </p>
            </div>
        </section>

        <form method="post" class="login-form">
            <div class="header">
                <header class="header-p">
                    Connectez vous a votre liberté
                </header>
            </div>

            <div class="champ">
                <label for="username" class="label">Nom D'utilisateur</label>
                <input type="text" name="username" class="input" placeholder=" Votre nom d'utilisateur">
            </div>
            <div class="champ">
                <label for="email" class="label">Email</label>
                <input type="email" name="email" class="input" placeholder=" votre email">
            </div>
            <div class="champ">
                <label for="password" class="label">Mot de passe</label>
                <input type="password" name="password" class="input" placeholder=" votre mot de passe">
            </div>
            <div class="champ">
                <label for="nom" class="label">Nom</label>
                <input type="text" name="nom" class="input" placeholder=" Votre nom">
            </div>
            <div class="champ">
                <label for="prenom" class="label">Prenom</label>
                <input type="text" name="prenom" class="input" placeholder=" Votre prenom">
            </div>
            <div class="div-button">
                <button type="submit" class="button">
                    S'inscrire
                </button>
            </div>

        </form>
    </div>
<?php
include "components/footer.php";
