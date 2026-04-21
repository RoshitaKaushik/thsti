<?php

namespace App\Controllers\formBuilder;

use App\Controllers\BaseController;
use App\Models\FormBuilderModel;
use App\Models\BuilderModel;
use App\Libraries\PdfNewFooter;

class Forms extends BaseController
{
    protected $FormBuilder_model;

    function __construct()
    {
        admin_check_session();
        $this->FormBuilder_model = new FormBuilderModel();
    }

    public function index()
    {//
    }

    function createPDF($application_id){
		set_time_limit(300);
		error_reporting(0);
        $application_id_en = $application_id;
        $application_id = encryptor('decrypt', $application_id);
        $user = $this->FormBuilder_model->getApplicationRecord($application_id);
		if(!empty($user)){
		    session()->remove('application_code');
			session()->remove('created_date');
			session()->remove('created_ip');
            
            session()->set('application_code', $user[0]['application_code']);
			session()->set('created_date', date('m/d/Y', strtotime($user[0]['created_date'])));
			session()->set('created_ip', $user[0]['created_ip']);

			$data['user'] = isset($user[0]) ? $user[0] : array();
			$data['field_details'] = getCustomFields($user[0]['component_id']);
			//$data['field_details'] = getAllCustomFields($user[0]['component_id']);
			$html = view('templates/formbuilder/pdf_view', $data);
            //echo $html; exit;
			$pdf = new PdfNewFooter('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Future Generation University');
			$pdf->SetTitle('Future Generation');
			$pdf->SetSubject('Students Forms');
			$pdf->SetKeywords('PDF');
			$pdf->setPrintHeader(false);
			// $pdf->SetFont('Arial', 'B', 12);
			// Add a page
			$pdf->AddPage();	
			ob_start();
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->setPrintFooter(true);
			//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			ob_end_clean();
			return $this->response
			->setHeader('Content-Type', 'application/pdf')
			->setBody($pdf->Output('application.pdf', 'S'));
		}else{
			// return redirect()->to('Forms/customForm/'.encryptor('encrypt', $application_code));
		}
		
	}

}
