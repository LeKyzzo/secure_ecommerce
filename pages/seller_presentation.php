<?php
session_start();
require_once 'includes/db.php';
include __DIR__ . '/../includes/header.php';



// Récupération des informations du vendeur depuis la base de données
$stmt = $pdo->query("SELECT * FROM seller_info LIMIT 1");
$seller = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Présentation du Vendeur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>À propos du Vendeur</h2>
    <?php if ($seller): ?>
        <h3><?= htmlspecialchars($seller['name']) ?></h3>
        <p><?= nl2br(htmlspecialchars($seller['description'])) ?></p>
        <p>Email : <a href="mailto:<?= htmlspecialchars($seller['email']) ?>"><?= htmlspecialchars($seller['email']) ?></a></p>
    <?php else: ?>
        <p>Aucune information disponible.</p>
    <?php endif; ?>
    <?php include __DIR__ . '/../includes/footer.php';
; ?>
</body>
</html>
