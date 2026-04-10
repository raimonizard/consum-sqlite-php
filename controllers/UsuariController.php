<?php

require_once __DIR__ . '/../dao/UsuariDAO.php';
require_once __DIR__ . '/../models/Usuari.php';

class UsuariController {
    private $usuariDAO;

    public function __construct($db) {
        $this->usuariDAO = new UsuariDAO($db);
    }

    // Create a new user
    public function createUsuari($nom, $email) {
        if (empty($nom) || empty($email)) {
            return ['success' => false, 'message' => 'Nom i email són obligatoris'];
        }

        $usuari = new Usuari(null, $nom, $email);
        
        if ($this->usuariDAO->insert($usuari)) {
            return ['success' => true, 'message' => 'Usuari creat correctament', 'usuari' => $usuari];
        }
        return ['success' => false, 'message' => 'Error al crear l\'usuari'];
    }

    // Get user by ID
    public function getUsuari($id) {
        if (empty($id)) {
            return ['success' => false, 'message' => 'ID requerida'];
        }

        $usuari = $this->usuariDAO->getById($id);
        
        if ($usuari) {
            return ['success' => true, 'usuari' => $usuari];
        }
        return ['success' => false, 'message' => 'Usuari no trobat'];
    }

    // Search users by name
    public function buscarUsuaris($nom) {
       $usuaris = $this->usuariDAO->searchByName($nom);
        return ['success' => true, 'usuaris' => $usuaris];
    }    

    // Get all users
    public function getAllUsuaris() {
        $usuaris = $this->usuariDAO->getAll();
        return ['success' => true, 'usuaris' => $usuaris];
    }

    // Update user
    public function updateUsuari($id, $nom, $email) {
        if (empty($id) || empty($nom) || empty($email)) {
            return ['success' => false, 'message' => 'ID, nom i email són obligatoris'];
        }

        $usuari = new Usuari($id, $nom, $email);
        
        if ($this->usuariDAO->update($usuari)) {
            return ['success' => true, 'message' => 'Usuari actualitzat correctament'];
        }
        return ['success' => false, 'message' => 'Error al actualitzar l\'usuari'];
    }

    // Delete user
    public function deleteUsuari($id) {
        if (empty($id)) {
            return ['success' => false, 'message' => 'ID requerida'];
        }

        if ($this->usuariDAO->delete($id)) {
            return ['success' => true, 'message' => 'Usuari eliminat correctament'];
        }
        return ['success' => false, 'message' => 'Error al eliminar l\'usuari'];
    }

}