<?php
include('../secret/mdp.php');
// ------ connexion à la base de données ------------------------
try
  {$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);}

catch(Exception $e)
  {die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur

$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];



$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo $target_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo $description;
        echo $stock;
        echo $price;
        echo $_FILES['fileToUpload']['name'];
        try {
        $product_update = $bdd->prepare("insert into produit values(null, :description, :image, :price, :stock)");
        $product_update->bindValue(":description", $description);
        $product_update->bindValue(":image", $_FILES['fileToUpload']['name']);
        $product_update->bindValue(":price", $price);
        $product_update->bindValue(":stock", $stock);
        $product_update->execute();}
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    } else {

        echo "Sorry, there was an error uploading your file.";
    }
}
?>
