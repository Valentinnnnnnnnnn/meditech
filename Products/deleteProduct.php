<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}
require "../script.php";

try {
    $db = new Database();
    $productId = $_POST['productId'];
    $db->deleteProduct($productId);
    header("Location: products.php?action=delete_success");
} catch (PDOException $e) {
    header("Location: products.php?action=error");
}

