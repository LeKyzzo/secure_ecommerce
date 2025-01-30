<?php
session_start();
require_once 'includes/db.php';
include 'includes/header.php';

// Vérifier si l'utilisateur est un administrateur (à sécuriser selon votre logique utilisateur)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ajouter un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = floatval($_POST['price']);
    
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $price]);
}

// Récupérer tous les produits
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Gestion des Produits</h2>
    <form action="admin_products.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" name="name" required>
        
        <label for="description">Description :</label>
        <textarea name="description" required></textarea>
        
        <label for="price">Prix :</label>
        <input type="number" step="0.01" name="price" required>
        
        <button type="submit" name="add_product">Ajouter Produit</button>
    </form>
    
    <h3>Liste des Produits</h3>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p>Prix : <?= number_format($product['price'], 2) ?> €</p>
            </div>
        <?php endforeach; ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>