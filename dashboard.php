<?php

session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}
require "../script.php";
$db = new Database();

list($produits, $stock, $fabriquants, $types) = $db->getDashboardData();

?>

<!DOCTYPE html>
<link href="style.css" rel="stylesheet" />

<html>
    <body>
    <nav>
        <div class="navbar">
            <div class="nav-container">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
                <div class="menu-items">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="Products/products.php">Products</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="box1 card">
            <div class="icon">
                <img src="imgs/default.jpg">
            </div>
            <div class="info">
                <span class="count"><?php echo $produits ?></span>
                <span class="label">Produits</span>
            </div>
        </div>

        <div class="box2 card">
            <div class="icon">
                <img src="imgs/default.jpg">
            </div>
            <div class="info">
                <span class="count"><?php echo $stock ?></span>
                <span class="label">En stock</span>
            </div>
        </div>

        <div class="box3 card">
            <div class="icon">
                <img src="imgs/default.jpg">
            </div>
            <div class="info">
                <span class="count"><?php echo $fabriquants ?></span>
                <span class="label">Fabriquants</span>
            </div>
        </div>

        <div class="box4 card">
            <div class="icon">
                <img src="imgs/default.jpg">
            </div>
            <div class="info">
                <span class="count"><?php echo $types ?></span>
                <span class="label">Types</span>
            </div>
        </div>
    </div>

    <div class="events-container">
            <?php
            date_default_timezone_set('UTC'); // Set timezone if needed
            $now = new DateTime();

            function timeAgo($datetime, $now) {
                $interval = $now->diff(new DateTime($datetime));
                if ($interval->y > 0) {
                    return "Il y a " . $interval->y . " an(s)";
                } elseif ($interval->m > 0) {
                    return "Il y a " . $interval->m . " mois";
                } elseif ($interval->d > 0) {
                    return "Il y a " . $interval->d . " jour(s)";
                } elseif ($interval->h > 0) {
                    return "Il y a " . $interval->h . " heure(s)";
                } elseif ($interval->i > 0) {
                    return "Il y a " . $interval->i . " minute(s)";
                } else {
                    return "À l'instant";
                }
            }

            foreach ($db->getLastEvents(15) as $event) {
                $timeAgo = timeAgo($event["date"], $now);
                $targetText = $event["target"];

                // Choisir le bon verbe en fonction de l'action
                switch ($event["action"]) {
                    case "create":
                        $actionText = " a créé le médicament ";
                        break;
                    case "delete":
                        $actionText = " a supprimé le médicament ";
                        break;
                    case "edit":
                        $actionText = " a modifié le médicament ";
                        break;
                    case "connected":
                        $actionText = " s'est connecté";
                        $targetText = ""; // Pas besoin de cible
                        break;
                    case "disconnected":
                        $actionText = " s'est déconnecté";
                        $targetText = ""; // Pas besoin de cible
                        break;
                    case "accountCreate":
                        $actionText = " a créé son compte";
                        $targetText = ""; // Pas besoin de cible
                        break;
                    default:
                        $actionText = $event["action"]; // Utilise l'action telle quelle si non reconnue
                }

                echo '<div class="event">';
                echo '<p>' . $timeAgo . ' - ' . $event["auteur"] .  $actionText . $targetText . '</p>';
                echo '</div>';
            }
            ?>
        </div>

    
    </body>
</html>