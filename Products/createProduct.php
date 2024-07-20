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
    <link rel="stylesheet" href="styles/createProduct.css">
</head>
<body>

<div class="shop-bg"></div>
<div class="pop-up clearfix">
    <div class="pics">
        <span class="main-img"><img src="../imgs/default.jpg"></span>
    </div>
    <div class="container">
        <h2>Ajouter un médicament</h2>
        <form method="post" action="createSubmit.php">
            <div class="form-group">
                <label>Référence:</label>
                <input type="text" name="reference" required placeholder="Entrez la référence">
            </div>
            <div class="form-group">
                <label>Image:</label>
                <input type="text" name="img" value="../imgs/default.jpg" required placeholder="URL de l'image">
            </div>
            <div class="form-group">
                <label>Prix:</label>
                <input type="number" min="0" step="0.01" name="prix" required placeholder="Entrez le prix">
            </div>
            <div class="form-group">
                <label>Quantité:</label>
                <input type="number" min="0" step="1" name="quantite" required placeholder="Entrez la quantité">
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" rows="4" required placeholder="Entrez la description"></textarea>
            </div>
            <div class="form-group">
                <label>Fabricant:</label>
                <input type="text" name="fabricant" required placeholder="Entrez le nom du fabricant">
            </div>
            <div class="form-group">
                <label>Type:</label>
                <input type="text" name="type" required placeholder="Entrez le type de médicament">
            </div>
            <div class="form-buttons">
                <button type="submit">Ajouter</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

