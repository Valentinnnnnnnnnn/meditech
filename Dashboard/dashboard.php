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
            <div class="nav-container">
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
        <div class="box1 card">
            <div class="icon">
                <img src="../imgs/default.jpg">
            </div>
            <div class="info">
                <span class="count">520</span>
                <span class="label">Produits</span>
            </div>
        </div>

        <div class="box2 card">
            <div class="icon">
                <img src="../imgs/default.jpg">
            </div>
            <div class="info">
                <span class="count">520</span>
                <span class="label">En stock</span>
            </div>
        </div>

        <div class="box3 card">
            <div class="icon">
                <img src="../imgs/default.jpg">
            </div>
            <div class="info">
                <span class="count">520</span>
                <span class="label">Fabriquants</span>
            </div>
        </div>

        <div class="box4 card">
            <div class="icon">
                <img src="../imgs/default.jpg">
            </div>
            <div class="info">
                <span class="count">520</span>
                <span class="label">Types</span>
            </div>
        </div>



    
    </body>
</html>