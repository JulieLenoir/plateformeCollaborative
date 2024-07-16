<?php
include_once '../Core/DbConnect.php';
class TacheModel extends DbConnect
{

    public function modifStatut(Tache $tache){

        $id_tache = $tache->getId_tache();
        $statut_tache = $tache->getStatut_tache();

        $requete = $this->connection->prepare("UPDATE tache SET statut_tache = :statut_tache WHERE id_tache = :id_tache");
        $requete->bindParam(':statut_tache', $statut_tache);
        $requete->bindParam(':id_tache', $id_tache);

        $modifStatut = $requete->execute();
        return $modifStatut;

    }

    public function addTache(Tache $tache){

        $nom_tache = $tache->getNom_tache();
        $description_tache = $tache->getDescription_tache();
        $id_projet = $tache-> getId_projet();
        $date_tache = $tache->getDate_tache();
        $statut_tache = $tache->getStatut_tache();
        $id_user = $tache->getId_user();

        $requete = $this->connection->prepare("INSERT INTO tache (nom_tache, description_tache, statut_tache, date_tache, id_projet, id_user)
        VALUES (:nom_tache, :description_tache, :statut_tache, :date_tache, :id_projet, :id_user)");
        $requete->bindParam(':statut_tache', $statut_tache);
        $requete->bindParam(':nom_tache', $nom_tache);
        $requete->bindParam(':description_tache', $description_tache);
        $requete->bindParam(':date_tache', $date_tache);
        $requete->bindParam(':id_projet', $id_projet);
        $requete->bindParam(':id_user', $id_user);

        $newtache = $requete->execute();
        return $newtache;


    }

}
