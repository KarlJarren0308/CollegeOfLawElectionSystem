<?php
    class PDF extends FPDF {
        function Header() {
            $this->SetFont('Arial', '', 8);
            $this->SetTextColor(100, 100, 100);
            $this->Cell(195, 8, 'Prepared by UE CCSS Research & Development Unit', 0, 0, 'R');
            $this->Ln(9);
        }

        function Footer() {
            $this->SetY(-19.5);
            $this->SetFont('Arial', 'I', 8);
            $this->SetTextColor(100, 100, 100);
            $this->Cell(195, 8, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'R');
        }
    }
?>