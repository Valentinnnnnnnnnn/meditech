<?php

$email_valide = "admin";
$pass_valide = "admin";

if (isset($_GET['email']) && isset($_GET['pass'])) {

    if ($email_valide == $_GET['email'] && $pass_valide == $_GET['pass']) {

        session_start ();

        $_SESSION['email'] = $_GET['email'];
        $_SESSION['pass'] = $_GET['pass'];

        header ('location: ../Dashboard/dashboard.php');
    } else {
        header("Location: login.php?error=true");
    }
} else {
    header("Location: login.php?error=true");
}
