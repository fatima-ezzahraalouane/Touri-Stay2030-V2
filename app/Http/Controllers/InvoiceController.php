<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

class InvoiceController extends Controller
{
    public function downloadInvoice($id)
    {
        $reservation = Reservation::findOrFail($id);

        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(190, 10, 'Facture de Réservation', 1, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 10, 'Réservation pour : ' . $reservation->user->name, 0, 1);
        $pdf->Cell(190, 10, 'Logement : ' . $reservation->annonce->title, 0, 1);
        $pdf->Cell(190, 10, 'Dates : Du ' . $reservation->date_debut . ' au ' . $reservation->date_fin, 0, 1);
        $pdf->Cell(190, 10, 'Prix total : ' . $reservation->prix_total . '€', 0, 1);
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 10, 'Coordonnées du Propriétaire', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        // $pdf->Cell(190, 10, 'Nom : ' . $reservation->proprietaire->name, 0, 1);
        // $pdf->Cell(190, 10, 'Email : ' . $reservation->proprietaire->email, 0, 1);

        $pdf->Output('D', 'facture_' . $reservation->id . '.pdf');
        exit;
    }
}
