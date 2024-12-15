<?php
require('../../Library/phpfpdf/fpdf.php');
require('../../config/db.php'); // File koneksi database

    class PDF extends FPDF {
        // Header
        function Header() {
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(0, 10, 'Room Data Report', 0, 1, 'C');
            $this->Ln(10);
        }

        // Footer
        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Ambil data kamar dari database
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'Room ID', 1);
    $pdf->Cell(50, 10, 'Title', 1);
    $pdf->Cell(40, 10, 'Type', 1);
    $pdf->Cell(30, 10, 'Price', 1);
    $pdf->Cell(40, 10, 'Wifi', 1);
    $pdf->Ln();

    // Isi tabel
    $pdf->SetFont('Arial', '', 12);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['id'], 1);
        $pdf->Cell(50, 10, $row['room_title'], 1);
        $pdf->Cell(40, 10, $row['room_type'], 1);
        $pdf->Cell(30, 10, $row['price'], 1);
        $pdf->Cell(40, 10, $row['wifi'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No data available', 1, 1, 'C');
}

$pdf->Output();
?>
