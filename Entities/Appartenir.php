<?php

class Appartenir
{

    private $id_user;
    private $id_projet;


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
