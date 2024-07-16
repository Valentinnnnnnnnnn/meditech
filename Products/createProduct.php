<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}
require "../script.php";
$db = new Database();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un médicament</title>
    <style>
        * {
            margin: 0;
            border: 0;
            padding: 0;
            outline: 0;
        }
        body, html {
            width: 100%;
            height: 100%;
        }
        body {
            background: url('http://www.designkorner.com/dk-administrator/prod_images/Ecommerce-web-design5.jpg') no-repeat;
            background-size: cover;
            font-family: 'Droid Sans', sans-serif;
        }
        .clearfix {
            content: "";
            display: table;
        }
        .shop-bg {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: #222;
            opacity: .8;
        }
        .pop-up {
            width: 900px;
            height: auto;
            margin-left: auto;
            margin-right: auto;
            margin-top: 80px;
            position: relative;
            background: #fff;
            padding: 30px;
            border-radius: 2px;
        }
        .container {
            width: 430px;
            float: right;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-buttons {
            margin-top: 20px;
            text-align: center;
        }
        .form-buttons button {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
            background-color: #fd7064;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
        }
        .form-buttons button:hover {
            background-color: #fc796f;
        }
        .container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        .form-group input[type="text"]::placeholder,
        .form-group textarea::placeholder {
            color: #aaa;
        }
        .form-group img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin-top: 10px;
        }
        .pics {
            float: left;
            width: 460px;
            margin-right: 0px;
        }
        .pics span {
            display: block;
        }
        .main-img img {
            display: block;
            border: .5px solid #ddd;
            border-radius: 2px;
            padding: 60px 30px;
            width: 390px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .additional-img img {
            float: left;
            width: 98px;
            height: 45px;
            padding: 10px 5px;
            border: .5px solid #ddd;
            border-radius: 2px;
            margin-right: 5px;
            cursor: pointer;
        }
        .additional-img img:nth-child(4) {
            margin-right: 0;
        }
        .main-img img:hover,
        .additional-img img:hover {
            box-shadow: 0 0 6px #ddd;
        }
    </style>
</head>
<body>

<div class="shop-bg"></div>
<div class="pop-up clearfix">
    <div class="pics">
        <span class="main-img"><img src="../imgs/default.jpg"></span>
    </div>
    <div class="container">
        <h2>Ajouter un médicament</h2>
        <form method="post" action="createSubmit.php">
            <div class="form-group">
                <label>Référence:</label>
                <input type="text" name="reference" required placeholder="Entrez la référence">
            </div>
            <div class="form-group">
                <label>Image:</label>
                <input type="text" name="img" value="../imgs/default.jpg" required placeholder="URL de l'image">
            </div>
            <div class="form-group">
                <label>Prix:</label>
                <input type="number" min="0" step="0.01" name="prix" required placeholder="Entrez le prix">
            </div>
            <div class="form-group">
                <label>Quantité:</label>
                <input type="number" min="0" step="1" name="quantite" required placeholder="Entrez la quantité">
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" rows="4" required placeholder="Entrez la description"></textarea>
            </div>
            <div class="form-group">
                <label>Fabricant:</label>
                <input type="text" name="fabricant" required placeholder="Entrez le nom du fabricant">
            </div>
            <div class="form-group">
                <label>Type:</label>
                <input type="text" name="type" required placeholder="Entrez le type de médicament">
            </div>
            <div class="form-buttons">
                <button type="submit">Ajouter</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

