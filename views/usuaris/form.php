<?php

$usuari = null;
if ($_GET['action'] === 'edit') {
    $usuari = $controller->getUsuari($_GET['id'])['usuari'] ?? null;
}
$isEdit = $usuari !== null;
?>

<h1><?= $isEdit ? 'Editar Usuari' : 'Crear Usuari' ?></h1>

<form method="POST" action="index.php?action=<?= $isEdit ? 'update' : 'create' ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuari->getId()) ?>">
    <?php endif; ?>
    
    <label>Nom:</label>
    <input type="text" name="nom" value="<?= $isEdit ? htmlspecialchars($usuari->getNom()) : '' ?>" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?= $isEdit ? htmlspecialchars($usuari->getEmail()) : '' ?>" required>
    
    <button type="submit"><?= $isEdit ? 'Actualitzar' : 'Crear' ?></button>
    <a href="index.php">Cancel·lar</a>
</form>