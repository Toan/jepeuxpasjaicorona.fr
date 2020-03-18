<?php
include 'fpdf/fpdf.php';
//error_reporting(1);
//ini_set('display_errors', 1);
$gender = $_POST['gender'];

$name = $_POST['name'];
$birthday = $_POST['birthday'];
$address = $_POST['address'];
$type = $_POST['type'];
$pic = $_POST['signimg'];
$attdate = $_POST['attdate'];

$info = getimagesize($pic);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->MultiCell(0,10,utf8_decode('ATTESTATION DE DÉPLACEMENT DÉROGATOIRE'),0,'C');
$pdf->SetFont("Arial","",10);
$pdf->MultiCell(0,5,utf8_decode('En application de l\'article 1er du décret du 16 mars 2020 portant réglementation des
déplacements dans le cadre de la lutte contre la propagation du virus Covid-19 :'),0,'C');
$pdf->SetFont("Arial","",12);
//$pdf->SetY(60);
$pdf->Ln(60);
if($gender ==1) {
    $text = 'Je soussignée Mme. '.$name.' née le '.$birthday.' ';
} else
    $text = 'Je soussigné M. '.$name.' né le '.$birthday.' ';
$text .= 'et demeurant '.$address.'.';
$pdf->MultiCell(0,5,utf8_decode($text),0,'L');
$pdf->Ln(10);
$pdf->MultiCell(0,5,utf8_decode('certifie que mon déplacement est lié au motif suivant autorisé par l\'article 1er du décret du 16 mars 2020 portant réglementation des déplacements dans le cadre de la lutte contre la propagation du virus Covid-19 :'),0,'L');
$pdf->Ln(10);
if($type=='pro') {
$pdf->MultiCell(0,5,utf8_decode('déplacements entre le domicile et le lieu d\'exercice de l\'activité professionnelle, lorsqu\'ils sont indispensables à l\'exercice d\'activités ne pouvant être organisées sous forme de télétravail (sur justificatif permanent) ou déplacements professionnels ne pouvant être différés.'),0,'L');
} elseif($type=='miam') {
    $pdf->MultiCell(0,5,utf8_decode('déplacements pour effectuer des achats de première nécessité dans des établissements autorisés (liste sur gouvernement.fr).'),0,'L');
} elseif($type=='argh') {
    $pdf->MultiCell(0,5,utf8_decode('déplacements pour motif de santé ;'),0,'L');
} elseif($type=='famille') {
    $pdf->MultiCell(0,5,utf8_decode('déplacements pour motif familial impérieux, pour l’assistance aux personnes vulnérables ou la garde d’enfants.'),0,'L');
} elseif($type=='footing!') {
    $pdf->MultiCell(0,5,utf8_decode('déplacements brefs, à proximité du domicile, liés à l\'activité physique individuelle des personnes, à l\'exclusion de toute pratique sportive collective, et aux besoins des animaux de compagnie.'),0,'L');
}
$pdf->Ln(25);
$pdf->MultiCell(0,5,utf8_decode('Fait le '. $attdate),0,'R');

$pdf->Image($pic, 160, null, 50, 37.5, 'png');
$pdf->Output('I', 'corona_attestation.pdf');