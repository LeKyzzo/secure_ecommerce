<?php
session_start();
require_once 'includes/db.php';
include 'includes/header.php';

// Traitement du formulaire de contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);
    
    echo "Message envoyé avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact & Support</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Contact & Support</h2>
    <form action="contact_support.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" name="name" required>
        
        <label for="email">Email :</label>
        <input type="email" name="email" required>
        
        <label for="message">Message :</label>
        <textarea name="message" required></textarea>
        
        <button type="submit" name="send_message">Envoyer</button>
    </form>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
