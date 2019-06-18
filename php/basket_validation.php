<?php
session_start();
include('../secret/mdp.php');
try
	{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
    {die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur
$insert_in_commande = $bdd->prepare('insert into commande values(null, :date, :ref_cli)');
$insert_in_commande->bindValue(':date', date("Y/m/d"), PDO::PARAM_STR);
$insert_in_commande->bindValue(':ref_cli', $_SESSION['idclient'], PDO::PARAM_INT);
$insert_in_commande->execute();
$ref_commande = $bdd->prepare('select MAX(idcommande) from commande');
$ref_commande->execute();
$ref_commande = $ref_commande->fetch();
$_SESSION['ref_commande'] = $ref_commande;
echo $ref_commande[0];
for($i=0; $i<sizeof($_SESSION['panier']['codeproduit']); $i++) {
    echo "ok";
    $into_ligne_com = $bdd->prepare("insert into lignescom values(null, :ref_commande, :ref_produit, :quant)");
    $into_ligne_com->bindValue(":ref_commande", $ref_commande[0], PDO::PARAM_INT);
    $into_ligne_com->bindValue(":ref_produit", $_SESSION['panier']['codeproduit'][$i], PDO::PARAM_INT);
    $into_ligne_com->bindValue(":quant", $_SESSION['panier']['quantite'][$i], PDO::PARAM_INT);
    $into_ligne_com->execute();
    
    $reduce_stock = $bdd->prepare("update produit set stock = stock - :quant where idproduit like :ref_produit");
    $reduce_stock->bindValue(":quant", $_SESSION['panier']['quantite'][$i], PDO::PARAM_INT);
    $reduce_stock->bindValue(":ref_produit", $_SESSION['panier']['codeproduit'][$i], PDO::PARAM_INT);
    $reduce_stock->execute();
}
unset($_SESSION['panier']);
header("Location:./save_pdf.php");
?>