<?php
$title = 'Accueil | Innov8Hub'
?>

<div id="presentation" style="text-align:center;" class="p-5 ">
    <h1>Innov8Hub</h1>

    <p>Transformez vos aspirations en innovations concrètes sur Innov8hub, la plateforme collaborative qui propulse l'émergence des idées les plus audacieuses.</p>
    <?php
    if (!isset($_SESSION['prenom_user'])) {


    ?>
        <a href="index.php?controller=user&action=register"><button type="button" class="btn btn-info">S'inscrire</button></a>
        <a href="index.php?controller=user&action=login"><button type="button" class="btn btn-info">Se connecter</button></a>

    <?php
    }

    ?>
</div>
<div class="row align-items-center justify-content-center">

    <div class="illustration col-4 justify-content-evenly">
        <img src="../public/images/network2" class="m-auto" alt="network" width="50%">
    </div>
    <div class="card col-6">
        <div class="card-body">
            Chez Innov8Hub, le travail d'équipe est la clé de voûte de notre démarche innovante.
            Notre plateforme collaborative prospère grâce à la diversité des compétences et à la synergie créative
            entre nos membres. C'est un catalyseur essentiel qui transforme les idées individuelles en réalisations collectives,
            propulsant ainsi notre communauté vers l'excellence innovante. En favorisant la collaboration,
            nous créons un écosystème où l'innovation prend son envol, offrant des solutions audacieuses et ouvrant la voie à une réussite partagée.
        </div>
    </div>

</div>

<div class="row align-items-center justify-content-evenly p-5">
    <div class="card col-6">
        <div class="card-body">

            Les collaborateurs chez Innov8Hub ne sont pas simplement des membres,
            mais des acteurs clés dans la réalisation de notre vision collective.
            Chacun apporte une expertise unique et une perspective précieuse, créant ainsi un mélange dynamique
            de compétences au sein de notre communauté. Ensemble, ils forment un réseau collaboratif où l'innovation
            prospère, alimentée par la diversité des talents et la passion partagée pour repousser les limites.
            Chez Innov8Hub, nous valorisons chaque contribution, reconnaissant que c'est la synergie de nos collaborateurs
            qui propulse notre plateforme vers de nouveaux horizons créatifs. Leur engagement et leur créativité font
            d'eux les piliers de notre réussite collective, et leur collaboration inspire constamment
            de nouvelles idées et opportunités au sein de notre écosystème d'innovation.</div>
    </div>
    <div class="illustration col-4 justify-content-center">
        <img src="../public/images/teamwork" class="m-auto" alt="network" width="50%">
    </div>


</div>