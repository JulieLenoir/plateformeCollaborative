<?php
include_once '../Core/DbConnect.php';
class UserModel extends DbConnect
{

    // REQUETE POUR AFFICHAGE TOUS LES USERS
    public function findAll()
    {
        try {
            $this->request =  $this->connection->prepare("SELECT
            user.id_user,
            user.nom_user,
            user.prenom_user,
            user.email_user,
            user.password_user,
            user.role_user,
            GROUP_CONCAT(DISTINCT projet.titre_projet SEPARATOR ', ') AS projets,
            GROUP_CONCAT(DISTINCT tache.nom_tache SEPARATOR ', ') AS taches
        FROM
            user
        LEFT JOIN
            Appartenir ON user.id_user = Appartenir.id_user
        LEFT JOIN
            projet ON Appartenir.id_projet = projet.id_projet
        LEFT JOIN
            tache ON user.id_user = tache.id_user
        GROUP BY
            user.id_user, user.nom_user, user.prenom_user, user.email_user, user.password_user, user.role_user;
        ");
            // LEFT JOIN est utilisé pour inclure tous les utilisateurs même s'ils n'ont pas d'entrées
            // correspondantes dans la table Appartenir, tous les projets même s'ils n'ont pas d'entrées
            // correspondantes dans la table tache, et toutes les tâches même si elles n'ont pas d'entrées
            // correspondantes dans la table projet.
            // // Les colonnes sélectionnées incluent des informations sur l'utilisateur,
            // le projet et la tâche associée.
            // $this->request =  $this->connection->prepare("SELECT* FROM user");
            // la partie GROUP_CONCAT pour taches afin de concaténer les différentes colonnes de la table tache avec un séparateur.
            // La fonction CONCAT est utilisée pour regrouper ces colonnes dans une seule chaîne.
            $this->request->execute();
            $listUser =  $this->request->fetchAll();
            // var_dump($listUser);
            // die;
            return $listUser;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }
    // REQUETE QUI VERIFIE SI PASSWORD ET EMAIL USER VONT ENSEMBLE
    // recherche email existant dans la base de données
    public function login(User $loginUser)
    {
        try {
            $this->request =  $this->connection->prepare("SELECT * FROM user
            WHERE email_user=:email_user");
            $this->request->bindValue(':email_user', $loginUser->getEmail_user());
            //$this->request->bindValue(':password_user', $loginUser->getPassword_user());
            $this->request->execute();
            $login_user = $this->request->fetch();
            // var_dump($login_user);
            // die;
            return $login_user;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }


    // inscription nouvel utilisateur (rôle automatiquement sur 0 = utilisateur normal)
    public function newUser(User $user)
    {
        $nom_user = $user->getNom_user();
        $prenom_user = $user->getPrenom_user();
        $email_user = $user->getEmail_user();
        $password_user = $user->getPassword_user();

        $requete = $this->connection->prepare("INSERT INTO user (nom_user, prenom_user, email_user, password_user) VALUES (:nom_user, :prenom_user, :email_user, :password_user)");
        $requete->bindParam(':nom_user', $nom_user);
        $requete->bindParam(':prenom_user', $prenom_user);
        $requete->bindParam(':email_user', $email_user);
        $requete->bindParam(':password_user', $password_user);

        $newUser = $requete->execute();

        return $newUser;
    }



    public function findUserwMail(User $user)
    {

        $email_user = $user->getEmail_user();

        $requete = $this->connection->prepare("SELECT * FROM user WHERE email_user = :email_user");
        $requete->bindParam(':email_user', $email_user);

        $requete->execute();
        $findUser = $requete->fetch();

        return $findUser;
    }

    // REQUETE POUR AFFICHAGE D'UN SEUL COLLABORATEUR POUR FAIRE LA MODIF ENSUITE
    public function findUser(User $user)
    {
        try {
            $this->request =  $this->connection->prepare("SELECT  *
            FROM user
            WHERE user.id_user = :id_user
         ");
            $this->request->bindValue(':id_user', $user->getId_user());
            $this->request->execute();
            $listUser =  $this->request->fetch();
            // var_dump($listUser);
            // die;
            return $listUser;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }
    // REQUETE POUR MODIFIER LES INFORMATIONS D'UN UTILISATEURS
    public function updateUser(User $info_user)
    {
        try {
            $this->request =  $this->connection->prepare("UPDATE user
        SET id_user = :id_user, nom_user = :nom_user, prenom_user = :prenom_user,
        email_user = :email_user, role_user=':role_user'
    WHERE id_user=:id_user");
            $this->request->bindValue(":id_user", $info_user->getId_user());
            $this->request->bindValue(":nom_user", $info_user->getNom_user());
            $this->request->bindValue(":prenom_user", $info_user->getPrenom_user());
            $this->request->bindValue(":email_user", $info_user->getEmail_user());
            $this->request->bindValue(":role_user", $info_user->getRole_user());
            $modif = $this->request->execute();
            // var_dump($modif);
            // die;
            return $modif;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }

    // REQUETE POUR SUPPRIMER UN COLLABORATEUR NE FONCTIONNE PAS
    public function delete(User $delete_user)
    {
        try {
            $this->request = $this->connection->prepare(" DELETE
            FROM user
            WHERE id_user = :id_user;");
            $this->request->bindValue(":id_user", $delete_user->getId_user());
            $supprUser = $this->request->execute();
            return $supprUser;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }

    // REQUETE POUR FAIRE UNE RECHERCHE DANS BARRE DE RECHERCHE DU USERCONTROLLER
    public function search()
    {
        $userSearch = isset($_POST['userSearch']) ? $_POST['userSearch'] : NULL;
        // var_dump($userSearch);
        // die;
        $this->request = $this->connection->prepare("SELECT * FROM user
        WHERE nom_user LIKE :nom_user OR prenom_user LIKE :prenom_user");
        $this->request->bindValue(':nom_user', "%" . $userSearch . "%");
        $this->request->bindValue(':prenom_user', "%" . $userSearch . "%");
        $this->request->execute();
        $results = $this->request->fetchAll();
        return $results;
    }

    
}
