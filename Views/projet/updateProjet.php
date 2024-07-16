<?php
$title = 'Modification Projet -Plateforme Collaborative';
// var_dump($affichageProjet);
// die;
?>
<h1 style="text-align: center; margin-bottom:2em;">Tableau de Bord <br>
    <?php echo $affichageProjet->titre_projet ?></h1>
<a href="index.php?controller=projet&action=tableauDeBord" style="margin-bottom: 0.8em;">Retour au Tableau de Bord</a>
<div style="display: flex;">
    <div style="width: 100%;">
        <h5>Modification d'un projet
        </h5>
        <form action="index.php?controller=projet&action=traitementUpdateProjet&id_projet=<?php echo $affichageProjet->id_projet ?>" method="post" class="card w-100 p-3" style="width: 100%;">
            <div class="w-auto p-3">
                <label for="titre_projet" class="form-label">Titre Projet</label>
                <input type="text" name="titre_projet" class="form-control" value="<?php echo $affichageProjet->titre_projet ?>">
            </div>
            <div class="w-auto p-3 ">
                <label for="description_projet" class="form-label">Description</label>
                <input type="text" name="description_projet" class="form-control" value="<?php echo $affichageProjet->description_projet ?>">
            </div>
            <div class="w-auto p-3">
                <label for="date_projet" class="form-label">Date</label>
                <input type="date" name="date_projet" class="form-control" value="<?php echo $affichageProjet->date_projet ?>">
            </div>
            <input type="submit" name="modifier" class=" btn btn-primary w-25 p-3 form-control" value="Modifier">
        </form>
    </div>