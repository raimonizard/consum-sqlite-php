<?php

function getUsers(): array {
    require_once '../includes/dbOpenConn.php';

    $stmt = $db->prepare('SELECT * FROM usuaris');
    $resultats = $stmt->execute();

    require_once '../includes/dbCloseConn.php';

    return $resultats;
}

function getUser($nom): array {

    require_once '../includes/dbOpenConn.php';

    $stmt = $db->prepare('SELECT * FROM usuaris WHERE usu_nom = :nom');
    $stmt->bindValue(':nom', $nom, SQLITE3_TEXT);

    $resultats = $stmt->execute();

    require_once '../includes/dbCloseConn.php';

    return $resultats;
}