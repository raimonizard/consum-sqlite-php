<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Detall del Producte</title>
</head>
<body>
    <h1>Resultat de la cerca:</h1>
    
    <div class="product-card">
        <h2><?php echo $producte['title']; ?></h2>
        <p><strong>Preu:</strong> <?php echo $producte['price']; ?>€</p>
        <p><?php echo $producte['description']; ?></p>
        <img src="<?php echo $producte['image']; ?>" width="150">
    </div>

    <br>
    <a href="/views/formulari.html">Tornar enrere</a>
</body>
</html>