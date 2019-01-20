<?php session_start();?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/registration.css">
    <link rel="stylesheet" type="text/css" href="../css/login-modal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>
  <body>
  <!-- Barre de naviguation -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav navbar-center">
        <a class="navbar-brand" href="#">RGraphy</a>
      </ul>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="../index.php">Home</a></li>
        <li><a href="./produits.php">Produits</a></li>
        <li><a href="./contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a id="login-btn"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>  
  </nav>


<!-- Formulaire Inscription -->
  <div class="form-style">
    <form action="../php/registration.php" method="post">
      <fieldset>  
        <div id="legend"> Inscription </div>
            <label for="email">Email</label>
            <?php echo $_SESSION["error"]; ?>  
            <input type="email" placeholder="Entrez votre email" name="email" maxlenght="64" required>

            <label for="pswd">Mot de passe</label>
            <input type="password" placeholder="Entrez votre mot de passe" name="pswd" maxlenght="64" required>
            
            <label for="nom">Nom</label>
            <input type="text" placeholder="Entrez votre nom" name="nom" maxlenght="20" required>
            
            <label for="prenom">Prenom</label>
            <input type="text" placeholder="Entrez votre prénom" name="prenom" maxlenght="20" required>
            
            <label for="rue">Rue</label>
            <input type="text" placeholder="Entrez votre rue" name="rue" maxlenght="40" required>
            
            <label for="cp">Code postal</label>
            <input type="text" placeholder="Entrez votre code postal" name="cp" maxlenght="4" required>
            
            <label for="num_maison">Numéro de maison</label>
            <input type="text" placeholder="Entrez votre numéro de maison" name="num_maison" maxlenght="3" required>
            
            <label for="tel">Téléphone</label>
            <input type="text" placeholder="Entrez votre numéro de téléphone" name="tel" maxlenght="20" required>
            
            <input type="submit" value="S'inscrire"/>
      </fieldset>
    </form>
  </div>
  <?php include('./login.php');?>


  </body>
</html>
  