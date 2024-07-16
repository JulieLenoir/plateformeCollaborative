<?php
include_once '../Core/DbConnect.php';

class CommModel extends DbConnect
{

public function postComm(Commentaire $comm){

    $content_comm = $comm->getContent_comm();
    $id_projet = $comm->getId_projet();
    $id_user = $comm->getId_user();

    

    $requete = $this->connection->prepare("INSERT INTO commentaire (content_comm, id_projet, id_user) VALUES (:content_comm, :id_projet, :id_user)");
    $requete->bindParam(':content_comm', $content_comm);
    $requete->bindParam(':id_projet', $id_projet);
    $requete->bindParam(':id_user', $id_user);
    

    $newcomm = $requete->execute();

    return $newcomm;

}

public function findAllComm(Projet $projet){

    $id_projet = $projet->getId_projet();

    $requete = $this->connection->prepare("SELECT * FROM commentaire RIGHT JOIN user ON commentaire.id_user = user.id_user WHERE id_projet = :id_projet ");
    $requete->bindParam(':id_projet', $id_projet);
    $requete->execute();
    $listeComm = $requete->fetchAll();

    return $listeComm;

}


}
