<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    $this->Image('logo_chev.jpg',10,6,35,53);
    // Police Arial gras 15
    $this->SetFont('Arial','I',14);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(130,10,'Angers, Le Mardi 9 Janvier 2018',0,0,'C');

   $this->SetFont('Arial','B',24);
    // Saut de ligne
    $this->Ln(20);
     $this->Cell(0,0,'Convocation',0,0,'C');

    $this->Ln(9);
     $this->SetFont('Arial','B',16);
      $this->Cell(0,0,utf8_decode('Examen en cours d\'année'),0,0,'C');


    $this->Ln(15);
     $this->SetFont('Arial','B',18);
      $this->Cell(0,0,utf8_decode('Baccalauréat technologique'),0,0,'C');
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->Output();
?>
