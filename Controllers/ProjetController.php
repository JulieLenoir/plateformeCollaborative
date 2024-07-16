<?php
include '../Models/ProjetModel.php';
include '../Models/TacheModel.php';
include '../Models/CommModel.php';
include_once '../Models/UserModel.php';
include '../Entities/Projet.php';
include '../Entities/Commentaire.php';
include '../Entities/Tache.php';



class ProjetController extends Controller
{

    public function index()
    {
        $projet = new ProjetModel();
        $listProjet = $projet->findAll();
        // var_dump($listProjet);
        // die;


        $this->render('projet/index', ['list' => $listProjet]);
    }

    //affichage du tableau de bord
    public function tableauDeBord()
    {


        if ($_SESSION['role'] == '1') {

            // INSTANCIATION METHODE REQUETE POUR TROUVER TOUS LES PROJETS
            $projet = new ProjetModel();
            $listeProjet = $projet->findAll();
            // var_dump($listes);
            // die;
            // INSTANCIATION METHODE REQUETE POUR TROUVER TOUS LES USERS
            $user = new UserModel();
            $listeUser = $user->findAll();
            // var_dump($listes);
            // die;
            $this->render('projet/tableauDeBordAdmin', ['listeProjet' => $listeProjet, 'listeUser' =>  $listeUser]);
            // var_dump($listeUser);
            // die;

        } else {


            // définition de l'id à utiliser dans les requêtes

            $id_user = $_SESSION['id_user'];

            $user = new User;
            $user->setId_user($id_user);

            //test de la requete d'Olivier : permet de trouver tous les projets de l'utilisateur (avec toutes les données utilisateurs)
            /*$projetModel = new ProjetModel;
        $projet = $projetModel->test($user);
        var_dump($projet);
        die;*/

            //trouver les tâches de l'utilisateur connecté

            $projetModel = new ProjetModel;
            $taches = $projetModel->findYourTaches($user);



            //organiser chaque tâche trouvée dans un tableau selon son statut

            $tacheafaire = [];
            $tacheencours = [];
            $tacheover = [];

            foreach ($taches as $value) {
                if ($value->statut_tache == 'A faire') {
                    array_push($tacheafaire, $value);
                } else if ($value->statut_tache == 'En cours') {
                    array_push($tacheencours, $value);
                } else {
                    array_push($tacheover, $value);
                }
            }

            // trouver les projets de l'utilisateur connecté

            $projet = $projetModel->findYourProjets($user);

            //var_dump($projet);

            // trouver tous les collaborateurs du projet
            $collabparprojet = []; //tableau dans lequel mettre chaque collab trouvé 
            foreach ($projet as $item) {

                $id_projet = $item['id_projet'];
                //var_dump($id_projet);
                $projetid = new Projet;
                $projetid->setId_projet($id_projet);
                $collab = $projetModel->findCollab($projetid);

                array_push($collabparprojet, $collab);
            }
            //var_dump($collabparprojet);


            $this->render('projet/tableauDeBord', ['projet' => $projet, 'taches' => $taches, 'tacheafaire' => $tacheafaire, 'tacheencours' => $tacheencours, 'tacheover' => $tacheover, 'collabparprojet' => $collabparprojet]);
        }
    }

    //affichage de la page projet
    public function pageprojet()
    {

        $id_user = $_SESSION['id_user'];

        $user = new User;
        $user->setId_user($id_user);


        $id_projet = $_GET['id'];
        $projetid = new Projet;
        $projetid->setId_projet($id_projet);

        // affichage des infos du projet

        $projetmodel = new ProjetModel;
        $projet = $projetmodel->showProjet($projetid);

        // Affichage des tâches et des collaborateurs associés

        $projetmodel = new ProjetModel;
        $alltache = $projetmodel->showTaches($projetid);

        $alltacheafaire = [];
        $alltacheencours = [];
        $alltacheover = [];

        foreach ($alltache as $value1) {
            if ($value1->statut_tache == 'A faire') {
                array_push($alltacheafaire, $value1);
            } else if ($value1->statut_tache == 'En cours') {
                array_push($alltacheencours, $value1);
            } else {
                array_push($alltacheover, $value1);
            }
        }


        //trouver les tâches de l'utilisateur connecté selon le projet ouvert

        $projetModel = new ProjetModel;
        $tachesuser = $projetModel->findYourTachesHere($user, $projetid);

        //organiser chaque tâche trouvée dans un tableau selon son statut

        $tacheafaire = [];
        $tacheencours = [];
        $tacheover = [];

        foreach ($tachesuser as $value) {
            if ($value->statut_tache == 'A faire') {
                array_push($tacheafaire, $value);
            } else if ($value->statut_tache == 'En cours') {
                array_push($tacheencours, $value);
            } else {
                array_push($tacheover, $value);
            }
        }

        //var_dump($id_projet);
        // récupérer tous les collab sur le projet

        $collab = $projetModel->findCollab($projetid);

        //afficher tous les commentaires sur le projet

        $commModel = new CommModel;
        $comms = $commModel->findAllComm($projetid);

        $this->render('projet/pageprojet', ['comms' => $comms, 'collab' => $collab, 'projet' => $projet, 'alltache' => $alltache, 'tacheafaire' => $tacheafaire, 'tacheencours' => $tacheencours, 'tacheover' => $tacheover, 'alltacheafaire' => $alltacheafaire, 'alltacheencours' => $alltacheencours, 'alltacheover' => $alltacheover]);
    }

    //traitement du formulaire de post de commentaires sur le projet

    public function addComm()
    {

        $comm = new Commentaire;
        $comm->setContent_comm($_POST['content_comm']);
        $comm->setId_projet($_POST['id_projet']);
        $comm->setId_user($_POST['id_user']);

        $commModel = new CommModel;
        $newcomm = $commModel->postComm($comm);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //update du statut de la tache
    public function updateStatutTache()
    {

        $tache = new Tache;
        $tache->setId_tache($_POST['id_tache']);
        $tache->setStatut_tache($_POST['statut']);

        $tacheModel = new TacheModel;
        $modifStatut = $tacheModel->modifStatut($tache);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //affichage page de  création de nouveau projet
    public function newprojet()
    {
        $alerte = "";
        $this->render('projet/newprojet', ['alerte' => $alerte]);
    }

    /*********CREATION NOUVEAU PROJET *****************************************************************/
    //traitement du formulaire de création du projet
    public function addProjet()
    {
        $alerte = "";

        $post = [$_POST['titre_projet'], $_POST['description_projet'], $_POST['langage_projet'], $_POST['date_projet']];
        // var_dump($_POST);
        $result = Validator::postCheck($post);

        if ($result) {

            $projet = new Projet;
            $projet->setTitre_projet($_POST['titre_projet']);
            $projet->setDescription_projet($_POST['description_projet']);
            $projet->setLangage_projet($_POST['langage_projet']);
            $projet->setDate_projet($_POST['date_projet']);

            $projetModel = new ProjetModel;
            $newprojetid = $projetModel->addProjet($projet);
            //var_dump($newprojetid);

            //lier le créateur au projet dans Appartenir
            $user = new User;
            $user->setId_user($_SESSION['id_user']);
            $projet->setId_projet($newprojetid);

            $projetModel->addProjetCreator($user, $projet);

            $this->render('projet/choixcollab', ['newprojetid' => $newprojetid, 'alerte' => $alerte]);
        } else {

            $alerte = "<div class='alert alert-danger' role='alert'> Veuillez remplir tous les champs !</div>";
            $this->render('projet/newprojet', ['alerte' => $alerte]);
        }
    }
    //page choix des collaborateurs

    public function choixcollab()
    {


        $this->render('projet/choixcollab');
    }


    public function addCollab()
    {
        $projet = new Projet;
        $projet->setId_projet($_GET['id']);
        $idprojet = $_GET['id'];



        foreach ($_POST as $value) {

            $post = [$value];

            $result = Validator::postCheck($post);

            if ($result) {

                //trouver chaque utilisateur grace à son email
                $user = new User;
                $user->setEmail_user($value); //définir le mail

                $userModel = new UserModel;
                $founduser = $userModel->findUserwMail($user); //trouver l'utilisateur


                //var_dump($founduser);

                //définir l'id du projet

                if ($founduser) {

                    $user->setId_user($founduser->id_user); //définir l'id de l'utilisateur
                    $projetModel = new ProjetModel;
                    $projetModel->addProjetCreator($user, $projet);

                    header('location: index.php?controller=projet&action=tableauDeBord');
                } else {
                    $newprojetid = $_GET['id'];
                    $alerte = "<div class='alert alert-danger' role='alert'>Aucun utilisateur trouvé ! L'email renseigné doit appartenir à un utilisateur existant.</div>";
                    
                }
            } else {
                $newprojetid = $_GET['id'];
                $alerte = "<div class='alert alert-danger' role='alert'>Veuillez remplir 1 email ou passez l'étape !</div>";
            }  
        }
        $this->render('projet/choixcollab', ['alerte' => $alerte, 'newprojetid' => $newprojetid]);
    }

    //*******************************************FONCTION SEARCH SUR LA PAGE ADMIN *********************/

    // METHODE POUR RECHERCHE PAS FONCTIONNEL REVOIR POUR SEPARER RECHERCHE
    public function search()
    {
        $recherche = isset($_POST['search']) ? $_POST['search'] : NULL;
        $projetSearch = isset($_POST['projetSearch']) ? $_POST['projetSearch'] : NULL;
        // var_dump($projetSearch);
        // die;
        $search = new ProjetModel;
        $searchProjet = $search->search($projetSearch);
        $this->render('projet/search', ['searchProjet' => $searchProjet]);
    }

    // METHODE POUR AFFICHER PAGE TRANSITOIRE POUR SUPPRIMER PROJET
    public function delete()
    {
        $id_projet = $_GET['id_projet'] ?? '';
        $projet = new Projet;
        $projet->setId_projet($id_projet);
        $deleteProjet = new ProjetModel;
        $affichageProjet = $deleteProjet->findProject($projet);
        // var_dump($affichageProjet);
        // die;
        $this->render('projet/delete', ['affichageProjet' => $affichageProjet]);
    }
    // METHODE POUR SUPPRESSION PROJET
    public function traitementDelete()
    {
        $id_projet = $_GET['id_projet'] ?? '';
        // var_dump($_GET['id_projet']);
        // die;
        $projet = new Projet;
        $projet->setId_projet($id_projet);
        // var_dump($projet);
        // die;
        $deleteProjet = new ProjetModel;
        $delete = $deleteProjet->delete($projet);
        // var_dump($delete);
        // die;
        header('location: index.php?controller=projet&action=tableauDeBord');
    }

    // METHODE POUR AFFICHAGE DU FORMULAIRE PAR PROJET (TABLEAU DE BORD ADMIN)
    public function updateProjet()
    {
        $id_projet = $_GET['id_projet'];
        // var_dump($id_projet);
        // die;
        $projet = new Projet;
        $projet->setId_projet($id_projet);
        $listProject = new ProjetModel;
        $affichageProjet = $listProject->findProject($projet);
        $this->render('projet/updateProjet', ['affichageProjet' => $affichageProjet]);
    }
    // METHODE POUR TRAITER LA MODIFICATION D'UN PROJET
    public function traitementUpdateProjet()
    {
        $id_projet = $_GET['id_projet'] ?? '';
        $titre_projet = $_POST['titre_projet'] ?? '';
        $description_projet = $_POST['description_projet'] ?? '';
        $date_projet = $_POST['date_projet'] ?? '';
        $projet = new Projet;
        $projet->setId_projet($id_projet);
        $projet->setTitre_projet($titre_projet);
        $projet->setDescription_projet($description_projet);
        $projet->setDate_projet($date_projet);
        $updateProjet = new ProjetModel;
        $modifProjet = $updateProjet->updateProjet($projet);
        // var_dump($modifUser);
        // die;
        header('location:index.php?controller=projet&action=tableauDebord');
    }
}
