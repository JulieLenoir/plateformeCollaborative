<?php
$title = 'Modification Collaborateur -Plateforme Collaborative';
// var_dump($projectsAndTask);
// die;
?>
<h1 style="text-align: center; margin-bottom:2em;">Tableau de Bord <br>
    <?php echo $affichageUser->prenom_user ?> <?php echo $affichageUser->nom_user ?></h1>
<div style="display: flex;">
    <div>
        <h5>Modification du profil
        </h5>
        <form action="index.php?controller=user&action=traitementUpdateUser&id_user=<?php echo $affichageUser->id_user ?>" method="post" class="card" style="width: 18rem;">
            <div class="col-md-6">
                <label for="nom_user" class="form-label">Nom</label>
                <input type="text" name="nom_user" class="form-control" value="<?php echo $affichageUser->nom_user ?>">
            </div>
            <div class="col-md-6">
                <label for="prenom_user" class="form-label">Prénom</label>
                <input type="text" name="prenom_user" class="form-control" value="<?php echo $affichageUser->prenom_user ?>">
            </div>
            <div class=" col-12">
                <label for="role_user" class="form-label">Rôle</label>
                <select name="role" class="form-select" aria-label="Default select example">
                    <option value="0">Collaborateur</option>
                    <option value="1">Administrateur</option>
                </select>
            </div>
            <div class="col-12">
                <label for="email_user" class="form-label">Email</label>
                <input type="email" name="email_user" class="form-control" value="<?php echo $affichageUser->email_user ?>">
            </div>
            <input type="submit" name="modifier" class="form-control" value="Modifier">
        </form>
    </div>
    <section style="margin-left:0.5em;">
        <h5>Liste des Projets et Tâches</h5>
        <?php foreach ($projectsAndTask as $index => $project) : ?>
            <div class="card" style="width: 18rem; margin-left:0.5em; margin-bottom:0.5em;">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $project['titre_projet'] ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">
                        <?= $project['date_projet'] ?>
                    </h6>
                    <p class="card-text">
                        <?= $project['description_projet'] ?>
                    </p>
                </div>
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($project['taches'] as $task) : ?>
                            <li class="list-group-item"><?= $task['nom_tache'] ?></li>
                        <?php endforeach; ?>
                        <li class="list-group-item"></li>
                    </ul>
                    <a href="index.php?controller=projet&action=updateProjet&id_projet=<?= $project['id_projet'] ?>" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>












