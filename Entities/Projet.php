<?php

class Projet
{

    private $id_projet;
    private $titre_projet;
    private $description_projet;
    private $date_projet;
    private $langage_projet;

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

    /**
     * Get the value of titre_projet
     */
    public function getTitre_projet()
    {
        return $this->titre_projet;
    }

    /**
     * Set the value of titre_projet
     *
     * @return  self
     */
    public function setTitre_projet($titre_projet)
    {
        $this->titre_projet = $titre_projet;

        return $this;
    }

    /**
     * Get the value of description_projet
     */
    public function getDescription_projet()
    {
        return $this->description_projet;
    }

    /**
     * Set the value of description_projet
     *
     * @return  self
     */
    public function setDescription_projet($description_projet)
    {
        $this->description_projet = $description_projet;

        return $this;
    }

    /**
     * Get the value of date_projet
     */
    public function getDate_projet()
    {
        return $this->date_projet;
    }

    /**
     * Set the value of date_projet
     *
     * @return  self
     */
    public function setDate_projet($date_projet)
    {
        $this->date_projet = $date_projet;

        return $this;
    }

    /**
     * Get the value of langage_projet
     */
    public function getLangage_projet()
    {
        return $this->langage_projet;
    }

    /**
     * Set the value of langage_projet
     *
     * @return  self
     */
    public function setLangage_projet($langage_projet)
    {
        $this->langage_projet = $langage_projet;

        return $this;
    }
}
