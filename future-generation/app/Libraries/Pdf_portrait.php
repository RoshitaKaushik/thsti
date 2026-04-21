<?php

namespace App\Libraries;

use TCPDF;

class Pdf_portrait extends TCPDF
{
    public function __construct()
    {
        if (!defined('K_PATH_IMAGES')) {
            define('K_PATH_IMAGES', APPPATH . 'ThirdParty/tcpdf/images/');
        }
        parent::__construct();
    }

    // Page header
    public function Header()
    {
        $image_file = K_PATH_IMAGES . 'FGU-Logo.png';
        $this->Image($image_file, 45.5, 10, 120, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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
