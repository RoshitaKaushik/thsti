<?php

namespace App\Libraries;

use TCPDF;

class PdfNewFooter extends TCPDF
{
    public function __construct()
    {
        parent::__construct();
    }

    // Page header
    public function Header()
    {
        $image_file = K_PATH_IMAGES . 'FGU-Logo.png';
        $this->Image($image_file, 78, 10, 150, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 9);
        $this->SetY(-20);

        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(4);

        $this->SetFont('helvetica', '', 9);
        $this->Cell(0, 10, 'This is a computer generated document and does not require a signature.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(4);

        // Instead of using $_SESSION directly, use CodeIgniter session()
        $session = session();
        $applicationCode = $session->get('application_code');
        $createdDate = $session->get('created_date');
        $createdIp = $session->get('created_ip');

        $this->Cell(0, 10, 'This form is filed through Online Portal vide Application ID ' . $applicationCode . ' on ' . $createdDate . ' from this IP address ' . $createdIp . '.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    
}
