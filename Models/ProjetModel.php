<?php

include_once '../Core/DbConnect.php';

class ProjetModel extends DbConnect
{

    // REQUETE POUR AFFICHAGE TOUS LES PROJETS
    public function findAll()
    {
        try {
            $this->request =  $this->connection->prepare("SELECT
            projet.id_projet,
            projet.titre_projet,
            projet.description_projet,
            projet.date_projet,
            projet.langage_projet,
            GROUP_CONCAT(CONCAT(user.nom_user, ' ', user.prenom_user) SEPARATOR ', ') AS utilisateurs
        FROM
            projet
        LEFT JOIN
            Appartenir ON projet.id_projet = Appartenir.id_projet
        LEFT JOIN
            user ON Appartenir.id_user = user.id_user
        GROUP BY
            projet.id_projet, projet.titre_projet, projet.description_projet, projet.date_projet, projet.langage_projet;");
            // $this->request =  $this->connection->prepare("SELECT* FROM projet
            // INNER JOIN user ON projet.id_projet = user.id_user");
            $this->request->execute();
            $listProjet =  $this->request->fetchAll();
            // var_dump($listProjet);
            // die;
            return $listProjet;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }

    // retrouver les taches par utilisateur
    public function findYourTaches(User $user)
    {
        $id = $user->getId_user();

        $request = "SELECT * FROM tache INNER JOIN projet ON tache.id_projet = projet.id_projet WHERE id_user = :id_user";
        $prep = $this->connection->prepare($request);
        $prep->bindParam(':id_user', $id);
        $prep->execute();
        $listeTaches = $prep->fetchAll();

        return $listeTaches;
    }

    // retrouver les taches par utilisateur ET id_projet
    public function findYourTachesHere(User $user, Projet $projet)
    {
        $id = $user->getId_user();
        $idprojet = $projet->getId_projet();


        $request = "SELECT * FROM tache INNER JOIN projet ON tache.id_projet = projet.id_projet WHERE id_user = :id_user AND tache.id_projet = :id_projet";
        $prep = $this->connection->prepare($request);
        $prep->bindParam(':id_user', $id);
        $prep->bindParam(':id_projet', $idprojet);
        $prep->execute();
        $listeTaches = $prep->fetchAll();

        return $listeTaches;
    }

    //retrouver les projets par utilisateurs

    public function findYourProjets(User $user)
    {

        $id = $user->getId_user();

        $requete = "SELECT * FROM projet RIGHT JOIN appartenir ON projet.id_projet = appartenir.id_projet WHERE appartenir.id_user= :id_user";
        $prep = $this->connection->prepare($requete);
        $prep->bindParam(':id_user', $id);
        $prep->execute();
        $projet = $prep->fetchAll(PDO::FETCH_ASSOC);

        return $projet;
    }

    // retrouver tous les collaborateurs des projets

    public function findCollab(Projet $projet)
    {


        $idprojet = $projet->getId_projet();

        $requete = "SELECT * FROM user RIGHT JOIN appartenir ON user.id_user = appartenir.id_user WHERE appartenir.id_projet= :id_projet";
        $prep = $this->connection->prepare($requete);
        $prep->bindParam(':id_projet', $idprojet);
        $prep->execute();
        $collab = $prep->fetchAll(PDO::FETCH_ASSOC);

        return $collab;
    }


    // affichage de la page du projet par id

    public function showProjet(Projet $projet)
    {

        $idprojet = $projet->getId_projet();

        $requete = "SELECT * FROM projet  WHERE id_projet= :id_projet";

        $prep = $this->connection->prepare($requete);
        $prep->bindParam(':id_projet', $idprojet);
        $prep->execute();
        $projet = $prep->fetch();

        return $projet;
    }

    public function showTaches(Projet $projet)
    {
        $idprojet = $projet->getId_projet();

        //$requete = "SELECT * FROM user INNER JOIN tache ON tache.id_user = user.id_user INNER JOIN projet ON tache.id_projet = projet.id_projet  WHERE tache.id_projet= :id_projet";
        $requete = "SELECT * FROM projet INNER JOIN tache ON tache.id_projet = projet.id_projet INNER JOIN user ON tache.id_user = user.id_user  WHERE projet.id_projet= :id_projet";
        $prep = $this->connection->prepare($requete);
        $prep->bindParam(':id_projet', $idprojet);
        $prep->execute();
        $alltache = $prep->fetchAll(PDO::FETCH_OBJ);

        return $alltache;
    }

    public function addProjet(Projet $projet)
    {

        $titre_projet = $projet->getTitre_projet();
        $description_projet = $projet->getDescription_projet();
        $langage_projet = $projet->getLangage_projet();
        $date_projet = $projet->getDate_projet();


        $requete = $this->connection->prepare("INSERT INTO projet (titre_projet, description_projet, langage_projet, date_projet) VALUES (:titre_projet, :description_projet, :langage_projet, :date_projet)");
        $requete->bindParam(':titre_projet', $titre_projet);
        $requete->bindParam(':description_projet', $description_projet);
        $requete->bindParam(':langage_projet', $langage_projet);
        $requete->bindParam(':date_projet', $date_projet);

        $newProjet = $requete->execute();

        $id_newprojet = $this->connection->lastInsertId();

        return $id_newprojet;
    }

    public function addProjetCreator(User $user, Projet $projet)
    {

        $id_user = $user->getId_user();
        $id_projet = $projet->getId_projet();

        $requete = $this->connection->prepare("INSERT INTO appartenir (id_user, id_projet) VALUES (:id_user, :id_projet)");
        $requete->bindParam(':id_user', $id_user);
        $requete->bindParam(':id_projet', $id_projet);

        $newProjetUser = $requete->execute();

        return $newProjetUser;
    }

    // recupérer projets et tâches associées ok
    public function projectsAndTasks(User $userId)
    {
        $this->request = $this->connection->prepare("SELECT projet.id_projet, projet.titre_projet, projet.description_projet, projet.date_projet
                FROM user
                LEFT JOIN appartenir ON user.id_user = appartenir.id_user
                LEFT JOIN projet ON appartenir.id_projet = projet.id_projet
                WHERE user.id_user = :id_user");
        $this->request->bindValue(':id_user', $userId->getId_user());
        $this->request->execute();
        $userProjects = $this->request->fetchAll(PDO::FETCH_ASSOC);
        foreach ($userProjects as &$project) {
            $project['taches'] = [];
            $this->request = $this->connection->prepare("SELECT tache.nom_tache, tache.description_tache, tache.date_tache
                    FROM tache
                    WHERE tache.id_projet = :id_projet");
            $this->request->bindValue(':id_projet', $project['id_projet']);
            $this->request->execute();
            $project['taches'] = $this->request->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($this->request->fetch());
            // die;
        }
        // var_dump($userProjects);
        // die;
        return $userProjects;
    }

    // REQUETE POUR FAIRE UNE RECHERCHE DANS BARRE DE RECHERCHE DU USERCONTROLLER
    public function search()
    {
        $projetSearch = isset($_POST['projetSearch']) ? $_POST['projetSearch'] : NULL;
        // var_dump($userSearch);
        // die;
        $this->request = $this->connection->prepare("SELECT * FROM projet
       WHERE titre_projet LIKE :titre_projet ");
        $this->request->bindValue(':titre_projet', "%" . $projetSearch . "%");
        $this->request->execute();
        $results = $this->request->fetchAll();
        return $results;
    }

    // REQUETE POUR SUPPRIMER UN PROJET
    public function delete(Projet $delete_projet)
    {
        try {
            $this->request = $this->connection->prepare(" DELETE
             FROM projet
             WHERE id_projet = :id_projet;");
            $this->request->bindValue(":id_projet", $delete_projet->getId_projet());
            $supprProjet = $this->request->execute();
            return $supprProjet;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }

    // REQUETE POUR AFFICHAGE D'UN SEUL PROJET POUR FAIRE LA MODIF ENSUITE ET LA SUPPRESSION
    public function findProject(Projet $projet)
    {
        try {
            $this->request =  $this->connection->prepare("SELECT  *
         FROM projet
         WHERE projet.id_projet = :id_projet
      ");
            $this->request->bindValue(':id_projet', $projet->getId_projet());
            $this->request->execute();
            $listProjet =  $this->request->fetch();
            // var_dump($listUser);
            // die;
            return $listProjet;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }

    // REQUETE POUR MODIFIER LES INFORMATIONS D'UN PROJET
    public function updateProjet(Projet $info_projet)
    {
        try {
            $this->request =  $this->connection->prepare("UPDATE projet
        SET id_projet = :id_projet, titre_projet = :titre_projet, description_projet = :description_projet,
        date_projet = :date_projet
    WHERE id_projet=:id_projet");
            $this->request->bindValue(":id_projet", $info_projet->getId_projet());
            $this->request->bindValue(":titre_projet", $info_projet->getTitre_projet());
            $this->request->bindValue(":description_projet", $info_projet->getDescription_projet());
            $this->request->bindValue(":date_projet", $info_projet->getDate_projet());
            $modif = $this->request->execute();
            // var_dump($modif);
            // die;
            return $modif;
        } catch (PDOException $e) {
            echo 'Erreur:' . $e->getMessage();
        }
    }

























    //test de la requete d'Olivier : permet de trouver tous les projets de l'utilisateur (avec toutes les données utilisateurs)
    /* public function test(User $user, Projet $projet){
        $id = $user->getId_user();
        $id_projet = $projet->getId_projet();

        $requete = "SELECT * FROM tache INNER JOIN  projet ON projet.id_projet = tache.id_projet INNER JOIN user ON user.id_user = tache.id_user WHERE user.id_user = :id_user && projet.id_projet = :id_projet";
        $prep = $this->connection->prepare($requete);
        $prep->bindParam(':id_user', $id);
        $prep->bindParam(':id_projet', $id_projet);
        $prep->execute();
        $projet = $prep->fetchAll(PDO::FETCH_ASSOC);
        
        return $projet;
    }*/

    //chercher collaborateurs par email lors de la création d'un nouveau projet

}
