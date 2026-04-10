<h1>Llistat d'Usuaris</h1>

<?php if (isset($result) && !$result['success']): ?>
    <p style="color: red;"><?= htmlspecialchars($result['message']) ?></p>
<?php endif; ?>

<a href="index.php?action=create">Crear nou usuari</a>

<?php if (!empty($result['usuaris'])): ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Accions</th>
        </tr>
        <?php foreach ($result['usuaris'] as $usuari): ?>
            <tr>
                <td><?= htmlspecialchars($usuari->getId()) ?></td>
                <td><?= htmlspecialchars($usuari->getNom()) ?></td>
                <td><?= htmlspecialchars($usuari->getEmail()) ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?= $usuari->getId() ?>">Editar</a>
                    <form method="POST" action="index.php?action=delete" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $usuari->getId() ?>">
                        <button type="submit" onclick="return confirm('Segur?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No hi ha usuaris.</p>
<?php endif; ?>