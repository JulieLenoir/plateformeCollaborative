<?php
$title = "Nouveau projet | Innov8Hub";
?>
<div class="text-center">
    <h3>Création d'un nouveau projet</h3>
    <h5> Alors <?= $_SESSION['prenom_user'] ?>, une nouvelle idée ?</h5>
    <p>Dites-nous en plus en remplissant ce formulaire !</p>
</div>
<?=$alerte?>
<form action="index.php?controller=projet&action=addProjet" method="post">
    <div class="mb-3">
        <label for="titre_projet" class="form-label">Titre du projet : </label>
        <input type="text" class="form-control" name="titre_projet">
    </div>
    <div class="mb-3">
        <label for="description_projet" class="form-label">Description du projet :</label>
        <textarea class="form-control" name="description_projet" rows="3" placeholder="Quelques lignes à propos du projet..."></textarea>
    </div>
    <div class="mb-3">
        <label for="langage_projet" class="form-label">Langages du projet : </label>
        <input type="text" class="form-control" name="langage_projet" placeholder="PHP, HTML, CSS...">
    </div>
    <div class="mb-3">
        <label for="date_projet" class="form-label">Date du projet : </label>
        <input type="date" class="form-control" name="date_projet">
    </div>
    
    <button class="btn btn-info" type="submit">Suivant</button>
</form>