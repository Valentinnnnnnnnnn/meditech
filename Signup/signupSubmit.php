<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifiez si les champs sont vides
    if (empty($identifiant) || empty($mot_de_passe)) {
        header('Location: signup.php?emptyfields=true');
        exit();
    }

    // Hash du mot de passe
    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Connexion à la base de données
    require_once('../script.php');

    try {
        $db = new Database();

        if ($db->createAccount($identifiant, $hashed_password)) {
            header('Location: ../Login/login.php?signup=true');
            exit();
        } else {
            // L'utilisateur existe déjà
            header('Location: signup.php?userexists=true');
            exit();
        }
    } catch (PDOException $e) {
        header('Location: signup.php?server=true');
    }

} else {
    // Redirection si le formulaire n'a pas été soumis via POST
    header('Location: signup.php');
    exit();
}
?>
