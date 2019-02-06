<?php
session_start();
unset($_SESSION['logged']);
unset($_SESSION['panier']);
header("Location:../index.php");
?>