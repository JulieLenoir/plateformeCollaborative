<?php
include_once '../Models/TacheModel.php';
include_once '../Entities/Tache.php';
include_once '../Entities/Projet.php';
include_once '../Models/UserModel.php';


class TacheController extends Controller
{

    public function newTache()
    {

        $alerte = '';
        $this->render('tache/newtache', ['alerte' => $alerte]);
    }

    public function addTache()
    {

        //var_dump($_POST);


        $post = [$_POST['nom_tache'], $_POST['description_tache'], $_POST['date_tache']];
        // var_dump($_POST);
        $result = Validator::postCheck($post);

        if ($result) {

            $tache = new Tache;
            $tache->setNom_tache($_POST['nom_tache']);
            $tache->setDescription_tache($_POST['description_tache']);
            $tache->setStatut_tache($_POST['statut_tache']);
            $tache->setDate_tache($_POST['date_tache']);
            $tache->setId_projet($_POST['id_projet']);
            $tache->setId_user($_POST['id_user']);

            $tacheModel = new TacheModel;
            $newtache = $tacheModel->addTache($tache);
            //var_dump($newprojetid);

            //lier le créateur au projet dans Appartenir


            $this->render('projet/tableauDeBord');
        } else {

            header('Location: index.php?controller=home&action=error');
        }
    }
}
