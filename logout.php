<?php
session_start ();

require "script.php";
$db = new Database();

if (isset($_SESSION['email']) or isset($_SESSION['pass'])) {
    $db->logout();
    header ('location: Login/login.php');
}
?>