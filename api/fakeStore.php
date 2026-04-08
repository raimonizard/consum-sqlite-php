<?php
require_once 'fakeStoreAPIRepository.proc.php';

// 1. Recollida de dades del formulari
$id_prod = $_POST['id_prod'] ?? null;

if ($id_prod) {
    // 2. Crida al Model
    $producte = getProductFromId($id_prod);

    // 3. Lògica de control: hem trobat el producte?
    if ($producte) {
        include 'views/product_detail.view.php';
    } else {
        $error = "No s'ha trobat el producte amb ID: " . $id_prod;
        include 'views/error.view.php';
    }
} else {
    header('Location: views/formulari.html'); // Torna al formulari si no hi ha ID
}