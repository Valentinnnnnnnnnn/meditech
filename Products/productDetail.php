<?php
session_start ();
if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
    header("Location: ../Login/login.php");
}

require "../script.php";
$db = new Database();

if (isset($_GET['productId'])) {
    $sql = "SELECT id, reference, img, prix, quantite, description, fabricant, type FROM medicaments WHERE id = :productId";
    $stmt = $db->pdo->prepare($sql);
    $stmt->execute(['productId' => $_GET['productId']]);
    $details = $stmt->fetch();
    if (!$details) {
        die("Produit non trouvé"); // https://www.php.net/manual/fr/function.die.php
    }
} else {
    die("ID du produit incorrect");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Médicament</title>
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
            background-image: url('../imgs/background.jpeg');
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
        .details-container {
            width: 430px;
            float: right;
        }
        .details-group {
            margin-bottom: 15px;
        }
        .details-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .details-group input, .details-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .details-group textarea {
            resize: vertical;
        }
        .details-buttons {
            margin-top: 20px;
            text-align: center;
        }
        .details-buttons button {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
            background: linear-gradient(90deg, #003A74, #006AD5);
            color: #fff;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
        }
        .details-buttons button:hover {
            background-color: #fc796f;
        }
        .details-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .details-group input[type="text"]:focus,
        .details-group input[type="number"]:focus,
        .details-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        .details-group input[type="text"]::placeholder,
        .details-group textarea::placeholder {
            color: #aaa;
        }
        .details-group img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin-top: 10px;
        }
        </style>
</head>
<body>

<div class="container">
    <h2>Détails du Médicament</h2>
    <form action="productEdit.php" method="get">
        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($details['id']); ?>">
        <div class="form-group">
            <label>Référence:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['reference']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Image:</label>
            <br>
            <img src="<?php echo htmlspecialchars($details['img']); ?>" alt="Image du médicament">
        </div>
        <div class="form-group">
            <label>Prix:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['prix']); ?>€" readonly>
        </div>
        <div class="form-group">
            <label>Quantité:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['quantite']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea rows="4" readonly><?php echo htmlspecialchars($details['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label>Fabricant:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['fabricant']); ?>" readonly>
        </div>
        <div class="form-group">
            <label>Type:</label>
            <input type="text" value="<?php echo htmlspecialchars($details['type']); ?>" readonly>
        </div>
            <button type="submit">Modifier</button>
    </form>
    <form action="deleteProduct.php" method="POST">
        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($details['id']); ?>">
        <button type="submit" class="deletebutton">&#128465;</button>
    </form>
</div>

</body>
</html>
