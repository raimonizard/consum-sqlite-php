<?php

function mostrarTotsElsUsers() {
    $stmt = $db->prepare('SELECT * FROM usuaris');

    $resultats = $stmt->execute();
}

function mostrarUsuari($nom) {
    $stmt = $db->prepare('SELECT * FROM usuaris WHERE usu_nom = :nom');
    $stmt->bindValue(':nom', $nom, SQLITE3_TEXT);

    $resultats = $stmt->execute();
}