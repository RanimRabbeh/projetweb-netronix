<?php
require_once '../../../Controller/ReclamationController.php';
require_once '../../libs/fpdf.php'; // Inclure la bibliothèque FPDF

// Instancier le contrôleur
$controller = new ReclamationController();
$reclamations = $controller->getAllReclamations(); // Récupérer les données des réclamations

// Initialiser le PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Titre
$pdf->Cell(0, 10, 'Liste des Reclamations', 0, 1, 'C');
$pdf->Ln(5);

// En-têtes des colonnes
$pdf->Cell(20, 10, '#', 1);
$pdf->Cell(40, 10, 'Date', 1);
$pdf->Cell(70, 10, 'Description', 1);
$pdf->Cell(40, 10, 'Contact', 1);
$pdf->Ln();

// Remplir les données du pdf a partir de la liste
$pdf->SetFont('Arial', '', 10);
foreach ($reclamations as $rec) {
    if (isset($rec['IdReclamation']) && isset($rec['DateDeLaReclamation']) && isset($rec['TypeDeReclamation']) && isset($rec['DescriptionDeLaReclamation']) && isset($rec['Contact'])) {
        $pdf->Cell(20, 10, $rec['IdReclamation'], 1);
        $pdf->Cell(40, 10, $rec['DateDeLaReclamation'], 1);
        $pdf->Cell(70, 10, utf8_decode($rec['DescriptionDeLaReclamation']), 1);
        $pdf->Cell(40, 10, utf8_decode($rec['Contact']), 1);
        $pdf->Ln();
    }
}

// Sortie PDF
$pdf->Output('D', 'liste_des_reclamation.pdf'); // Téléchargement direct
?>
