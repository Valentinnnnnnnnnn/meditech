<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}

require "../script.php";
$db = new Database();

try {

    $reference = $_POST['reference'];
    $img = $_POST['img'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $description = $_POST['description'];
    $fabricant = $_POST['fabricant'];
    $type = $_POST['type'];


    $db->createProduct($reference, $img, $prix, $quantite, $description, $fabricant, $type);

    header("Location: products.php?action=create_success");
} catch (PDOException $e) {

    header("Location: products.php?action=error");

}
?>
