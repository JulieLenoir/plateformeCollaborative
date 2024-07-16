<?php

class Commentaire
{
    private $id_comm;
    private $content_comm;
    private $date_comm;
    private $id_projet;
    private $id_user;

    /**
     * Get the value of id_comm
     */
    public function getId_comm()
    {
        return $this->id_comm;
    }

    /**
     * Set the value of id_comm
     *
     * @return  self
     */
    public function setId_comm($id_comm)
    {
        $this->id_comm = $id_comm;

        return $this;
    }

    /**
     * Get the value of content_comm
     */
    public function getContent_comm()
    {
        return $this->content_comm;
    }

    /**
     * Set the value of content_comm
     *
     * @return  self
     */
    public function setContent_comm($content_comm)
    {
        $this->content_comm = $content_comm;

        return $this;
    }

    /**
     * Get the value of date_comm
     */
    public function getDate_comm()
    {
        return $this->date_comm;
    }

    /**
     * Set the value of date_comm
     *
     * @return  self
     */
    public function setDate_comm($date_comm)
    {
        $this->date_comm = $date_comm;

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
}
