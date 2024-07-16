<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}
require "../script.php";
$db = new Database();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un médicament</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: rgba(255, 255, 255, 0)}
        .container { width: 50%; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: rgba(255, 255, 255)}
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; }
        .form-group input, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .form-group textarea { resize: vertical; }
        .form-buttons { margin-top: 20px; }
        .form-buttons button { padding: 10px 20px; margin-right: 10px; cursor: pointer; }
        img { max-width: 100px; max-height: 100px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Ajouter un médicament</h2>
    <form method="post" action="createSubmit.php">
        <div class="form-group">
            <label>Référence:</label>
            <input type="text" name="reference" required>
        </div>
        <div class="form-group">
            <label>Image:</label>
            <input type="text" name="img" value="../imgs/default.jpg" required>
        </div>
        <div class="form-group">
            <label>Prix:</label>
            <input type="number" min="0" step="0.01" name="prix" required>
        </div>
        <div class="form-group">
            <label>Quantité:</label>
            <input type="number" min="0" step="1" name="quantite" required>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Fabricant:</label>
            <input type="text" name="fabricant" required>
        </div>
        <div class="form-group">
            <label>Type:</label>
            <input type="text" name="type" required>
        </div>
        <div class="form-buttons">
            <button type="submit">Ajouter</button>
        </div>
    </form>
</div>

</body>
</html>
