<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/registration.css">    
    <link rel="stylesheet" type="text/css" href="../css/login-modal.css">    
    <title>Login</title>
  </head>

<body>
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <div class="form-style">
        <form action="../php/login.php" method="post">
        <div id="legend">Connection</div>
          <fieldset>
            <span class="close">&times;</span>
              <label for="email">Email</label>
              <input type="email" placeholder="Entrez votre email" name="email" maxlenght="64" required>
              <label for="pswd">Mot de passe</label>
              <input type="password" placeholder="Entrez votre mot de passe" name="pswd" maxlenght="64" required>
              <button type="submit" value="Connecter">Se connecter</button>
          </fieldset>
        </div>
      </div>
    </div>
  </div>


<!-- Javascript utilisé pour le popup login -->    
<script>
  var modal = document.getElementById('loginModal');
  // Get the button that opens the modal
var btn = document.getElementById("login-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
  </body>
</html>
