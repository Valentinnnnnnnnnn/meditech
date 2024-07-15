<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}
require "script.php";
$db = new Database();

$sql = "DELETE FROM medicaments WHERE id = :productId";
$stmt = $db->pdo->prepare($sql);
$stmt->execute(['productId' => $_POST['productId']]);
header("Location: products.php?action=delete_success");