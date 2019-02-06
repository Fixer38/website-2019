<?php 
session_start();
?>
<!-- Barre de naviguation -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav navbar-center">
        <a class="navbar-brand" href="#">RGraphy</a>
      </ul>
      </div>
      <ul class="nav navbar-nav">
        <!-- changement des chemins vers les différentes pages si l'on click sur la navbar depuis l'index ou non -->
        <?php if ($_SERVER['REQUEST_URI'] === '/tfe/' || $_SERVER['REQUEST_URI'] === '/tfe/index.php') {
            echo "<li><a href='./index.php'>Home</a></li>
            <li><a href='./html/produits.php'>Produits</a></li>
            <li><a href='./html/contact.php'>Contact</a></li>
          </ul>
          <ul class='nav navbar-nav navbar-right'>";
            if ($_SESSION['logged'] === True) {
                echo "<li><a href='./html/profile.php'><span class='glyphicon glyphicon-user'></span> ".ucfirst($_SESSION['fname'])."</a></li>";
                echo "<li><a href='./html/basket.php'><span class='glyphicon glyphicon-shopping-cart'></span></li>";
                echo "<li><a href='./php/logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
            }
            else {
            echo "<li><a href='./html/registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
            <li><a id='login-btn'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
            }
        }
        else {
            echo "<li><a href='../index.php'>Home</a></li>
            <li><a href='./produits.php'>Produits</a></li>
            <li><a href='./contact.php'>Contact</a></li>
          </ul>
          <ul class='nav navbar-nav navbar-right'>";
          if ($_SESSION['logged'] === True) {
            echo "<li><a href='./profile.php'><span class='glyphicon glyphicon-user'></span>".ucfirst($_SESSION['fname'])."</a></li>";
            echo "<li><a href='./basket.php'><span class='glyphicon glyphicon-shopping-cart'></span></li>";
            echo "<li><a href='../php/logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
          }
          else {
            echo "<li><a href='./registration.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
            <li><a id='login-btn'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
          }
        } ?>
        
      </ul>
    </div>  
  </nav>