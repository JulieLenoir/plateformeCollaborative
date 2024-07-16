<?php
$title = 'Résultat Recherche -Plateforme Collaborative';
// var_dump($searchProjet);
// die;
?>
<h1 style="margin-bottom: 0.8em;">Votre Recherche</h1>
<a href="index.php?controller=projet&action=tableauDeBord" style="margin-bottom: 0.8em;">Retour au Tableau de Bord</a>
<section class="row">
    <?php
    foreach ($searchProjet as $value) { ?>
        <div class="card d-flex flex-row w-auto p-3" style="width: 18rem; margin-bottom:0.5em">
            <div class="card-body">
                <h5 class="card-title"><?php echo $value->titre_projet ?> </h5>
                <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $value->date_projet ?></h6>
                <p class="card-text"><?php echo $value->description_projet ?></p>
                <p class="card-text"><?php echo $value->langage_projet ?></p>
                <a href="index.php?controller=projet&action=update&id_projet=<?php echo $value->id_projet ?>" class="card-link">Modifier</a>
                <a href="index.php?controller=projet&action=delete&id_projet=<?php echo $value->id_projet ?>" class="card-link">Supprimer</a>
            </div>
        </div>
    <?php
    } ?>
</section>