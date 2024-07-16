<!DOCTYPE html>
<link rel="stylesheet" href="style.css"/>

<?php

    session_start ();
    if (!isset($_SESSION['email']) or !isset($_SESSION['pass'])) {
        header("Location: ../Login/login.php");
    }

    require "script.php";
    $db = new Database();
    var_dump($db);

    if (isset($_GET['action'])) { // afficher un message d'erreur/de succès lors de la redirection vers cette page
        $action = $_GET['action'];
        switch ($action) { // https://www.php.net/manual/fr/control-structures.switch.php
            case 'delete_success':
                echo '<div class="message success">Supprimé avec succès.</div>';
                break;
            case 'update_success':
                echo '<div class="message success">Modifié avec succès.</div>';
                break;
            case 'create_success':
                echo '<div class="message success">Créé avec succès.</div>';
                break;
            case 'error':
                echo '<div class="message error">Une erreur est survenue.</div>';
                break;
        }
    }

?>
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
                        <li><a href="../Dashboard/dashboard.php">Dashboard</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="../logout.php">Logout</a></li>
                    </div>
                </div>
            </div>
        </nav>
        <table class="product-table">
            <tr class="add-product-row">
                <td colspan="2" style="border-radius: 16px; text-align: center; background-color: rgba(221, 221, 221, 0.26); cursor: pointer;">
                    <p style="margin: 0; font-weight: bold;">Créer un nouveau produit</p>
                </td>
            </tr>

            <?php foreach ($db->getAllMedicaments() as $medicament) { ?>
                <tr class="product-row" data-id="<?php echo htmlspecialchars($medicament['id']); ?>">
                    <td style="border-radius: 16px 0 0 16px">
                        <div class="product-leftpart">
                            <img src="<?php echo htmlspecialchars($medicament['img']); ?>" width="70px" height="70px">
                            <div class="product-data">
                                <p class="product-name"><?php echo htmlspecialchars($medicament['reference']); ?></p>
                                <p class="product-price"><?php echo htmlspecialchars($medicament['prix']); ?>€</p>
                            </div>
                        </div>
                    </td>
                    <td style="border-radius: 0 16px 16px 0">
                        <div class="product-rightpart">
                            <div class="product-date">
                                <p>Créé le <?php echo date('d/m/Y', strtotime($medicament['creation'])); ?></p>
                                <p>Modifié le <?php echo date('d/m/Y', strtotime($medicament['derniere_modification'])); ?></p>
                            </div>
                            <div class="product-buttons">
                                <p class="product-quantity">En stock : <?php echo htmlspecialchars($medicament['quantite']); ?></p>
                                <div class="product-editbuttons">
                                    <form action="productEdit.php" method="GET">
                                        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($medicament['id']); ?>">
                                        <button type="submit" class="editbutton">&#9998;</button>
                                    </form>
                                    <form action="deleteProduct.php" method="POST">
                                        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($medicament['id']); ?>">
                                        <button type="submit" class="deletebutton">&#128465;</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </body>
    <script src="script.js"></script>
</html>