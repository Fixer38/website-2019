<?php
session_start();
for($i=0; $i<sizeof($_SESSION['panier']['codeproduit']); $i++) {
    $add = "add{$i}";
    $minus = "minus{$i}";
    if(isset($_POST[$add])) {
        if($_SESSION['panier']['quantite'][$i] < $_SESSION['stocks'][$i]) {
            $_SESSION['panier']['quantite'][$i]++;
        }
    }
    elseif(isset($_POST[$minus])) {
        if($_SESSION['panier']['quantite'][$i] > 1) {
            $_SESSION['panier']['quantite'][$i]--;
        }
    }
}
header("Location:../html/basket.php");
exit();
?>