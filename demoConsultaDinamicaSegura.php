<?php
// Connectar-se a la base de dades
require_once 'includes/dbOpenConn.php';

$nom = $_POST['nom'];
echo "<p>Buscant usuaris amb el nom: $nom</p>";

// Aquí la consulta SÍ que és segura
$stmt = $db->prepare('SELECT * FROM usuaris WHERE usu_nom = :nom');
$stmt->bindValue(':nom', $nom, SQLITE3_TEXT);

$resultats = $stmt->execute();

while ($fila = $resultats->fetchArray(SQLITE3_ASSOC)) {
    echo "ID: ". $fila['usu_id'] ." - Nom: ". $fila['usu_nom'] ." - Email: ". $fila['usu_email'] ."<br>";
}

echo "<a href='index.php'>Tornar a l'inici</a>";

require_once 'includes/dbCloseConn.php';
?>
