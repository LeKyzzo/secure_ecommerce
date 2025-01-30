<?php
session_start();
require_once 'includes/db.php';
include 'header.php';

// Récupération des produits depuis la base de données
$stmt = $pdo->query("SELECT * FROM products LIMIT 6");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Bienvenue sur notre boutique en ligne</h2>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p>Prix : <?= number_format($product['price'], 2) ?> €</p>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
