<?php

$title = "Tableau de bord | Innov8Hub";

?>


<div class="row m-3">

    <div class="col-5">
        <div class="card border-dark mb-3">
            <div class="card-header">Mes projets</div>
            <div class="card-body">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <!-- à inclure dans un foreach touslesprojets as projet -->
                    <?php


                    foreach ($projet as $value) {
                        $uniqueId = 'project_' . $value['id_projet'];
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $uniqueId ?>" aria-expanded="false" aria-controls="<?= $uniqueId ?>">
                                    <?= $value['titre_projet'] ?>
                                </button>
                            </h2>
                            <div id="<?= $uniqueId ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <p><i><?= $value['date_projet'] ?></i></p>
                                    <p><?= $value['description_projet'] ?></p>
                                    <p><b><?= $value['langage_projet'] ?></b></p>

                                    <p>Collaborateurs :
                                    <ul>
                                        <?php
                                        foreach ($collabparprojet as $collaboration) {
                                            foreach ($collaboration as $collab) {
                                                if ($collab['id_projet'] == $value['id_projet']) {

                                        ?>
                                                    <li><?= $collab['nom_user'] ?> <?= $collab['prenom_user'] ?><br>

                                                        <?= $collab['email_user'] ?></li>

                                        <?php

                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                    </p>
                                    <a href="index.php?controller=projet&action=pageprojet&id=<?= $value['id_projet'] ?>"><button class="btn btn-info" type="submit">Voir le projet</button></a>

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- fin du foreach -->
                </div>

            </div>
        </div>

    </div>

    <div class="col-5">
        <div class="card border-dark mb-3">
            <div class="card-header">Mes tâches</div>
            <div class="card-body">
                <div class="card mb-3" id="cardAfaire">
                    <div class="card-header">
                        A faire
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php

                        foreach ($tacheafaire as $tache) {
                        ?>
                            <li class="list-group-item">
                                <h6><b><?= $tache->titre_projet ?></b></h6>
                                <h5><?= $tache->nom_tache ?></h5>
                                <p>
                                    <?= $tache->description_tache ?><br>
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
                <div class="card" id="cardEncours">
                    <div class="card-header">
                        En cours
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php

                        foreach ($tacheencours as $tache) {
                        ?>
                            <li class="list-group-item">
                            <h6><b><?= $tache->titre_projet ?></b></h6>
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

            </div>
        </div>
    </div>

    <div class="col-2">
        <a href="index.php?controller=projet&action=newprojet"><button type="button" class="btn btn-info">Créer un nouveau projet</button></a>
    </div>



</div>