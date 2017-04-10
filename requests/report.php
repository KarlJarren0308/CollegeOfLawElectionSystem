<?php
    date_default_timezone_set('Asia/Manila');

    require('../fpdf/fpdf.php');
    require('pdf.php');
    require('election.php');

    function miniHeader($pdf, $position) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFillColor(211, 20, 37);
        $pdf->Cell(195, 8, $position, 1, 1, 'C', true);
        $pdf->SetFillColor(251, 60, 77);
        $pdf->Cell(75, 8, 'Candidate', 1, 0, 'C', true);
        $pdf->Cell(35, 8, 'Party', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'Year Level', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Votes', 1, 0, 'C', true);
        $pdf->Cell(20, 8, '%', 1, 1, 'C', true);
    }

    function printCandidates($election, $pdf, $candidates, $position, $counter) {
        foreach($candidates as $key => $candidate) {
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(25, 40, 35);

            if($candidate['position'] == $position) {
                $name = $candidate['middleinitial'] != '' ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $name = $candidate['lastname'] . ', ' . $candidate['firstname'];

                $totalNumerator = 0;
                $totalDenominator = 0;

                $pdf->Cell(75, 40, $name, 1, 0, 'C', true);
                $pdf->Cell(35, 40, $candidate['party'], 1, 0, 'C', true);

                for($i = 0; $i < $counter; $i++) {
                    if($i !== 0) {
                        $pdf->Cell(110, 8, '');
                    }

                    if($i % 2 == 0) {
                        $pdf->SetFillColor(255, 255, 255);
                    } else {
                        $pdf->SetFillColor(225, 225, 225);
                    }

                    $numerator = $election->getVoteCountPerYearLevel($candidate['id'], $i+1);
                    $denominator = $election->getVoterCount($i+1);

                    $percentage = $denominator > 0 ? number_format(($numerator / $denominator) * 100, 2) : 0;

                    $totalNumerator += $numerator;
                    $totalDenominator += $denominator;

                    $pdf->Cell(25, 8, $i+1, 1, 0, 'C', true);
                    $pdf->Cell(40, 8, $numerator . '/' . $denominator, 1, 0, 'C', true);
                    $pdf->Cell(20, 8, ($percentage + 0) . '%', 1, 1, 'C', true);
                }

                $totalPercentage = $totalDenominator > 0 ? number_format(($totalNumerator / $totalDenominator) * 100, 2) : 0;

                $pdf->SetFillColor(255, 150, 150);
                $pdf->Cell(110, 8, '');
                $pdf->Cell(25, 8, 'Total', 1, 0, 'C', true);
                $pdf->Cell(40, 8, $totalNumerator . '/' . $totalDenominator, 1, 0, 'C', true);
                $pdf->Cell(20, 8, ($totalPercentage + 0) . '%', 1, 1, 'C', true);
            }
        }
    }

    function printRepresentativeCandidates($election, $pdf, $candidates, $position, $counter) {
        foreach($candidates as $key => $candidate) {
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(25, 40, 35);

            if($candidate['position'] == $position) {
                $name = $candidate['middleinitial'] != '' ? $candidate['lastname'] . ', ' . $candidate['firstname'] . ' ' . $candidate['middleinitial'] . '.' : $name = $candidate['lastname'] . ', ' . $candidate['firstname'];
                $totalNumerator = 0;
                $totalDenominator = 0;

                $pdf->Cell(75, 16, $name, 1, 0, 'C', true);
                $pdf->Cell(35, 16, $candidate['party'], 1, 0, 'C', true);

                $pdf->SetFillColor(255, 255, 255);

                $numerator = $election->getVoteCountPerYearLevel($candidate['id'], $counter);
                $denominator = $election->getVoterCount($counter);

                $percentage = $denominator > 0 ? number_format(($numerator / $denominator) * 100, 2) : 0;

                $totalNumerator += $numerator;
                $totalDenominator += $denominator;

                $pdf->Cell(25, 8, $counter, 1, 0, 'C', true);
                $pdf->Cell(40, 8, $numerator . '/' . $denominator, 1, 0, 'C', true);
                $pdf->Cell(20, 8, ($percentage + 0) . '%', 1, 1, 'C', true);

                $totalPercentage = $totalDenominator > 0 ? number_format(($totalNumerator / $totalDenominator) * 100, 2) : 0;

                $pdf->SetFillColor(255, 150, 150);
                $pdf->Cell(110, 8, '');
                $pdf->Cell(25, 8, 'Total', 1, 0, 'C', true);
                $pdf->Cell(40, 8, $totalNumerator . '/' . $totalDenominator, 1, 0, 'C', true);
                $pdf->Cell(20, 8, ($totalPercentage + 0) . '%', 1, 1, 'C', true);
            }
        }
    }

    $election = new Election();
    $election->startReading('candidates');
    $election->connectNow();
    $candidates = $election->getCandidateInfo();
    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNBPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->SetTextColor(25, 40, 35);
    $pdf->Cell(195, 8, 'University of the East Manila - College of Law ' . date('Y') . ' Election Results', 0, 1, 'C');
    
    miniHeader($pdf, 'President');
    printCandidates($election, $pdf, $candidates, 'President', 4);

    miniHeader($pdf, 'Vice President');
    printCandidates($election, $pdf, $candidates, 'Vice President', 4);

    miniHeader($pdf, 'Secretary');
    printCandidates($election, $pdf, $candidates, 'Secretary', 4);

    miniHeader($pdf, 'Treasurer');
    printCandidates($election, $pdf, $candidates, 'Treasurer', 4);

    miniHeader($pdf, 'Auditor');
    printCandidates($election, $pdf, $candidates, 'Auditor', 4);

    miniHeader($pdf, 'Business Manager');
    printCandidates($election, $pdf, $candidates, 'Business Manager', 4);

    miniHeader($pdf, '4th Year Representative');
    printRepresentativeCandidates($election, $pdf, $candidates, '4th Year Representative', 4);

    miniHeader($pdf, '3rd Year Representative');
    printRepresentativeCandidates($election, $pdf, $candidates, '3rd Year Representative', 3);

    miniHeader($pdf, '2nd Year Representative');
    printRepresentativeCandidates($election, $pdf, $candidates, '2nd Year Representative', 2);

    miniHeader($pdf, '1st Year Representative');
    printRepresentativeCandidates($election, $pdf, $candidates, '1st Year Representative', 1);

    $pdf->Output('University of the East College of Law Election Results.pdf', 'I');
?>