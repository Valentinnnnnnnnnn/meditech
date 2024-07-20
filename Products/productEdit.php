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
    <link rel="stylesheet" href="styles/productEdit.css">
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
        <div class="form-buttons-det">
            <button type="submit">Enregistrer les modifications</button>
        </div>
    </form>
</div>

</body>
</html>
