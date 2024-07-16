<?php

class Tache
{
    private $id_tache;
    private $nom_tache;
    private $description_tache;
    private $statut_tache;
    private $date_tache;
    private $id_user;
    private $id_projet;

    /**
     * Get the value of id_tache
     */
    public function getId_tache()
    {
        return $this->id_tache;
    }

    /**
     * Set the value of id_tache
     *
     * @return  self
     */
    public function setId_tache($id_tache)
    {
        $this->id_tache = $id_tache;

        return $this;
    }

    /**
     * Get the value of nom_tache
     */
    public function getNom_tache()
    {
        return $this->nom_tache;
    }

    /**
     * Set the value of nom_tache
     *
     * @return  self
     */
    public function setNom_tache($nom_tache)
    {
        $this->nom_tache = $nom_tache;

        return $this;
    }

    /**
     * Get the value of description_tache
     */
    public function getDescription_tache()
    {
        return $this->description_tache;
    }

    /**
     * Set the value of description_tache
     *
     * @return  self
     */
    public function setDescription_tache($description_tache)
    {
        $this->description_tache = $description_tache;

        return $this;
    }

    /**
     * Get the value of statut_tache
     */
    public function getStatut_tache()
    {
        return $this->statut_tache;
    }

    /**
     * Set the value of statut_tache
     *
     * @return  self
     */
    public function setStatut_tache($statut_tache)
    {
        $this->statut_tache = $statut_tache;

        return $this;
    }

    /**
     * Get the value of date_tache
     */
    public function getDate_tache()
    {
        return $this->date_tache;
    }

    /**
     * Set the value of date_tache
     *
     * @return  self
     */
    public function setDate_tache($date_tache)
    {
        $this->date_tache = $date_tache;

        return $this;
    }

    /**
     * Get the value of id_user
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of id_projet
     */
    public function getId_projet()
    {
        return $this->id_projet;
    }

    /**
     * Set the value of id_projet
     *
     * @return  self
     */
    public function setId_projet($id_projet)
    {
        $this->id_projet = $id_projet;

        return $this;
    }
}
