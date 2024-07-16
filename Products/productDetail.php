<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}

require "../script.php";
$db = new Database();

if (isset($_GET['productId'])) {
    $sql = "SELECT id, reference, img, prix, quantite, description, fabricant, type FROM medicaments WHERE id = :productId";
    $stmt = $db->pdo->prepare($sql);
    $stmt->execute(['productId' => $_GET['productId']]);
    $details = $stmt->fetch();
    if (!$details) {
        die("Produit non trouvé"); // https://www.php.net/manual/fr/function.die.php
    }
} else {
    die("ID du produit incorrect");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Médicament</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: rgba(255, 255, 255, 0) }
        .container { width: 50%; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: rgba(255, 255, 255) }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; }
        .form-group input, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .form-group textarea { resize: vertical; }
        .form-buttons button { padding: 10px 20px; margin-right: 10px; cursor: pointer; }
        img { max-width: 100px; max-height: 100px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Détails du Médicament</h2>
    <form action="productEdit.php" method="get">
        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($details['id']); ?>">
        <div class="form-group">
            <label>Référence:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['reference']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Image:</label>
            <br>
            <img src="<?php echo htmlspecialchars($details['img']); ?>" alt="Image du médicament">
        </div>
        <div class="form-group">
            <label>Prix:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['prix']); ?>€" readonly>
        </div>
        <div class="form-group">
            <label>Quantité:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['quantite']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea rows="4" readonly><?php echo htmlspecialchars($details['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label>Fabricant:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['fabricant']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Type:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['type']); ?>" readonly>
        </div>
            <button type="submit">Modifier</button>
    </form>
    <form action="deleteProduct.php" method="POST">
        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($details['id']); ?>">
        <button type="submit" class="deletebutton">&#128465;</button>
    </form>
</div>

</body>
</html>
