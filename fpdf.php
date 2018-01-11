<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// En-tête
function Header()
{
$oui="Adrien";
    // Police Arial gras 15
    $this->SetFont('Arial','',20);
    // Logo
    $this->Image('logo_chev.jpg',10,6,30);
    // Décalage à droite
    $this->Cell(90);
    // Titre
    $this->Cell(30,10,utf8_decode('Baccalauréat technologique 2018'),0,0,'C');
    // Saut de ligne
    $this->Ln(15);

    // Police Arial gras 15
    $this->SetFont('Arial','B',25);
$this->Cell(20);
    $this->Cell(0,10,utf8_decode('Liste d\'émargement'),0,0, 'C');
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
