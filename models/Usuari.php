<?php

class Usuari {
    private $usu_id;
    private $usu_nom;
    private $usu_email;

    public function __construct($usu_id = null, $usu_nom = null, $usu_email = null) {
        $this->usu_id = $usu_id;
        $this->usu_nom = $usu_nom;
        $this->usu_email = $usu_email;
    }

    // Getters
    public function getId() {
        return $this->usu_id;
    }

    public function getNom() {
        return $this->usu_nom;
    }

    public function getEmail() {
        return $this->usu_email;
    }

    // Setters
    public function setId($usu_id) {
        $this->usu_id = $usu_id;
    }

    public function setNom($usu_nom) {
        $this->usu_nom = $usu_nom;
    }

    public function setEmail($usu_email) {
        $this->usu_email = $usu_email;
    }
}
?>