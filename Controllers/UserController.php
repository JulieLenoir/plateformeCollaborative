<?php
include_once '../Models/UserModel.php';
include '../Entities/User.php';
include_once '../Core/Validator.php';



class UserController extends Controller
{

    // AFFICHAGE FORMULAIRE POUR S'AUTHENTIFIER - action du form envoie vers méthode traitementLogin
    public function login()
    {
        $alerte = '';
        $this->render('user/login', ['alerte' => $alerte]);
    }
    // TRAITEMENT DU FORMULAIRE D'AUTHENTIFICATION (view/user/login) - REQUETE login(User $loginUser)DANS UserModel
    public function traitementLogin()
    {
        $alerte = '';
        $email_user = $_POST['email'] ?? '';
        $password_user = $_POST['password'] ?? '';
        isset($_POST['valider']);
        // var_dump($_POST);
        // die;
        // vérification avec le validator
        $post = [$email_user, $password_user];
        $result = Validator::postCheck($post);
        if ($result == true) {

            $user = new User;

            $user->setEmail_user($email_user);
            // $user->setPassword_user($password_user);
            $traitementLogin = new UserModel;
            $ValidationLogin = $traitementLogin->login($user); //vérifie si l'email tapé existe dans la BDD
            // var_dump($ValidationLogin);
            // die;
            if ($_POST['valider'] = true) {
                // vérifie si l'email est existant et que le mot de passe tapé correspond au hash associé à l'email dans la BDD
                if ($ValidationLogin && password_verify($password_user, $ValidationLogin->password_user)) {
                    $_SESSION['user'] = $_POST['email'];
                    $_SESSION['id_user'] = $ValidationLogin->id_user;
                    $_SESSION['prenom_user'] = $ValidationLogin->prenom_user;
                    $_SESSION['role'] = $ValidationLogin->role_user;
                    // var_dump($_SESSION);
                    // die;
                    //$this->render('projet/tableauDeBord');
                    header('location: index.php?controller=projet&action=tableauDeBord');
                } else {
                    // si le mot de passe ne correspond pas ou que l'email est inconnu
                    $alerte = "<div class='alert alert-danger' role='alert'>Mauvais couple login/mot de passe ! </div>";
                    $this->render('user/login', ['alerte' => $alerte]);
                }
            }
        } else {
            // REVOIR AFFICHAGE ALERTE
            //si tous les champs ne sont pas complétés
            $alerte = "<div class='alert alert-danger' role='alert'> Veuillez remplir tous les champs !</div>";
            $this->render('user/login', ['alerte' => $alerte]);
        }
    }



    public function register()
    {

        $alerte = '';
        $this->render('user/register', ['alerte' => $alerte]);
    }


    public function registertraitement()
    {

        $alerte = '';
        $nom = $_POST['nom_user'];
        $prenom = $_POST['prenom_user'];
        $email = $_POST['email_user'];
        $mdp = $_POST['password_user'];

        $post = [$nom, $prenom, $email, $mdp];

        $result = Validator::postCheck($post); // vérifie que tous les champs sont renseignés

        if ($result == true) {
            $hash = password_hash($mdp, PASSWORD_DEFAULT); // password hashé si renseigné
            $user = new User;
            $user->setNom_user($nom);
            $user->setPrenom_user($prenom);
            $user->setEmail_user($email);
            $user->setPassword_user($hash);

            $userModel = new UserModel;
            $userModel->newUser($user); // données enregistrées

            $alerte = "<div class='alert alert-info' role='alert'>Inscription prise en compte ! Veuillez vous connecter.</div>";

            $this->render('user/login', ['alerte' => $alerte]);
        } else {

            $alerte = "<div class='alert alert-danger' role='alert'> Veuillez remplir tous les champs !</div>";
            $this->render('user/register', ['alerte' => $alerte]);
        }
    }


    public function logout()
    {

        session_unset();
        $this->render('home/index');
    }

    // METHODE POUR AFFICHAGE DU FORMULAIRE PAR USER (TABLEAU DE BORD ADMIN)
    public function updateUser()
    {
        $id_user = $_GET['id_user'];
        // var_dump($id);
        // die;
        $user = new User;
        $user->setId_user($id_user);
        // $user->setRole_user($role_user);
        $findUser = new UserModel;
        $affichageUser = $findUser->findUser($user);
        $listTask = new ProjetModel;
        $projectsAndTask = $listTask->projectsAndTasks($user);
        $this->render('user/updateUser', ['affichageUser' => $affichageUser, 'projectsAndTask' => $projectsAndTask]);
    }
    // METHODE POUR TRAITER LA MODIFICATION D'UN USER
    public function traitementUpdateUser()
    {
        $id_user = $_GET['id_user'] ?? '';
        $nom_user = $_POST['nom_user'] ?? '';
        $prenom_user = $_POST['prenom_user'] ?? '';
        $email_user = $_POST['email_user'] ?? '';
        // $role_user = $_POST['role_user'] ?? '';
        // var_dump($_POST['nom_user'], $_POST['prenom_user'], $_POST['email_user'], $_POST['role_user']);
        // die;
        $user = new User;
        $user->setId_user($id_user);
        $user->setNom_user($nom_user);
        $user->setPrenom_user($prenom_user);
        $user->setEmail_user($email_user);
        // $user->setRole_user($role_user);
        $updateUser = new UserModel;
        $modifUser = $updateUser->updateUser($user);
        // var_dump($modifUser);
        // die;
        header('location:index.php?controller=projet&action=tableauDebord');
    }

    // METHODE POUR AFFICHER PAGE TRANSITOIRE POUR SUPPRIMER COMPTE USER
    public function delete()
    {
        $id_user = $_GET['id_user'] ?? '';
        $user = new User;
        $user->setId_user($id_user);
        $deleteUser = new UserModel;
        $affichageUser = $deleteUser->findUser($user);
        // var_dump($affichageUser);
        // die;
        $this->render('user/delete', ['affichageUser' => $affichageUser]);
    }
    // METHODE POUR SUPPRESSION USER
    public function traitementDelete()
    {
        $id_user = $_GET['id_user'] ?? '';
        // var_dump($_GET['id_user']);
        // die;
        $user = new User;
        $user->setId_user($id_user);
        // var_dump($user);
        // die;
        $deleteUser = new UserModel;
        $delete = $deleteUser->delete($user);
        // var_dump($delete);
        // die;
        header('location: index.php?controller=projet&action=tableauDeBord');
    }
}
