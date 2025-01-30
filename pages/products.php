<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
include 'includes/header.php';



// Récupération des produits depuis la base de données
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Nos Produits</h2>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p>Prix : <?= number_format($product['price'], 2) ?> €</p>
            </div>
        <?php endforeach; ?>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>