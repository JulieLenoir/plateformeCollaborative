<?php

$title = "Projet | Innov8Hub";

?>

<a href="index.php?controller=projet&action=tableauDeBord"><button class="btn btn-info"><i class="bi bi-arrow-left"></i> Retour au tableau de bord</button></a>

<div class="row m-3">

    <div class="col-4">
        <div class="card border-dark mb-3">
            <div class="card-header">Le projet</div>
            <div class="card-body">
                <h4><?= $projet->titre_projet ?></h4>
                <p><?= $projet->description_projet ?></p>
                <p><i><?= $projet->langage_projet ?></i></p>
                <p>Date de début : <?= $projet->date_projet ?></p>
                <p>Collaborateurs :

                    <?php
                    foreach ($collab as $perso) {
                    ?>
                        <b><?= $perso['nom_user'] ?> <?= $perso['prenom_user'] ?></b> (<?= $perso['email_user'] ?>),
                    <?php
                    }
                    ?>

                </p>
            </div>

        </div>
        <div class="card border-dark mb-3">
            <div class="card-header">Forum</div>
            <div class="card-body">
                <div class="commentSection overflow-auto" style="max-height: 10rem;">

                    <?php
                    if ($comms != NULL) {

                        foreach ($comms as $comm) {
                    ?>
                            <small class="mx-3"><b><?= $comm->prenom_user ?> <?= $comm->nom_user ?></b> <i><?= $comm->date_comm ?></i></small>
                            <div class="card border-info mb-3 mx-3">
                                <p class="card-text"><?= $comm->content_comm ?></p>
                            </div>


                        <?php
                        }
                    } else {
                        ?>

                        <p>Aucun commentaire.</p>
                    <?php
                    }


                    ?>
                </div>
                <div>
                    <form action="index.php?controller=projet&action=addComm&id=<?= $projet->id_projet ?>" method="post">
                        <textarea name="content_comm" cols="50" rows="3" class="card border-dark m-3" placeholder="Saisissez votre commentaire"></textarea>
                        <input type="hidden" name="id_projet" value=<?= $projet->id_projet ?>>
                        <input type="hidden" name="id_user" value=<?= $_SESSION['id_user'] ?>>
                        <button type="submit" class="btn btn-info mx-3">Envoyer</button>
                    </form>
                </div>

            </div>
        </div>

    </div>

    <div class="col-4">
        <div class="card border-dark mb-3">
            <div class="card-header">Tâches du projet</div>
            <div class="card-body overflow-auto" style="max-height: 45rem;">
                <div class="d-flex justify-content-center">
                </div>
                <div class="card mb-3 cardAllAfaire">
                    <div class="card-header">
                        A faire
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                        foreach ($alltacheafaire as $tache) {
                        ?>
                            <li class="list-group-item">
                                <h5><?= $tache->nom_tache ?></h5>
                                <p> <?= $tache->description_tache ?><br>
                                    <small><i><?= $tache->date_tache ?></i></small>
                                </p>
                                <p>Collaborateurs : <?= $tache->nom_user ?> <?= $tache->prenom_user ?></p>
                                <p>Statut : <?= $tache->statut_tache ?></p>

                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="card mb-3 cardAllEncours">
                    <div class="card-header">
                        En cours
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php

                        foreach ($alltacheencours as $tache) {
                        ?>
                            <li class="list-group-item">
                                <h5><?= $tache->nom_tache ?></h5>
                                <p> <?= $tache->description_tache ?><br>
                                    <small><i><?= $tache->date_tache ?></i></small>
                                </p>
                                <p>Collaborateurs : <?= $tache->nom_user ?> <?= $tache->prenom_user ?></p>
                                <p>Statut : <?= $tache->statut_tache ?></p>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="card cardAllOver">
                    <div class="card-header">
                        Terminées
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php

                        foreach ($alltacheover as $tache) {
                        ?>
                            <li class="list-group-item">
                                <h5><?= $tache->nom_tache ?></h5>
                                <p> <?= $tache->description_tache ?><br>
                                    <small><i><?= $tache->date_tache ?></i></small>
                                </p>
                                <p>Collaborateurs : <?= $tache->nom_user ?> <?= $tache->prenom_user ?></p>
                                <p>Statut : <?= $tache->statut_tache ?></p>

                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>

            </div>

        </div>
    </div>



    <div class="col-4">
        <div class="card border-dark mb-3">
            <div class="card-header">Mes tâches</div>
            <div class="card-body overflow-auto" style="max-height: 45rem;">
                <a href="index.php?controller=tache&action=newtache&id=<?= $projet->id_projet ?>&titre=<?= $projet->titre_projet ?>" class="btn btn-info m-2">Ajouter une tâche <i class="bi bi-plus-circle-fill"></i></a>
                <div class="card mb-3 cardAfaire">
                    <div class="card-header">
                        A faire
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php

                        foreach ($tacheafaire as $tache) {
                        ?>
                            <li class="list-group-item">

                                <h5><?= $tache->nom_tache ?></h5>
                                <p> <?= $tache->description_tache ?><br>
                                    <small><i><?= $tache->date_tache ?></i></small>
                                </p>


                                <form method="POST" action="index.php?controller=projet&action=updateStatutTache">
                                    <select name="statut">
                                        <option value="A faire">A faire</option>
                                        <option value="En cours">En cours</option>
                                        <option value="Terminé">Terminé</option>
                                    </select>
                                    <input type="hidden" name="id_tache" value="<?= $tache->id_tache ?>">
                                    <button class="btn btn-info" type="submit">OK</button>


                                </form>



                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="card mb-3 cardEncours">
                    <div class="card-header">
                        En cours
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php

                        foreach ($tacheencours as $tache) {
                        ?>
                            <li class="list-group-item">
                                <h5><?= $tache->nom_tache ?></h5>
                                <p> <?= $tache->description_tache ?><br>
                                    <small><i><?= $tache->date_tache ?></i></small>
                                </p>


                                <form method="POST" action="index.php?controller=projet&action=updateStatutTache">
                                    <select name="statut">
                                        <option value="En cours">En cours</option>
                                        <option value="Terminé">Terminé</option>
                                    </select>
                                    <input type="hidden" name="id_tache" value="<?= $tache->id_tache ?>">
                                    <button class="btn btn-info" type="submit">OK</button>


                                </form>

                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="card cardOver">
                    <div class="card-header">
                        Terminées
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php

                        foreach ($tacheover as $tache) {
                        ?>
                            <li class="list-group-item">
                                <h5><?= $tache->nom_tache ?></h5>
                                <p> <?= $tache->description_tache ?><br>
                                    <small><i><?= $tache->date_tache ?></i></small>
                                </p>

                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>




</div>
</div>