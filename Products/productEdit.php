<?php

session_start();

require "../script.php";

$db = new Database();

// Vérification si un ID de produit est passé via GET
if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    // Récupération des détails du produit à modifier
    $sql = "SELECT * FROM medicaments WHERE id = :productId";
    $stmt = $db->pdo->prepare($sql);
    $stmt->execute(['productId' => $productId]);
    $details = $stmt->fetch();

    if (!$details) {
        die("Produit non trouvé.");
    }
} else {
    die("ID du produit non spécifié.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Médicament</title>
    <style>
        body { font-family: Arial, sans-serif; background-image: url('../imgs/background.jpeg');}
        .container { width: 50%; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background: #ffffff17;}
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
    <h2>Modifier le Médicament</h2>
    <form method="post" action="editSubmit.php">
        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($details['id']); ?>">
        <div class="form-group">
            <label>Référence:</label>
            <input type="text" name="reference" value="<?php echo htmlspecialchars($details['reference']); ?>" required>
        </div>
        <div class="form-group">
            <label>Image:</label>
            <input type="text" name="img" value="<?php echo htmlspecialchars($details['img']); ?>" required>
        </div>
        <div class="form-group">
            <label>Prix:</label>
            <input type="number" step="0.01" min="0" name="prix" value="<?php echo htmlspecialchars($details['prix']); ?>" required>
        </div>
        <div class="form-group">
            <label>Quantité:</label>
            <input type="number" step="1" min="0" name="quantite" value="<?php echo htmlspecialchars($details['quantite']); ?>" required>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" rows="4" required><?php echo htmlspecialchars($details['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label>Fabricant:</label>
            <input type="text" name="fabricant" value="<?php echo htmlspecialchars($details['fabricant']); ?>" required>
        </div>
        <div class="form-group">
            <label>Type:</label>
            <input type="text" name="type" value="<?php echo htmlspecialchars($details['type']); ?>" required>
        </div>
        <div class="form-buttons">
            <button type="submit">Enregistrer les modifications</button>
        </div>
    </form>
</div>

</body>
</html>
