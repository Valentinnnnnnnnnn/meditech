<?php
require "script.php";
$db = new Database();

try {

    $productId = $_POST['productId'];
    $reference = $_POST['reference'];
    $img = $_POST['img'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $description = $_POST['description'];
    $fabricant = $_POST['fabricant'];
    $type = $_POST['type'];



    $sql = "UPDATE medicaments
            SET reference = :reference,
                img = :img,
                prix = :prix,
                quantite = :quantite,
                description = :description,
                fabricant = :fabricant,
                type = :type,
                derniere_modification = NOW()
            WHERE id = :productId"; // TODO : edit la derniere modif



    $stmt = $db->pdo->prepare($sql);
    $stmt->execute([
        'reference' => $reference,
        'img' => $img,
        'prix' => $prix,
        'quantite' => $quantite,
        'description' => $description,
        'fabricant' => $fabricant,
        'type' => $type,
        'productId' => $productId
    ]);


    header("Location: products.php?action=update_success");
} catch (PDOException $e) {
    header("Location: products.php?action=error");
}
?>
