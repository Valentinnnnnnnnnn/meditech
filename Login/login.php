<!DOCTYPE html>

<html>
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
              <a class="login" target="blank">Login</a>
              <a href="../Signup/signup.php">Signup</a>
          </div>

          <!-- FORMULAIRE -->
          <form action="loginSubmit.php" class="form" method="get">
              <input type="text" name="email" placeholder="Identifiant" class="email">
              <input type="password" name="pass" placeholder="Mot de passe" class="pass">

              <!-- MESSAGE D'ERREUR -->
              <?php if ($_GET["error"]) { ?>
                  <p style="color:red; margin-top: 10px;">Identifiant ou mot de passe incorrect.</p>
              <?php } ?>
              <?php if ($_GET["signup"]) { ?>
                  <p style="color:green; margin-top: 10px;">Compte créé avec succès.</p>
              <?php } ?>

              <!-- BOUTTON LOGIN -->
              <button type="submit" class="login_btn">Login</button>
          </form>
      </div>
  </body>
  </html>
