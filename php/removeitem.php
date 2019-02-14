<?php
session_start();
for($i=0; $i<sizeof($_SESSION['panier']['codeproduit']); $i++) {
    $remove = "remove{$i}";
    if(isset($_POST[$remove])) {
        \array_splice($_SESSION['panier']['codeproduit'], $i, 1); 
    }
}
header("Location:../html/basket.php");
exit();
?>