<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifiez si les champs sont vides
    if (empty($identifiant) || empty($mot_de_passe)) {
        header('Location: signup.php?error=emptyfields');
        exit();
    }

    // Hash du mot de passe
    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Connexion à la base de données
    require_once('../script.php');
    $db = new Database();

    // Vérification si l'utilisateur existe déjà
    $sql = "SELECT * FROM utilisateurs WHERE identifiant = :identifiant";
    $stmt = $db->pdo->prepare($sql);
    $stmt->bindParam(':identifiant', $identifiant);
    $stmt->execute();

    if ($stmt->fetch()) {
        // L'utilisateur existe déjà
        header('Location: signup.php?error=userexists');
        exit();
    }

    // Insérer l'utilisateur dans la base de données
    $sql_insert = "INSERT INTO utilisateurs (identifiant, mot_de_passe) VALUES (:identifiant, :mot_de_passe)";
    $stmt_insert = $db->pdo->prepare($sql_insert);
    $stmt_insert->bindParam(':identifiant', $identifiant);
    $stmt_insert->bindParam(':mot_de_passe', $hashed_password);
    $stmt_insert->execute();

    // Redirection vers la page de connexion après l'inscription réussie
    header('Location: ../Login/login.php?signup=success');
    exit();
} else {
    // Redirection si le formulaire n'a pas été soumis via POST
    header('Location: signup.php');
    exit();
}
?>
