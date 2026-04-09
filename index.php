<?php
require_once __DIR__ . '/includes/dbOpenConn.php';
require_once __DIR__ . '/controllers/UsuariController.php';

$controller = new UsuariController($db);
$action = $_GET['action'] ?? 'menu'; // Per defecte, el menú
$result = null;

// Gestió de peticions POST (Accions)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'create') {
        $result = $controller->createUsuari($_POST['nom'], $_POST['email']);
        
        if ($result['success']) {
            // Si ha anat bé, redirigim per evitar re-enviaments de formulari
            header("Location: index.php?action=list&msg=creat");
            exit(); // Molt important aturar l'execució aquí
        }
    } elseif ($action === 'update') {
        $result = $controller->updateUsuari($_POST['id'], $_POST['nom'], $_POST['email']);
        header("Location: index.php?action=list&msg=actualitzat");
        exit();
    } elseif ($action === 'delete') {
        $controller->deleteUsuari($_POST['id']);
        header("Location: index.php?action=list&msg=eliminat");
        exit();
    }
}

// Preparació de dades per a les vistes GET
if ($action === 'list') {
    $result = $controller->getAllUsuaris();
} elseif ($action === 'search_results') {
    $result = $controller->buscarUsuaris($_GET['nom_cerca'] ?? '');
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <head>
        <meta charset="UTF-8">
        <title>Gestió d'Usuaris</title>
        <link rel="stylesheet" href="public/css/style.css">
    </head>    
</head>
<body>
    <?php
        include __DIR__ . '/views/partials/nav_bar.html';
    ?>

    <div class="container">
        <?php if (isset($_GET['msg'])): ?>
            <div style="padding: 10px; margin-bottom: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb;">
                <?php
                    if ($_GET['msg'] === 'creat') echo "Usuari creat correctament!";
                    if ($_GET['msg'] === 'actualitzat') echo "Usuari actualitzat amb èxit!";
                    if ($_GET['msg'] === 'eliminat') echo "Usuari eliminat correctament.";
                ?>
            </div>
        <?php endif; ?>

        <?php 
        switch($action) {
            case 'create':
            case 'edit':
                include __DIR__ . '/views/usuaris/form.php';
                break;
                
            case 'list':
            case 'search_results':
                // Reutilitzem la vista de llista per mostrar resultats de cerca
                include __DIR__ . '/views/usuaris/list.php';
                break;

            case 'menu':
            default:
                ?>
                <h1>Menú de Gestió</h1>
                <p>Benvingut al sistema de gestió d'usuaris. Tria una opció:</p>
                <ul>
                    <li><a href="index.php?action=list">Veure tots els usuaris</a></li>
                    <li><a href="index.php?action=create">Afegir un nou usuari</a></li>
                </ul>
                
                <hr>
                <h3>Buscar Usuari</h3>
                <form method="GET" action="index.php">
                    <input type="hidden" name="action" value="search_results">
                    <input type="text" name="nom_cerca" placeholder="Nom de l'usuari...">
                    <button type="submit">Cercar</button>
                </form>
                <?php
                break;
        }
        ?>
    </div>
</body>
</html>