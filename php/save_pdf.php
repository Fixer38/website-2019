<?php
session_start();
include('../secret/mdp.php');

try
{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
{die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur
include_once('./fpdf/fpdf.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pdf = new FPDF();
$pdf->AddPage();
$ref_commande = $bdd->prepare("select max(ref_commande) from lignescom");
$ref_commande->execute();
$ref_commande = $ref_commande->fetch();
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(30, 5);
$pdf->Cell(30, 10, 'Commande numero '.$ref_commande[0]);
$check_commande = $bdd->prepare("select ref_produit, quant from lignescom where ref_commande like :ref_commande");
$check_commande->bindValue(':ref_commande', $ref_commande[0], PDO::PARAM_INT);
$check_commande->execute();
$check_commande = $check_commande->fetchAll();
$pdf->SetXY(180, 5);
$pdf->Cell(40, 10, date("d/m/Y"), 'C');
$pdf->SetFont('Arial', 'B',16);
$pdf->SetXY(67, 15);
$pdf->Cell(40, 10, 'Commande pour '.$_SESSION['fname']." ".$_SESSION['name'], 'C');
$pdf->SetFontSize(12);
$pdf->SetXY(40, 30);
$pdf->Cell(80, 10, $_SESSION['street']." ".$_SESSION['hnumber']." ".$_SESSION['cp']." ".$_SESSION['localite']);
$pdf->SetXY(40, 40);
$pdf->Cell(20, 10, "ID", 'C');
$pdf->SetXY(60, 40);
$pdf->Cell(50, 10, "Description", 'C');
$pdf->SetXY(110, 40);
$pdf->Cell(40, 10, "Quantité", 'C');
$pdf->SetXY(150, 40);
$pdf->Cell(20, 10, "Prix", 'C');

$y = 50;
$total_price = 0;
foreach($check_commande as $row) {
    $pdf->SetXY(40, $y);
    $pdf->Cell(20, 10, $row['ref_produit'], 'C');
    $pdf->SetXY(60, $y);
    $pdf->Cell(50, 10, $_SESSION['descriptions'][$row['ref_produit']-1], 'C');
    $pdf->SetXY(110, $y);
    $pdf->Cell(40, 10, $row['quant'], 'C');
    $pdf->SetXY(150, $y);
    $total = $row['quant']*$_SESSION['prices'][$row['ref_produit']-1];
    $pdf->Cell(20, 10, $total, 'C');
    $y = $y + 10;
    $total_price = $total_price + $total;
}
$pdf->SetXY(110, $y);
$pdf->Cell(40, 10, "Prix hors TVA", 'R');
$pdf->SetXY(150, $y);
$pdf->Cell(20, 10, number_format($total_price/1.21, 2), 'C');
$pdf->SetXY(110, $y+10);
$pdf->Cell(40, 10, "Prix TVAC", 'R');
$pdf->SetXY(150, $y+10);
$pdf->Cell(20, 10, $total_price, 'C');
$client_number = $bdd->prepare('select ref_cli from commande where idcommande like :ref_commande');
$client_number->bindValue(':ref_commande', $ref_commande[0]);
$client_number->execute();
$client_number = $client_number->fetch();
$pdf_name = $ref_commande[0].'_'.$client_number[0].'.pdf';
$pdf->Output('./pdfs/'.$pdf_name, 'F');
header('Location:./new_pdf.php')
?>