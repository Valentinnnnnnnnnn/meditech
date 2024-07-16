<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}
?>

<!DOCTYPE html>
<link href="style.css" rel="stylesheet" />

<html>
    <body>
    <nav>
        <div class="navbar">
            <div class="container nav-container">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
                <div class="menu-items">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="../Products/products.php">Products</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="box1"></div>
        <div class="box2"></div>
        <div class="box3"></div>
        <div class="box4"></div>
        <div class="box5"></div>
    </div>
    
    </body>
</html>