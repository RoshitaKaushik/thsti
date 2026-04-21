<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ReportModel;
use App\Libraries\Pdf_portrait;

class PdfBuilder extends BaseController
{
    protected $Report_model;
    function __construct()
    {
        $this->Report_model = new ReportModel();
    }

    public function index()
    {
        //
    }

    function classReportPdf($class = '')
    {
        //ini_set('max_execution_time', 0); 
        $class = encryptor('decrypt', $class);
        $class_en = $class;
        $param1 = 'graduate';
        $param2 = 'withdrawn';
        $param3 = 'deffered';
        $param4 = 'continue';
        $data['class'] = $class != '' ? $class : 'All Clases';
        $data['records'] = $this->Report_model->classListReportByClass($class);
        if ($class != 'All') {
            $data['graduate'] =    $this->Report_model->StudentRecordListGraduateByClass($class);
            $data['withdrawn'] =    $this->Report_model->StudentRecordListWithdrawnByClass($class);
            $data['deffered'] =    $this->Report_model->StudentRecordListDefferedByClass($class);
            $data['continue'] =  $this->Report_model->StudentRecordListContinueByClass($class);
            $data['total_student'] = $this->Report_model->StudentCount($class);
            $data['total_student_program'] = $this->Report_model->StudentCountProgram($class);

            //echo '<pre>'; print_r($data['total_student_program']); die;
            $data['gender'] = $this->Report_model->classListReportGenderCountByClass($class);
            $data['completestudentinfo'] = $this->Report_model->classListingRegionWiseRecords($class);
            $data['completestudentcountryinfo'] = $this->Report_model->classListingCountryWiseRecords($class);
            $data['compleatetotalprogram'] = $this->Report_model->classListingTotalProgram($class);
            $html = view('templates/class_report_pdf_view', $data);
        } else {
            $data['AllClassList'] = $this->Report_model->getAllActiveClasses();
            $html = view('templates/all_class_report_pdf_view', $data);
        }
        $pdf = new Pdf_portrait('p', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 1, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        $pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);

        $pdf->SetHeaderMargin(10, 10, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, array(0, 0, 0), array(255, 255, 255));
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // Add a page
        $pdf->AddPage();
        ob_start();
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output();
    }

    function CertificatesReportPdf($class = '', $certificates = '')
    {
        //ini_set('max_execution_time', 0); 
        $class = encryptor('decrypt', $class);
        $certificates = encryptor('decrypt', $certificates);
        $class_en = $class;
        $param1 = 'graduate';
        $param2 = 'withdrawn';
        $param3 = 'deffered';
        $param4 = 'continue';
        $data['class'] = $class != '' ? $class : 'All Clases';
        $data['certificate'] = $certificates != '' ? $certificates : 'All Certificates';
        $data['records'] = $this->Report_model->classListReportBycertificates($class, $certificates);
        //echo '<pre>'; print_r($data['records']); die;
        $html = view('templates/certificates_report_pdf_view', $data);

        $pdf = new Pdf_portrait('p', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 1, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        $pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);

        $pdf->SetHeaderMargin(10, 10, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, array(0, 0, 0), array(255, 255, 255));
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // Add a page
        $pdf->AddPage();

        ob_start();
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output();
    }

    function getDonationReport()
    {
        $begin_date = $this->request->getPost('begin_date');
        $end_date   = $this->request->getPost('end_date');

        if ($begin_date == "") {
            $begin_date = '06-08-1970';
        }
        if ($end_date == "") {
            date_default_timezone_set('America/New_York');
            $end_date = date('d-m-Y');
        }

        $data = [];
        $data_array = [
            'begin_date' => $begin_date,
            'end_date'   => $end_date
        ];
        $data['report_date'] = $data_array;
        $data['monthrecords'] = $this->Report_model->getDonationMonthWiseReport_without_tuition_credit_refund($begin_date, $end_date);

        $pdf = new Pdf_portrait('L', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();

        $html = view('templates/donation_report', $data);

        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');

        $tagvs = ['div' => [0 => ['h' => 0, 'n' => 0], 1 => ['h' => 1, 'n' => 1]]];
        $pdf->setHtmlVSpace($tagvs);

        $pdf->SetMargins(14, 22, 14);
        $pdf->SetHeaderMargin(10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, [0, 0, 0], [255, 255, 255]);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        // ✅ Send proper PDF headers
        $pdf->Output('donation_report.pdf', 'I'); // 'I' = Inline view, 'D' = Force Download
        exit;
    }

    function getStudentPassportReport($class = '')
    {
        $class = encryptor('decrypt', $class);
        $class_en = $class;
        $data = array();
        $data['class'] = $class != '' ? $class : 'All Clases';
        $data['passportReports'] = $this->Report_model->getPassportYearwiseReport($class);
        //echo "<pre>"; print_r($data['passportReports']); die();
        //$data['AllClassList'] = $this->Report_model->getAllActiveClasses();
        $data['AllClassList'] = $this->Report_model->getAllActiveClasses($class);
        $pdf = new Pdf_portrait('L', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/passport_report', $data);
        //$pdf->setCellHeightRatio(0.8);
        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Passport Report');
        $pdf->SetKeywords('PDF');
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 1, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins(14, 22, 14);
        $pdf->SetHeaderMargin(10, 10, 10, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, array(0, 0, 0), array(255, 255, 255));
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->AddPage();
        ob_start();
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('Passport_report.pdf', 'I');
        exit;
    }
}
