<?php

require_once __DIR__ . '/../models/Usuari.php';

class UsuariDAO {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Insert new user
    public function insert(Usuari $usuari) {
        $stmt = $this->db->prepare("INSERT INTO usuaris (usu_nom, usu_email) VALUES (:nom, :email)");
        $stmt->bindValue(':nom', $usuari->getNom(), SQLITE3_TEXT);
        $stmt->bindValue(':email', $usuari->getEmail(), SQLITE3_TEXT);
        
        if ($stmt->execute()) {
            $usuari->setId($this->db->lastInsertRowID());
            return true;
        }
        return false;
    }

    // Update existing user
    public function update(Usuari $usuari) {
        $stmt = $this->db->prepare("UPDATE usuaris SET usu_nom = :nom, usu_email = :email WHERE usu_id = :id");
        $stmt->bindValue(':nom', $usuari->getNom(), SQLITE3_TEXT);
        $stmt->bindValue(':email', $usuari->getEmail(), SQLITE3_TEXT);
        $stmt->bindValue(':id', $usuari->getId(), SQLITE3_INTEGER);
        
        return $stmt->execute() ? true : false;
    }

    // Delete user
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM usuaris WHERE usu_id = :id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        
        return $stmt->execute() ? true : false;
    }

    // Get user by ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuaris WHERE usu_id = :id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        
        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            return new Usuari($row['usu_id'], $row['usu_nom'], $row['usu_email']);
        }
        return null;
    }

    // Get all users
    public function getAll() {
        $result = $this->db->query("SELECT * FROM usuaris");
        $usuaris = [];
        
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $usuaris[] = new Usuari($row['usu_id'], $row['usu_nom'], $row['usu_email']);
        }
        
        return $usuaris;
    }

    public function searchByName($nom) {
        $stmt = $this->db->prepare("SELECT * FROM usuaris WHERE usu_nom LIKE :nom");
        $stmt->bindValue(':nom', '%' . $nom . '%', SQLITE3_TEXT);
        $result = $stmt->execute();
        
        $usuaris = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $usuaris[] = new Usuari($row['usu_id'], $row['usu_nom'], $row['usu_email']);
        }
        return $usuaris;
    }

}
?>