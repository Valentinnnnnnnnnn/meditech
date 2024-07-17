

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>MÉDITECH</title>
</head>
<body>

         <!-- FORMULAIRE DE CONNEXION -->
    <div class="card">
        <h2>MÉDITECH</h2>

            <!-- SE CONNECTER / S'INSCRIRE -->
        <div class="login_register">
            <a href="../Login/login.php" class="login" target="blank">Login</a>
            <a class="register" target="blank">Signup</a>
        </div>

            <!-- FORMULAIRE -->
        <form action="signupSubmit.php" class="form" method="post">
            <input type="text" placeholder="Identifiant" name="identifiant" class="pass" required>
            <input type="password" placeholder="Mot de passe" name="mot_de_passe" class="confirm_pass" required>

            <!-- MESSAGE D'ERREUR -->
            <?php if ($_GET["userexists"]) { ?>
                <p style="color:red; margin-top: 10px;">L'identifiant existe déjà.</p>
            <?php } ?>
            <?php if ($_GET["emptyfields"]) { ?>
                <p style="color:red; margin-top: 10px;">Veuillez renseigner tous les champs.</p>
            <?php } ?>
            <?php if ($_GET["server"]) { ?>
                <p style="color:red; margin-top: 10px;">Une erreur est survenue, veuillez contacter votre administrateur.</p>
            <?php } ?>

            <!-- BOUTTON SIGNUP -->
            <button type="submit" class="login_btn">Signup</button>
        </form>
    </div>

</body>
</html>