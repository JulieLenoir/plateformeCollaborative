<?php
$title = 'Suppression projet -Plateforme Collaborative';
// var_dump($affichageProjet);
// die;
?>
<h1 style="margin-top: 0.8em; margin-bottom: 2em;">Suppression Projet</h1>
<p>Etes-vous sûr de vouloir supprimer le projet <strong>
        <?php echo $affichageProjet->titre_projet ?> </strong></p>
<a href="index.php?controller=projet&action=traitementDelete&id_projet=<?php echo $affichageProjet->id_projet ?>">
    <button style="margin-bottom: 2em;" type="submit" class="btn btn-danger">Supprimer</button>
</a>