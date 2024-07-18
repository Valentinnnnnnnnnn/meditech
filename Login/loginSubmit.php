<?php
session_start();

if (isset($_GET['email']) && isset($_GET['pass'])) {
    // Récupérez les identifiants saisis
    $email = $_GET['email'];
    $pass = $_GET['pass'];

    require_once('../script.php'); // Inclusion du script de connexion à la base de données

    try {
        $db = new Database();

        if ($db->login($email, $pass)) { // Connexion de l'utilisateur
            header('Location: ../index.php');
            exit();
        } else {
            // Identifiants invalides
            header('Location: login.php?error=true');
            exit();
        }
    } catch(PDOException $e) {
        header('Location: login.php?error=true');
    }

} else {
    // Paramètres manquants
    header('Location: login.php?error=true');
    exit();
}
?>
