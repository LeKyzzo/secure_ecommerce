<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="pages/products.php">Produits</a></li>
            <li><a href="pages/contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="pages/login.php">Connexion</a></li>
                <li><a href="pages/register.php">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>