<?php
$title = 'Tableau de Bord Admin -Plateforme Collaborative';
?>
<h1 style="text-align: center;">Tableau de Bord Administrateur</h1>
<div class="d-flex justify-content-around affichage">
    <div class="affichageProjet" style="width: 50%; margin-right:0.8em">
        <h5 style="text-align: center; margin-top:2em">Listes des Projets</h5>
        <form action="index.php?controller=projet&action=search" method="post" class="w-auto p-3" role="search">
            <input name="projetSearch" class="form-control me-2 " type="search" placeholder="Rechercher projet " aria-label="Search">
            <button name="search" class="btn btn-primary mb-3" type="submit" style="margin-top: 0.5em;">Rechercher projet</button>
        </form>
        <div class="card mb-3 overflow-auto" style="max-height: 45rem;">
            <?php
            // var_dump($listes);
            // die;
            foreach ($listeProjet as $value) {
            ?>
                <div class="card m-3 d-flex flex-row w-auto p-3" style="width: 18rem; margin-bottom:0.5em">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $value->titre_projet ?> </h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $value->date_projet ?></h6>
                        <p class="card-text"><?php echo $value->description_projet ?></p>
                        <p class="card-text"><?php echo $value->langage_projet ?></p>
                        <p class="card-text"><?php echo $value->utilisateurs ?></p>
                        <a href="index.php?controller=projet&action=pageprojet&id=<?= $value->id_projet ?>"><button class="btn btn-primary" type="submit">Voir le projet</button></a>
                        <a href="index.php?controller=projet&action=updateProjet&id_projet=<?php echo $value->id_projet ?>" class="card-link"><button class="btn btn-info" type="submit">Modifier</button></a>
                        <a href="index.php?controller=projet&action=delete&id_projet=<?php echo $value->id_projet ?>" class="card-link"><button class="btn btn-danger" type="submit">Supprimer</button></a>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
    <div class="affichageUser" style="width: 50%;">
        <h5 style="text-align: center; margin-top:2em">Listes des utilisateurs</h5>
        <form action="index.php?controller=user&action=search" method="post" class="w-auto p-3" role="search">
            <input name="userSearch" class="form-control me-2 " type="search" placeholder="Rechercher collaborateur" aria-label="Search">
            <button name="search" class="btn btn-primary mb-3" type="submit" style="margin-top: 0.5em;">Rechercher collaborateur</button>
        </form>

        <div class="card mb-3 overflow-auto" style="max-height: 45rem;">
            <?php
            foreach ($listeUser as $value) {
            ?>
                <div class="card m-3 d-flex flex-row w-auto p-3" style="width: 18rem; margin-bottom:0.5em">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $value->prenom_user  ?> <?php echo $value->nom_user  ?> </h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            <?php
                            if ($value->role_user == 0) {
                                echo 'Collaborateur';
                            } else {
                                echo 'Administrateur';
                            } ?></h6>
                        <p>Projet en cours : <br>
                            <?php
                            echo $value->projets;
                            ?></p>
                        <p>Tâches : <br>
                            <?php echo $value->taches ?><br>
                            <a href="index.php?controller=user&action=updateUser&id_user=<?php echo $value->id_user ?>" class="card-link">Modifier</a>
                            <a href="index.php?controller=user&action=delete&id_user=<?php echo $value->id_user ?>" class="card-link">Supprimer</a>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>