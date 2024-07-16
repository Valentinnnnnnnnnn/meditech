<?php
session_start();

if (isset($_GET['email']) && isset($_GET['pass'])) {
    // Récupérez les identifiants saisis
    $email = $_GET['email'];
    $pass = $_GET['pass'];

    // Connexion à la base de données
    require_once('../script.php'); // Inclusion du script de connexion à la base de données

    $db = new Database();

    // Requête pour vérifier les identifiants dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE identifiant = :email LIMIT 1";
    $stmt = $db->pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pass, $user['mot_de_passe'])) {
        // Authentification réussie
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $pass;

        header('Location: ../Dashboard/dashboard.php');
        exit();
    } else {
        // Identifiants invalides
        header('Location: login.php?error=true');
        exit();
    }
} else {
    // Paramètres manquants
    header('Location: login.php?error=true');
    exit();
}
?>
