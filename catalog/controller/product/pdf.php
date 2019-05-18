<?php

 include_once('fpdf/fpdf.php');
 

 $pdf = new FPDF();
$pdf->Write(0, $text);
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'test!');
$pdf->Output();


?>

