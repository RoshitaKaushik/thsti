<?php
namespace App\Libraries;

use TCPDF;

class Pdf extends TCPDF
{
    public function __construct()
    {
        parent::__construct();
    }

    // Page header
    public function Header()
    {
        // Use session safely (CI4 style)
        $session = session();
        $image_file = $session->get('Header_Part') ?? K_PATH_IMAGES . 'FGU-Logo.png';

        $this->Image($image_file, 78, 10, 150, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer()
    {
        $this->SetY(-15);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

        $this->SetY(0);
        $this->SetFont("dejavusans", "", 9);
    }
}
