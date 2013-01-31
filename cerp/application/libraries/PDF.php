<?php
require('rotation.php');

class PDF extends PDF_Rotate
{
function RotatedText($x,$y,$txt,$angle)
{
    //Rotation du texte autour de son origine
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}

function RotatedImage($file,$x,$y,$w,$h,$angle)
{
    //Rotation de l'image autour du coin supérieur gauche
    $this->Rotate($angle,$x,$y);
    $this->Image($file,$x,$y,$w,$h);
    $this->Rotate(0);
}
}

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->RotatedImage('circle.png',85,60,40,16,45);
$pdf->RotatedText(100,60,'Hello !',45);
$pdf->Output();
?>