<?php
session_start();
include('../secret/mdp.php');
//------- recupération des valeurs du formulaire--------------
$email=$_POST['email'];
$pswd=$_POST['pswd'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$rue=$_POST['rue'];
$cp=$_POST['cp'];
$num_maison=$_POST['num_maison'];
$tel=$_POST['tel'];

// ------ importation des variables de connexion ----------------

// ------ connexion à la base de données ------------------------
try
	{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
	{die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur


$check_if_exists = $bdd->prepare("select count(id) from client where email like :email");
$check_if_exists -> bindValue(":email", $email, PDO::PARAM_STR);
$check_if_exists -> execute();
$check_if_exists = $check_if_exists -> Fetch();
if($check_if_exists[0] > 0) {
	// Message d'erreur qui sera affiché sur la page html
	$_SESSION["error"] = "Cette addresse email est déjà utilisée"; 
	// Redirection vers la page d'inscription en affichant le message d'erreur
	header("Location:../html/registration.php");
}
else {
	// On change le coût de l'algorithme a 12 au lieu de 10(par défaut)
	$options = [
		'cost' => 12,
	];
	// Hashing du mot de passe
	// L'algorithme bcrypt génère un salt aléatoire automatiquement pour chaque mot de passe crypté 
	$pswd = password_hash($pswd, PASSWORD_BCRYPT, $options);

	// Insertion des informations données par l'utilisateur dans la base de données
	$req = $bdd->prepare("insert into client VALUES(null, :email, :pswd, :nom, :prenom, :rue, :cp, :num_maison, :tel, null, 3)");
	$req -> bindValue(":email", $email, PDO::PARAM_STR);
	$req -> bindValue(":pswd", $pswd, PDO::PARAM_STR);
	$req -> bindValue(":nom", $nom, PDO::PARAM_STR);
	$req -> bindValue(":prenom", $prenom, PDO::PARAM_STR);
	$req -> bindValue(":rue", $rue, PDO::PARAM_STR);
	$req -> bindValue(":cp", $cp, PDO::PARAM_STR);
	$req -> bindValue(":num_maison", $num_maison, PDO::PARAM_STR);
	$req -> bindValue(":tel", $tel, PDO::PARAM_STR);


	// ------ exécution de la requete -------------------------------
	$req->execute();
	// Redirection vers la page d'accueil
	header("Location:../index.php");
}
$bdd->closeCursor();
?>
