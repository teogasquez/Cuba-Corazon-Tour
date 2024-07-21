<?php
$title = "Accueuil || Cuba Corazon Tour";
include "components/header.php";

?>

<section class="image">
    <?php
    include "components/navbar.php";
    ?>
    <h1 class="corazon">CUBA CORAZON TOUR</h1>
    <p class="text-accueuil">Visitez Cuba comme vous ne l'avez jamais fait avec le Cuba Corazon Tour. Découvrez La Havane, ses voitures classiques et les plantations de tabac de Viñales. Avec  le Cuba Corazon Tour, profitez d'une expérience authentique, guidée par des locaux qui vous dévoileront les trésors cachés de l'île, offrant un voyage unique et profondément authentique.</p>
    <div class="button-cest-parti">
        <button class="cest-parti">C'EST PARTI</button>
    </div>



</section>

    <div class="presentation">
        <div class="div-title">
            <p class="title">
                Découvrez en un peu plus sur votre futur voyage
            </p>
        </div>
        <div class="equipe">
            <div class="personne"></div>
            <p class="pres">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab accusantium alias aliquid aperiam asperiores, aspernatur atque autem consequuntur corporis delectus deleniti dicta dolorem ducimus eligendi ex excepturi id inventore minima necessitatibus nisi nostrum nulla odit pariatur ratione repellendus reprehenderit repudiandae totam ullam veritatis! Ad blanditiis earum excepturi facere pariatur, perspiciatis placeat rerum saepe unde voluptate.</p>

        </div>

        <div class="equipe">

            <p class="pres">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt et illo laudantium magnam nemo obcaecati placeat quidem repudiandae sunt voluptatibus? Eius, odio, reiciendis! Ab accusamus, dicta distinctio doloremque ea esse eum, expedita fugit iure maxime minima nam natus nesciunt nisi non nostrum quibusdam vel voluptas, voluptatem voluptatibus. Amet asperiores aut, autem, consequun</p>

            <div class="personne"></div>
        </div>

        <div class="equipe">
            <div class="personne"></div>

            <p class="pres">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, fuga, obcaecati? Ab cumque esse excepturi itaque iure minus molestias nam necessitatibus officia, tempora temporibus tenetur vel vero. Delectus error eum omnis. Ab accusamus ad autem eveniet explicabo fuga fugiat fugit ipsam, natus nemo nostrum odio officia perferendis rerum, sunt vel voluptates! Eligendi fugit necessitatibus neque o</p>

        </div>

        <div class="equipe">

            <p class="pres">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias dolor est, excepturi exercitationem molestias perspiciatis quibusdam recusandae rem repellat sint suscipit ullam vitae. Delectus dolore dolorem eligendi eum incidunt quam quas quia! Ad aspernatur at blanditiis delectus dignissimos, eos error excepturi expedita id ipsa ipsam labore nulla, pariatur quod, quos soluta tempore! Error hic </p>

            <div class="personne"></div>
        </div>
    </div>


<?php


require_once "db.php";

//On fat une requète pour obtenir tout les posts par ordre descendant
$sql = "SELECT * FROM comments";
//Donnés non sensible, donc requete non preparée
$req = $db->query($sql);
$posts = $req->fetchAll();

?>
<div class="com">
    <section class="login-section">
        <div class="login-div">
            <p class="login-p">
                Voici les commentaires laissé par les gens qui sont venu
            </p>
        </div>
    </section>
    <section class="comments">
        <?php foreach ($posts as $post): ?>
        <div class="header-com">
            <h4><?= strip_tags($post->title)?></h4>
        </div>
        <div class="com-content">
            <div class="content">
                <p><?= strip_tags($post->content)?></p>
            </div>
            <div class="info">
                <p> Ecrit par : <?= $post->author ?></p>
                <p> Créé le : <?= $post->created_at ?></p>
            </div>
        </div>
            <a class="href-com" href="post.php?id=<?= $post->id ?>"></a>
        <?php endforeach;?>
    </section>
</div>
<?php if (isset($_SESSION["user"])): ?>
    <div class="ajt-com">
        <a class="navbar-item" href="addpost.php">
            DONNEZ VOTRE AVIS
        </a>
    </div>
<?php endif; ?>
<?php
include "components/footer.php";
?>