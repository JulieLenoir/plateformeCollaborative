<?php
$title = "Nouveau projet | Innov8Hub";
?>
<a href="index.php?controller=projet&action=pageprojet&id=<?= $_GET['id'] ?>"><button class="btn btn-info"><i class="bi bi-arrow-left"></i> Retour vers <?= $_GET['titre'] ?></button></a>
<div class="text-center">
    <h3>Ajout d'une nouvelle tâche</h3>
    <h5> Dites-nous <?= $_SESSION['prenom_user'] ?>, what's next ?</h5>
    <p>Quelle tâche voulez-vous ajouter à <?= $_GET['titre'] ?> ?</p>
</div>
<?=$alerte?>
<form action="index.php?controller=tache&action=addtache" method="post">
    <div class="mb-3">
        <label for="nom_tache" class="form-label">Titre de la tâche : </label>
        <input type="text" class="form-control" name="nom_tache">
    </div>
    <div class="mb-3">
        <label for="description_tache" class="form-label">Description de la tâche :</label>
        <textarea class="form-control" name="description_tache" rows="3" placeholder="Quelques lignes à propos de la tâche..."></textarea>
    </div>
    <div class="mb-3">
        <label for="date_tache" class="form-label">Date de la tâche : </label>
        <input type="date" class="form-control" name="date_tache">
    </div>
    <input type="hidden" name="statut_tache" value="A faire">
    <input type="hidden" name="id_projet" value="<?= $_GET['id'] ?>">
    <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">

    <button class="btn btn-info" type="submit">Suivant</button>
</form>