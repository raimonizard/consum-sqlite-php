<?php
// 1. Connectar-se (SQLite ja gestiona si el fitxer existeix o no)
require_once 'dbOpenConn.php';

// 2. Crear la taula amb restricció UNIQUE al correu
$db->exec("CREATE TABLE IF NOT EXISTS usuaris (
    usu_id INTEGER PRIMARY KEY AUTOINCREMENT, 
    usu_nom TEXT, 
    usu_email TEXT UNIQUE
)");

// 3. Inserir registres usant 'OR IGNORE'
// Això evita duplicats basant-se en la restricció UNIQUE de 'usu_email'
$db->exec("INSERT OR IGNORE INTO usuaris (usu_nom, usu_email) VALUES ('Joan', 'joan@itb.cat')");
$db->exec("INSERT OR IGNORE INTO usuaris (usu_nom, usu_email) VALUES ('Alícia', 'alicia@itb.cat')");
$db->exec("INSERT OR IGNORE INTO usuaris (usu_nom, usu_email) VALUES ('Francesc', 'francesc@itb.cat')");

// Opcional: Comprovar quants registres s'han inserit realment
echo "Files afectades: " . $db->changes();

// 4. Tancar la connexió
require_once 'dbCloseConn.php';
?>