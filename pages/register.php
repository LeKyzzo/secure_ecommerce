<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    // Vérifier si l'email existe déjà
    $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->execute([$email]);
    
    if ($checkStmt->fetch()) {
        echo "Erreur : Cet email est déjà utilisé.";
    } else {
        // Insérer le nouvel utilisateur
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        
        // Redirection vers la page de connexion
        header("Location: /efrei/secure_ecommerce/pages/login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h2>Inscription</h2>
    <form action="register.php" method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" required>
        
        <label for="email">Email :</label>
        <input type="email" name="email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
        
        <button type="submit" name="register">S'inscrire</button>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>
