<?php
$title = 'Résultat Recherche -Plateforme Collaborative';
// var_dump($searchUserProjet);
// die;
?>
<h1 style="margin-bottom: 0.8em;">Votre Recherche</h1>
<a href="index.php?controller=projet&action=tableauDeBord" style="margin-bottom: 0.8em;">Retour au Tableau de Bord</a>
<section class="row">
    <?php
    foreach ($searchUser as $value) { ?>
        <div class="card d-flex flex-row w-auto p-3" style="width: 18rem; margin-bottom:0.5em">
            <div class="card-body">
                <h5 class="card-title"> <?php echo $value->prenom_user  ?> <?php echo $value->nom_user  ?> </h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">
                    <?php
                    if ($value->role_user == 0) {
                        echo 'Collaborateur';
                    } else {
                        echo 'Administrateur';
                    } ?></h6>
                <a href="index.php?controller=user&action=updateUser&id_user=<?php echo $value->id_user ?>" class="card-link">Voir les projets de <?php echo $value->prenom_user  ?> <?php echo $value->nom_user  ?></a>
                <a href="index.php?controller=user&action=delete&id_user=<?php echo $value->id_user ?>" class="card-link">Supprimer</a>
            </div>
        </div>
    <?php
    } ?>
</section>