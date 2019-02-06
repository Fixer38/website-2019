<?php
session_start();
include('../secret/mdp.php');
//------- recupération des valeurs du formulaire--------------
$email=$_POST['email'];
$pswd=$_POST['pswd'];
// ------ connexion à la base de données ------------------------
try
	{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
	{die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur

// Requête reprenant les informations nécessaires
$req = $bdd->prepare("select id, email, mdp, nom, prenom, nb_connection from client where email like :email");
$req->bindValue(":email", $email, PDO::PARAM_STR);
$req->execute();
$req = $req->fetch();

// Si l'utilisateur n'a pas de connections restantes valides
if($req['nb_connection'] <= 0) {
	// Redirection vers page pour utilisateur restreint
	header("Location:../html/restricted.php");
	exit();
}

else {
	// Check si l'addresse mail correspond avec le mot de passe entré que l'on vérifie en bcrypt
	if($req['email'] === $email && password_verify($pswd, $req['mdp'])) {
		// Variable de session signifiant si l'utilisateur est connecté ou non
		// Requête changant la dernière date de connection de l'utilisateur
		$lastconnection_updater = $bdd->prepare("update client set last_connection = :last_connection where email like :email");
		$lastconnection_updater -> bindValue(":last_connection", $last_connection, PDO::PARAM_STR);
		$lastconnection_updater -> bindValue(":email", $email, PDO::PARAM_STR);
		$lastconnection_updater-> execute();
		// Requête réinitialisant le nombre de connections valables à 3
		$nb_connection_updater = $bdd->prepare("update client set nb_connection = 3 where email like :email");
		$nb_connection_updater -> bindValue(":email", $email, PDO::PARAM_STR);
		$nb_connection_updater -> execute();

		$_SESSION['logged'] = True;
		$_SESSION['name'] = $req['nom'];
		$_SESSION['fname'] = $req['prenom'];
		$_SESSION['idclient'] = $req['id'];
		$_SESSION['panier'] = array();
		$_SESSION['panier']['codeproduit'] = array();
		$_SESSION['panier']['quantite'] = array();

		// Retour à la page d'accueil
		header("Location:../index.php");

		exit();

	}

	// Si le mot de passe ne correspond pas avec l'addresse email entré
	elseif($req['email'] === $email && !password_verify($pswd, $req['mdp'])) {
		// Décrémentation du nombre de connection valide à l'utilisateur
		$nbconnection_updater = $bdd->prepare("update client set nb_connection = nb_connection - 1 where email like :email");
		$nbconnection_updater->bindValue(":email", $email, PDO::PARAM_STR);
		$nbconnection_updater->execute(); 	
		// Message d'erreur qui sera affiché sur la page html
		$_SESSION["error"] = "La combinaison de l'addresse email ne correspond pas avec le mot de passe";
		header("Location:../index.php");
	}}
$bdd->closeCursor();
?>
