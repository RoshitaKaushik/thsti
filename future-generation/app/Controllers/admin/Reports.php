<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\GradeReportModel;
use App\Models\ApplicationModel;
use App\Models\ReportModel;
use App\Models\TimesheetModel;
use App\Models\ScbvModel;
use App\Models\UsersModel;
use App\Libraries\Pdf;
use App\Libraries\Excel;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Libraries\Pdf_portrait;
use DateTime;
use DateTimeZone;


class Reports extends BaseController
{
    protected $request;
    protected $Gradereport_model;
    protected $Application_model;
    protected $Report_model;
    protected $Timesheet_model;
    protected $SCBV_model;
    protected $Users_model;
    protected $validation;

    function __construct()
    {
        $this->request = \Config\Services::request();
        $this->Gradereport_model = new GradeReportModel();
        $this->Application_model = new ApplicationModel();
        $this->Report_model = new ReportModel();
        $this->Timesheet_model = new TimesheetModel();
        $this->SCBV_model = new ScbvModel();
        $this->Users_model = new UsersModel();
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        //
    }

    public function employmentListing()
    {
        $data['facultystaf'] = $this->Report_model->Get_faculty_staff();
        $data['content'] = 'backend/viewEmployeeListingmain';
        $data['data'] = $data;
        return view('backend/index', $data);
    }


    public function classListing($class = '')
    {

        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('1', '7')) {
                redirect('My401/');
            }
        }

        if ($this->request->getPost()) {
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            // by prabhat
            $data['records'] = $this->Report_model->classListReportByClass1($class);
        } else {
            $data['records'] = array();
        }
        $data['selectedclass'] = $class;
        $data['class'] = $this->Application_model->getAllClass();
        $data['content'] = 'backend/viewClassListing';


        //echo "<pre>";print_r($data['records']);die;

        return view('backend/index', $data);
    }

    public function checkIfReportAccess($display_id = '', $parent_id = '')
    {
        if ($display_id != '' && $parent_id != '') {
            $assigned_menu = $this->Users_model->getMenuAssignedToProfile(session()->get('profiles'));
            foreach ($assigned_menu as $am) {
                if (($am['display_id'] == $display_id) && ($am['parent_id'] == $parent_id)) {
                    return true;
                }
            }
        } else {
            return false;
        }

        return false;
    }

    public function classListingcertificates($class = '', $Certificates = '')
    {

        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 13 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('2', '7')) {
                redirect('My401/');
            }
        }

        //echo '<pre>'; print_r($_POST); die;
        if ($this->request->getPost()) {
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            /* if($class !='')
        {
            $data['semesters'] = $this->Application_model->getSemester($class);
        }
        else
        {
           $data['semesters'] = $this->Application_model->getallSemester();
        }*/

            $Certificates = $this->request->getPost('Certificates') != '' ? $this->request->getPost('Certificates') : '';
            $data['records'] = $this->Report_model->classListReportBycertificates($class, $Certificates);
            //echo $this->db->last_query();die;
            //echo '<pre>'; print_r($data['records']); die;
        } else {
            $data['records'] = array();
        }
        $data['selectedclass'] = $class;
        $data['selectedCertificates'] = $Certificates;
        $data['selecteddiploma'] = $this->request->getPost('diploma');
        $data['selectedsemester'] = $this->request->getPost('semester');

        $data['selectedlevel'] = $this->request->getPost('level');

        $data['class'] = $this->Application_model->getAllClassCertificates();
        $data['Certificates'] = $this->Application_model->getAllCertificates();
        $data['diplomas'] = $this->Application_model->get_diploma();
        $data['semesters'] = $this->Application_model->getallSemester();

        $data['content'] = 'backend/viewCertificatesListing';
        return view('backend/index', $data);
    }

    function filter_classListing()
    {
        if (session()->get('role') == 2) {
            if (!$this->checkIfReportAccess('1', '7')) {
                redirect('My401/');
            }
        }
        if ($this->request->getPost()) {
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $data['records'] = $this->Report_model->classListReportByClass1($class);
        } else {
            $data['records'] = array();
        }
        $data['selectedclass'] = $class;
        $data['class'] = $this->Application_model->getAllClass();
        return view('templates/filter/filter_viewClassListing', $data);
    }

    function data_encrypte()
    {
        if ($this->request->getPost('selected_class') != '') {
            $selected_class = encryptor('encrypt', $this->request->getPost('selected_class'));
            echo json_encode($selected_class);
        }
    }

    function filter_classListingcertificates()
    {
        if ($this->request->getPost('submit') == 'filter') {
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $Certificates = $this->request->getPost('Certificates') != '' ? $this->request->getPost('Certificates') : '';
            $data['records'] = $this->Report_model->classListReportBycertificates($class, $Certificates);
            $data['selected_field'] = $this->request->getPost('selected_field');
            //echo $this->db->last_query();
            return view('templates/filter/filter_viewCertificatesListing', $data);
        }
    }

    public function export_pdf_certficate_class_semesrer_list()
    {
        $class = $this->request->getPost('class');
        $Certificates = $this->request->getPost('Certificates');

        $data['records'] = $this->Report_model->classListReportBycertificates($class, $Certificates);
        $data['certificate'] = $Certificates;

        $html = view('templates/certificates_report_pdf_view', $data);

        $pdf = new Pdf('L', 'cm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');

        $pdf->SetMargins(14, 26, 20);
        $pdf->SetHeaderMargin(10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->AddPage();

        if (ob_get_length()) ob_end_clean();  // ✅ Clean any previous output

        $pdf->writeHTML($html, true, false, true, false, '');

        // ✅ Force correct headers and inline PDF
        $pdf->Output('certificates_report.pdf', 'I');
        exit;  // ✅ Prevent any extra output
    }


    public function addGeneralMailingList($StateID = '')
    {

        if (session()->get('role') == 2) {
            // 3 = specifies the 1'st submenu and 13 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('3', '7')) {
                redirect('My401/');
            }
        }

        $data['records'] = $this->Report_model->getApplicantGeneralMailReport();
        //echo "<pre>";  print_r($data['records']); exit;
        $data['content'] = 'backend/addGeneralMailingList';
        return view('backend/index', $data);
    }

    public function  SemesterList($class = '', $semester = '')
    {
        if (session()->get('role') == 2) {
            // 4 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('4', '7')) {
                redirect('My401/');
            }
        }

        if ($this->request->getPost()) {
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['records'] = $this->Report_model->classSemesterReportByClass($class, $semester);
            $data['recordss'] = $this->Report_model->classSemesterReportByClasss($class, $semester);


            $data['course'] = $this->Report_model->get_course($semester, $class);


            //echo "<pre>";  print_r($data['records']); die();
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
            //echo "<pre>"; print_r($unique_types); die();

        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
        }
        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester'] = $semester;
        $data['title'] = 'Semester List Report';
        //echo "<pre>"; print_r($data['records']); die();
        $data['class'] = $this->Application_model->getAllClass();
        $data['semesterlist'] = $this->Report_model->getAllSemsterList();


        $data['content'] = 'backend/viewSemesterList';
        return view('backend/index', $data);
    }

    public function  filter_SemesterList($class = '', $semester = '')
    {
        if (session()->get('role') == 2) {
            // 4 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('4', '7')) {
                redirect('My401/');
            }
        }
        $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
        $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
        $data['records'] = $this->Report_model->classSemesterReportByClass($class, $semester);
        $data['recordss'] = $this->Report_model->classSemesterReportByClasss($class, $semester);
        $data['course'] = $this->Report_model->get_course($semester, $class);
        $data['unique_types'] = array_unique(array_map(function ($elem) {
            return $elem['course_row_id'];
        }, $data['records']));
        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester'] = $semester;
        return view('templates/filter/filter_viewSemesterList', $data);
    }

    public function getcourse()
    {
        $semester = $this->request->getPost('semester_id');
        $year =  $this->request->getPost('year');
        $course = $this->Report_model->get_course($semester, $year);

        if ($course) {
            echo "<option value=''>Please Select Course</option>";
            foreach ($course as $cr) {
                echo "<option value='" . $cr['CourseID'] . "'>" . $cr['CourseTitle'] . " &nbsp;(" . $cr['Course'] . ")</option>";
            }
        } else {
            echo "<option value=''>No Course</option>";
        }
    }

    public function export_pdf_SemesterList($class = '', $semester = '')
    {
        if (session()->get('role') == 2) {
            if (!$this->checkIfReportAccess('4', '7')) {
                return redirect('My401/');
            }
        }

        $class = $this->request->getPost('class') ?: '';
        $semester = $this->request->getPost('semester') ?: '';

        $data['records'] = $this->Report_model->classSemesterReportByClass($class, $semester);
        $data['recordss'] = $this->Report_model->classSemesterReportByClasss($class, $semester);
        $data['course'] = $this->Report_model->get_course($semester, $class);

        $data['unique_types'] = array_unique(array_map(function ($elem) {
            return $elem['course_row_id'];
        }, $data['records']));

        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester'] = $semester;

        $pdf = new Pdf('L', 'mm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');

        $pdf->SetMargins(14, 22, 14);
        $pdf->SetHeaderMargin(10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->AddPage('L', 'MAKE-L');

        $html = view('templates/export_semester_report_pdf', $data);

        ob_end_clean();  // ✅ clear previous output before writing PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('semester_report.pdf', 'I');  // 'I' = inline, 'D' = download
        exit;
    }


    public function  dynamicreport($class = '', $semester = '')
    {

        if (session()->get('role') == 2) {
            // 5 = specifies the 1'st submenu and 13 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('5', '7')) {
                redirect('My401/');
            }
        }

        if ($this->request->getPost()) {
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['records'] = $this->Report_model->classSemesterReportByClass_range($class, $semester);

            $data['recordss'] = $this->Report_model->classSemesterReportByClasss_range($class, $semester);

            $data['course'] = $this->Report_model->get_course_in_range($semester, $class, $this->request->getPost('class'));

            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));

            $data['selectedclass'] = $class;
            $data['selectedclassto'] = $this->request->getPost('class_to');
            $data['class_to'] = $this->Report_model->get_higher_class($class);
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['selectedclass'] = date('Y');
            $data['selectedclassto'] = date('Y');
            $data['class_to'] = $this->Report_model->get_higher_class(date('Y'));
        }
        $data['selectedcourse'] = $this->request->getPost('course');

        $data['selected_course_title'] = $this->request->getPost('course_title');


        $data['selectedSemester'] = $semester;


        $data['class'] = $this->Report_model->getAllClass();
        $data['semesterlist'] = $this->Report_model->getAllSemsterList();
        $data['content'] = 'backend/dynamicReport';
        return view('backend/index', $data);
    }

    public function get_course_in_range()
    {
        $semester = $this->request->getPost('semester_id');
        $year =  $this->request->getPost('year');
        $year_to = $this->request->getPost('year_to');
        $course = $this->Report_model->get_course_in_range($semester, $year, $year_to);



        if ($course) {
            echo "<option value=''>Please Select Course</option>";
            foreach ($course as $cr) {
                echo "<option value='" . $cr['Course'] . "'>" . $cr['CourseTitle'] . " &nbsp;(" . $cr['Course'] . ")</option>";
            }
        } else {
            echo "<option value=''>No Course</option>";
        }
    }

    public function  export_excell_dynamicreport($class = '', $semester = '')
    {
        if ($this->request->getPost()) {
            $tmpfname = FCPATH . 'uploads/example.xls';
            $excelReader = IOFactory::load($tmpfname);
            $data['objPHPExcel'] = $excelReader;
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['selected_semester'] = $semester;
            $data['selected_course'] = $this->request->getPost('course');
            $data['records'] = $this->Report_model->classSemesterReportByClass_range($class, $semester);

            $data['recordss'] = $this->Report_model->classSemesterReportByClasss_range($class, $semester);

            $data['course'] = $this->Report_model->get_course_in_range($semester, $class, $this->request->getPost('class'));

            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));

            $data['selectedclass'] = $class;
            $data['selectedclassto'] = $this->request->getPost('class_to');
            $data['class_to'] = $this->Report_model->get_higher_class($class);
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['selectedclass'] = date('Y');
            $data['selectedclassto'] = date('Y');
            $data['class_to'] = $this->Report_model->get_higher_class(date('Y'));
        }

        $data['type'] = '';
        $data['title'] = $this->request->getPost('title');
        return view('templates/export_excel_report_pdf', $data);
        /*  $output .=$html;
		  header('Content-Type: application/xls');
		  header('Content-Disposition: attachment; filename=course_report_"'.date('d-M-Y').'".xls');
		  echo $output;*/
    }

    public function  filter_dynamicreport($class = '', $semester = '')
    {
        if (session()->get('role') == 2) {
            // 5 = specifies the 1'st submenu and 13 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('5', '7')) {
                redirect('My401/');
            }
        }

        $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
        $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
        $data['records'] = $this->Report_model->classSemesterReportByClass_range($class, $semester);
        $data['recordss'] = $this->Report_model->classSemesterReportByClasss_range($class, $semester);
        $data['course'] = $this->Report_model->get_course_in_range($semester, $class, $this->request->getPost('class'));
        $data['unique_types'] = array_unique(array_map(function ($elem) {
            return $elem['course_row_id'];
        }, $data['records']));
        $data['selectedclass'] = $class;
        $data['selectedclassto'] = $this->request->getPost('class_to');
        $data['class_to'] = $this->Report_model->get_higher_class($class);

        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selected_course_title'] = $this->request->getPost('course_title');
        $data['selectedSemester'] = $semester;
        $data['class'] = $this->Report_model->getAllClass();
        $data['semesterlist'] = $this->Report_model->getAllSemsterList();
        return view('templates/filter/filter_dynamicReport', $data);
    }

    function filter_grade_report()
    {
        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('6', '7')) {
                redirect('My401/');
            }
        }

        $type = $this->request->getPost('type');
        $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
        $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
        $data['recordss'] = $this->Report_model->classSemesterReportByType_range($type, $class, $semester);
        //echo $this->db->last_query();
        //echo "<pre>";print_r($data['recordss']);echo "</pre>";
        $data['records'] = $this->Report_model->classSemesterReportByTypes_range($type, $class, $semester);
        //echo $this->db->last_query();
        //echo "<pre>";print_r($data['records']);echo "</pre>";die;
        $data['selected_grade'] = $type;
        $data['course'] = $this->Report_model->get_course_in_range($semester, $class, $this->request->getPost('class'));
        $data['unique_types'] = array_unique(array_map(function ($elem) {
            return $elem['course_row_id'];
        }, $data['records']));
        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedclassto'] = $this->request->getPost('class_to');
        $data['selected_course_title'] = $this->request->getPost('course_title');
        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedSemester'] = $semester;
        $data['class'] = $this->Report_model->getAllClass();
        $data['semesterlist'] = $this->Report_model->getAllSemsterList();
        return view('templates/filter/filter_gradereport', $data);
    }

    public function  gradereport($class = '', $semester = '')
    {

        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('6', '7')) {
                redirect('My401/');
            }
        }


        if ($this->request->getPost()) {

            $type = $this->request->getPost('type');
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['recordss'] = $this->Report_model->classSemesterReportByType_range($type, $class, $semester);
            $data['records'] = $this->Report_model->classSemesterReportByTypes_range($type, $class, $semester);
            //	echo $this->db->last_query();die;
            $data['selected_grade'] = $type;
            $data['course'] = $this->Report_model->get_course_in_range($semester, $class, $this->request->getPost('class'));
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
            $data['selectedcourse'] = $this->request->getPost('course');
            $data['selectedclass'] = $class;
            $data['selectedclassto'] = $this->request->getPost('class_to');
            $data['class_to'] = $this->Report_model->get_higher_class($class);
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['$selected_grade'] = '';
            $data['selectedclass'] = date('Y');
            $data['selectedclassto'] = date('Y');
            $data['class_to'] = $this->Report_model->get_higher_class(date('Y'));
        }

        $data['selected_course_title'] = $this->request->getPost('course_title');

        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedSemester'] = $semester;
        $data['class'] = $this->Report_model->getAllClass();
        $data['semesterlist'] = $this->Report_model->getAllSemsterList();

        $data['content'] = 'backend/gradereport';
        return view('backend/index', $data);
    }

    public function export_pdf_grade_report()
    {
        if ($this->request->getPost()) {

            $type = $this->request->getPost('type');
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['recordss'] = $this->Report_model->classSemesterReportByType_range($type, $class, $semester);
            $data['records'] = $this->Report_model->classSemesterReportByTypes_range($type, $class, $semester);
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['$selected_grade'] = '';
        }

        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedclassto'] = $this->request->getPost('class_to');
        $data['selectedSemester'] = $semester;

        $course_id = $this->request->getPost('course');
        $data['title'] = $this->request->getPost('title');
        $data['selected_course_detail'] = $this->Report_model->getCorse_details_by_ID($course_id);
        $data['type'] = $this->request->getPost('type');

        // Clean any previous output
        ob_end_clean();

        $pdf = new Pdf('L', 'mm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/export_report_pdf1', $data);

        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 1, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins(14, 22, 14);
        $pdf->SetHeaderMargin(10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->AddPage('L', 'MAKE-L');

        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF with headers
        $pdf->Output('grade_report.pdf', 'I'); // 'I' = inline, 'D' = download
        exit;
    }


    public function export_grade_report_excell()
    {

        if ($this->request->getPost()) {

            $type = $this->request->getPost('type');
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['recordss'] = $this->Report_model->classSemesterReportByType_range($type, $class, $semester);
            $data['records'] = $this->Report_model->classSemesterReportByTypes_range($type, $class, $semester);
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['$selected_grade'] = '';
        }


        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester'] = $semester;
        $data['selectedclassto'] = $this->request->getPost('class_to');
        // return view('backend/index', $data);    
        $course_id = $this->request->getPost('course');


        $data['title'] = $this->request->getPost('title');

        $data['selected_course_detail'] = $this->Report_model->getCorse_details_by_ID($course_id);
        $data['type'] = $this->request->getPost('type');

        $html = view('templates/export_excel_grade_report_pdf', $data);
        $output = '';
        $output .= $html;
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=grade_sheet_report.xls');
        echo $output;
    }

    public function get_higher_class()
    {
        $year = $this->request->getPost('year');
        if ($year != '') {
            $class = $this->Report_model->get_higher_class($year);
            echo '<option value="">Select</option>';
            foreach ($class as $cl) {
                echo '<option value="' . $cl['Class'] . '">' . $cl['Class'] . '</option>';
            }
        }
    }

    public function export_pdf_dynamicreport($class = '', $semester = '')
    {
        if ($this->request->getPost()) {
            $class = $this->request->getPost('class') ?: '';
            $semester = $this->request->getPost('semester') ?: '';

            $data['selected_semester'] = $semester;
            $data['selected_course'] = $this->request->getPost('course');
            $data['records'] = $this->Report_model->classSemesterReportByClass_range($class, $semester);
            $data['recordss'] = $this->Report_model->classSemesterReportByClasss_range($class, $semester);
            $data['course'] = $this->Report_model->get_course_in_range($semester, $class, $this->request->getPost('class'));

            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));

            $data['selectedclass'] = $class;
            $data['selectedclassto'] = $this->request->getPost('class_to');
            $data['class_to'] = $this->Report_model->get_higher_class($class);
        } else {
            $data['records'] = [];
            $data['unique_types'] = [];
            $data['course'] = [];
            $data['selectedclass'] = date('Y');
            $data['selectedclassto'] = date('Y');
            $data['class_to'] = $this->Report_model->get_higher_class(date('Y'));
        }

        $data['title'] = $this->request->getPost('title');
        $data['selected_course_detail'] = '';
        $data['type'] = $this->request->getPost('type');

        // ✅ Prevent corrupted output
        ob_end_clean();
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        $pdf = new Pdf('L', 'mm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');

        $pdf->SetMargins(14, 22, 14);
        $pdf->SetHeaderMargin(10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);

        $pdf->AddPage('L', 'MAKE-L');

        $html = view('templates/export_report_pdf', $data);
        $pdf->writeHTML($html, true, false, true, false, '');

        // ✅ Correct headers
        header('Content-Type: application/pdf');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        $pdf->Output('dynamic_report.pdf', 'I'); // 'I' = view in browser
        exit;
    }

    public function  gradsheetreport($class = '', $semester = '')
    {
        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('7', '7')) {
                redirect('My401/');
            }
        }

        if ($this->request->getPost()) {

            $type = '';
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['recordss'] = $this->Report_model->classSemesterReportByType($type, $class, $semester);
            $data['records'] = $this->Report_model->classSemesterReportByTypes($type, $class, $semester);



            $data['selected_grade'] = $type;

            $data['course'] = $this->Report_model->get_course($semester, $class);
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['$selected_grade'] = '';
        }

        //echo "<pre>"; print_r($data['records']); die();
        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester'] = $semester;
        $data['class'] = $this->Application_model->getAllClass();
        $data['semesterlist'] = $this->Report_model->getAllSemsterList();

        $course_id = $this->request->getPost('course');
        $data['selected_course_detail'] = $this->Report_model->getCorse_details_by_ID($course_id);
        $data['data'] = $data;

        $data['content'] = 'backend/gradsheetreport';
        return view('backend/index', $data);
    }

    public function export_pdf_report()
    {
        if ($this->request->getPost()) {

            $type = $this->request->getPost('type');
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['recordss'] = $this->Report_model->classSemesterReportByType($type, $class, $semester);
            $data['records'] = $this->Report_model->classSemesterReportByTypes($type, $class, $semester);
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['$selected_grade'] = '';
        }


        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester'] = $semester;
        // return view('backend/index', $data);    
        $course_id = $this->request->getPost('course');


        $data['title'] = $this->request->getPost('title');
        $data['selected_course_detail'] = $this->Report_model->getCorse_details_by_ID($course_id);
        //echo "<pre>";print_r($data['selected_course_detail']);die;

        error_reporting(0);

        $pdf = new Pdf_portrait('L', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/export_pdf_grade_sheet', $data);
        //$pdf->setCellHeightRatio(0.8);
        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
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
        //	$pdf->Output();
        $filename = 'grade_report_' . date('Y-m-d_H-i-s') . '.pdf';
        $pdfContent = $pdf->Output($filename, 'I');

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($pdfContent);
    }


    public function export_grade_sheet_excell()
    {

        if ($this->request->getPost()) {

            $type = $this->request->getPost('type');
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['recordss'] = $this->Report_model->classSemesterReportByType($type, $class, $semester);
            $data['records'] = $this->Report_model->classSemesterReportByTypes($type, $class, $semester);
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['$selected_grade'] = '';
        }


        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester'] = $semester;
        // return view('backend/index', $data);    
        $course_id = $this->request->getPost('course');


        $data['title'] = $this->request->getPost('title');

        $data['selected_course_detail'] = $this->Report_model->getCorse_details_by_ID($course_id);

        $html = view('templates/export_excell_grade_sheet', $data);
        $output = '';
        $output .= $html;
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=grade_sheet_report.xls');
        echo $output;
    }

    public function  filter_gradsheetreport($class = '', $semester = '')
    {

        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('7', '7')) {
                redirect('My401/');
            }
        }

        if ($this->request->getPost()) {
            //$type = 'SCH';
            $type = '';
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
            $data['recordss'] = $this->Report_model->classSemesterReportByType($type, $class, $semester);
            $data['records'] = $this->Report_model->classSemesterReportByTypes($type, $class, $semester);
            $data['selected_grade'] = $type;
            $data['course'] = $this->Report_model->get_course($semester, $class);
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        } else {
            $data['records'] = array();
            $data['unique_types'] = array();
            $data['course'] = array();
            $data['$selected_grade'] = '';
        }

        //echo "<pre>"; print_r($data['records']); die();
        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester'] = $semester;
        $data['class'] = $this->Application_model->getAllClass();
        $data['semesterlist'] = $this->Report_model->getAllSemsterList();

        $course_id = $this->request->getPost('course');
        $data['selected_course_detail'] = $this->Report_model->getCorse_details_by_ID($course_id);

        return view('templates/filter/filter_gradsheetreport', $data);
    }

    public function student_demographic_report()
    {

        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('8', '7')) {
                redirect('My401/');
            }
        }

        if ($this->request->getPost()) {
            $data['student_demographic_report'] = $this->Report_model->student_demographic_report();
            // echo "<pre>";print_r( $data['student_demographic_report']);die;
            // echo $this->db->last_query();die;
        } else {
            $data['student_demographic_report'] = array();
        }
        $data['selected_Ethnicity'] = $this->request->getPost('Ethnicity');
        $data['selected_citizenship'] = $this->request->getPost('citizenship');
        $data['selected_Country'] = $this->request->getPost('Country');

        $data['selected_any_graduation_from'] = $this->request->getPost('graduation_any_from');
        $data['selected_any_graduation_to'] = $this->request->getPost('graduation_any_to');


        $data['selected_Country_other'] = $this->request->getPost('other_country');

        $data['selected_Sex'] = $this->request->getPost('Sex');

        $data['selected_Certificates'] = $this->request->getPost('Certificates');


        $data['selected_special_start'] = $this->request->getPost('special_start');
        $data['selected_special_end'] = $this->request->getPost('special_end');
        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_enroll_certificate'] = $this->request->getPost('enroll_certificate');
        $data['selected_master_program'] = $this->request->getPost('master_program');


        $data['selected_graduate_state'] = $this->request->getPost('graduate_state');
        $data['selected_graduation_from'] = $this->request->getPost('graduation_from');
        $data['selected_graduation_to'] = $this->request->getPost('graduation_to');

        $data['selected_not_graduation_from'] = $this->request->getPost('not_graduation_from');
        $data['selected_not_graduation_to'] = $this->request->getPost('not_graduation_to');

        $data['selected_withdrawn'] = $this->request->getPost('withdrawn');

        $data['country'] = $this->SCBV_model->get_country();

        $data['start_date_from'] = $this->request->getPost('start_date_from');
        $data['start_date_to'] = $this->request->getPost('start_date_to');

        $data['student_program'] = $this->Application_model->getAllActiveProgram();
        $data['student_special_program'] = $this->Application_model->getspecialprogram();
        $data['selected_special_program'] = $this->request->getPost('special_program');
        $data['selected_program'] = $this->request->getPost('program');

        $data['Certificates'] = $this->Application_model->getAllCertificates2();
        $data['tracks'] = $this->Application_model->get_active_track();
        $data['content'] = 'backend/student_demographic_report';
        return view('backend/index', $data);
    }

    public function filter_student_demographic_report()
    {
        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('8', '7')) {
                redirect('My401/');
            }
        }
        if ($this->request->getPost()) {
            $data['student_demographic_report'] = $this->Report_model->student_demographic_report();
            //echo $this->db->last_query();die;
            $data['selected_all']               = $this->request->getPost('select_all');
        } else {
            $data['student_demographic_report'] = array();
        }
        $data['selected_Ethnicity'] = $this->request->getPost('Ethnicity');
        $data['selected_citizenship'] = $this->request->getPost('citizenship');
        $data['selected_Country'] = $this->request->getPost('Country');
        $data['selected_any_graduation_from'] = $this->request->getPost('graduation_any_from');
        $data['selected_any_graduation_to'] = $this->request->getPost('graduation_any_to');
        $data['selected_Country_other'] = $this->request->getPost('other_country');
        if (sizeof($this->request->getPost('field_text')) > 0) {
            $data['selected_field'] = $this->request->getPost('field_text');
        } else {
            $data['selected_field'] = explode(",", 'All');
        }
        $data['selected_Sex'] = $this->request->getPost('Sex');
        $data['selected_Certificates'] = $this->request->getPost('Certificates');
        $data['selected_special_start'] = $this->request->getPost('special_start');
        $data['selected_special_end'] = $this->request->getPost('special_end');
        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_enroll_certificate'] = $this->request->getPost('enroll_certificate');
        $data['selected_master_program'] = $this->request->getPost('master_program');
        $data['selected_graduate_state'] = $this->request->getPost('graduate_state');
        $data['selected_graduation_from'] = $this->request->getPost('graduation_from');
        $data['selected_graduation_to'] = $this->request->getPost('graduation_to');
        $data['selected_not_graduation_from'] = $this->request->getPost('not_graduation_from');
        $data['selected_not_graduation_to'] = $this->request->getPost('not_graduation_to');
        $data['selected_withdrawn'] = $this->request->getPost('withdrawn');
        $data['start_date_from'] = $this->request->getPost('start_date_from');
        $data['start_date_to'] = $this->request->getPost('start_date_to');

        $data['student_program'] = $this->Application_model->getAllActiveProgram();
        $data['student_special_program'] = $this->Application_model->getspecialprogram();
        $data['selected_special_program'] = $this->request->getPost('special_program');
        $data['selected_program'] = $this->request->getPost('program');

        $data['Certificates'] = $this->Application_model->getAllCertificates2();
        view('templates/filter/filter_student_demographic_report', $data);
    }

    public function special_program_report()
    {

        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('9', '7')) {
                redirect('My401/');
            }
        }

        $class = date('Y');
        $class_to =  date('Y');
        $s_program_id = $this->request->getPost('special_program_id');
        if ($this->request->getPost()) {
            $class = $this->request->getPost('class');
            $class_to = $this->request->getPost('class_to');

            if ($s_program_id != 'All') {
                $s_program_id = encryptor('decrypt', $s_program_id);
            }
            $data['student_details'] = $this->Report_model->get_special_program_report($s_program_id);
            $data['class_to'] = $this->Report_model->get_higher_class($class);
            //echo "<pre>";print_r($data['student_details']);die;
        } else {
            $data['student_details'] = array();
            $data['class_to'] = $this->Report_model->get_higher_class(date('Y'));
        }
        $data['student_special_program'] = $this->Application_model->getspecialprogram();

        $data['selected'] = $s_program_id;

        $data['selectedclass'] = $class;
        $data['selectedclassto'] = $class_to;
        $data['class'] = $this->Report_model->getAllClass();

        $data['content'] = 'backend/special_program_report';
        $data['page'] = '';
        return view('backend/index', $data);
    }

    function filter_special_program_report()
    {

        if (session()->get('role') == 2) {
            // 1 = specifies the 1'st submenu and 7 specifies the Report menu which is the parent of the submenu.
            if (!$this->checkIfReportAccess('9', '7')) {
                redirect('My401/');
            }
        }

        $class = date('Y');
        $class_to =  date('Y');
        if ($this->request->getPost()) {
            $class = $this->request->getPost('class');
            $class_to = $this->request->getPost('class_to');
            $s_program_id = $this->request->getPost('special_program_id');
            if ($s_program_id != 'All') {
                $s_program_id = encryptor('decrypt', $s_program_id);
            }
            $data['student_details'] = $this->Report_model->get_special_program_report($s_program_id);
            $data['class_to'] = $this->Report_model->get_higher_class($class);
        } else {
            $data['student_details'] = array();
            $data['class_to'] = $this->Report_model->get_higher_class(date('Y'));
        }
        $data['student_special_program'] = $this->Application_model->getspecialprogram();
        $data['selected'] = $s_program_id;
        $data['selectedclass'] = $class;
        $data['selectedclassto'] = $class_to;
        $data['class'] = $this->Report_model->getAllClass();
        return view('templates/filter/filter_special_program_report', $data);
    }

    function completionsreport()
    {
        $data['selected_graduation_from'] = $this->request->getPost('graduation_from');
        $data['selected_graduation_to'] = $this->request->getPost('graduation_to');

        $data['selected_gender'] = $this->request->getPost('Sex');
        $data['selected_age']  = $this->request->getPost('age');
        $data['selected_ethnicity'] = $this->request->getPost('Ethnicity');
        $data['class'] = $this->Application_model->getAllClass();
        if ($this->request->getPost()) {
            $data['records'] = $this->Report_model->completionsreport('F');
            //echo $this->db->last_query();die;   
            $data['men_records'] = $this->Report_model->completionsreport('M');
            //echo $this->db->last_query();die;
            // echo "<pre>";print_r($data['records']);echo "</pre>";die;
            // echo $this->db->last_query();die;

        } else {
            $data['records'] = array();
        }

        $data['content'] = 'backend/completionsreport';
        return view('backend/index', $data);
    }

    function filter_completionsreport()
    {
        $data['selected_graduation_from']  =   $this->request->getPost('graduation_from');
        $data['selected_graduation_to']    =   $this->request->getPost('graduation_to');
        $data['selected_gender']           =   $this->request->getPost('Sex');
        $data['selected_age']              =   $this->request->getPost('age');
        $data['selected_ethnicity']        =   $this->request->getPost('Ethnicity');
        $data['class']                     =   $this->Application_model->getAllClass();
        if ($this->request->getPost()) {
            $data['records']      =   $this->Report_model->completionsreport('F');
            $data['men_records']  =   $this->Report_model->completionsreport('M');
        } else {
            $data['records']   =    array();
        }
        return view('templates/filter/filter_completionsreport', $data);
    }

    public function export_pdf_completionsreport()
    {
        error_reporting(0);
        //echo "<pre>";print_r($this->request->getPost());echo "</pre>";die;
        $data['selected_graduation_from'] = $this->request->getPost('graduation_from');
        $data['selected_graduation_to'] = $this->request->getPost('graduation_to');

        $data['selected_gender'] = $this->request->getPost('Sex');
        $data['selected_age']  = $this->request->getPost('age');
        $data['selected_ethnicity'] = $this->request->getPost('Ethnicity');


        $data['records'] = $this->Report_model->completionsreport('F');
        $data['men_records'] = $this->Report_model->completionsreport('M');
        //echo "<pre>";print_r($data);echo "</pre>";
        $pdf = new Pdf('L', 'cm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/export_pdf_completionsreport', $data);
        //$pdf->setCellHeightRatio(0.8);
        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 1, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins(14, 26, 20);
        $pdf->SetHeaderMargin(10, 10, 10, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, array(0, 0, 0), array(255, 255, 255));
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->AddPage('L', 'MAKE-L');
        ob_start();
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdfContent = $pdf->Output('completionsreport.pdf', 'I');

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($pdfContent);
    }


    public function export_excel_completionsreport()
    {
        error_reporting(0);
        //echo "<pre>";print_r($this->request->getPost());echo "</pre>";die;
        $data['selected_graduation_from'] = $this->request->getPost('graduation_from');
        $data['selected_graduation_to'] = $this->request->getPost('graduation_to');

        $data['selected_gender'] = $this->request->getPost('Sex');
        $data['selected_age']  = $this->request->getPost('age');
        $data['selected_ethnicity'] = $this->request->getPost('Ethnicity');


        $data['records'] = $this->Report_model->completionsreport('F');
        $data['men_records'] = $this->Report_model->completionsreport('M');

        $tmpfname = FCPATH . 'uploads/example.xls';
        $excelReader = IOFactory::createReaderForFile($tmpfname);
        $data['objPHPExcel'] = $excelReader->load($tmpfname);

        return view('templates/export_excel_completionsreport', $data);
    }

    function filter_fallenrollmentreport()
    {
        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_semester'] = $this->request->getPost('semester');
        $data['class'] = $this->Application_model->getAllClass();
        if ($this->request->getPost()) {
            $data['course']     = $this->Report_model->get_filter_course('Fall');
            $data['records']    = $this->Report_model->classFall2SemesterReportByClass('F');
            $data['recordss']   = $this->Report_model->classFall2SemesterReportByClasss('F');
            $data['m_records']  = $this->Report_model->classFall2SemesterReportByClass('M');
            $data['m_recordss'] = $this->Report_model->classFall2SemesterReportByClasss('M');
            $data['m_unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['m_records']));
            $data['unique_types']   = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        } else {
            $data['records'] = array();
            $data['recordss'] = array();
            $data['course'] = array();
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        }
        return view('templates/filter/filter_fallenrollmentreport', $data);
    }

    function fallenrollmentreport()
    {
        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_semester'] = $this->request->getPost('semester');

        $data['class'] = $this->Application_model->getAllClass();
        if ($this->request->getPost()) {
            //  $data['records'] = $this->Report_model->fallenrollmentreport();
            $data['course'] = $this->Report_model->get_filter_course('Fall');

            $data['records'] = $this->Report_model->classFall2SemesterReportByClass('F');

            // echo $this->db->last_query();die;

            $data['recordss'] = $this->Report_model->classFall2SemesterReportByClasss('F');

            $data['m_records'] = $this->Report_model->classFall2SemesterReportByClass('M');
            $data['m_recordss'] = $this->Report_model->classFall2SemesterReportByClasss('M');

            $data['m_unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['m_records']));


            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        } else {
            $data['records'] = array();
            $data['recordss'] = array();
            $data['course'] = array();
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        }

        $data['content'] = 'backend/fallenrollmentreport';
        return view('backend/index', $data);
    }


    public function export_pdf_fallenrollmentreport()
    {
        error_reporting(0);

        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_semester'] = $this->request->getPost('semester');
        $data['start_program_date'] = '15-07-';
        $data['end_program_date'] = '01-03-';
        $data['records'] = $this->Report_model->fallenrollmentreport2('F');
        $data['m_records'] = $this->Report_model->fallenrollmentreport2('M');

        $pdf = new Pdf('L', 'cm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');

        $pdf->SetMargins(14, 26, 20);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->AddPage('L', 'MAKE-L');

        $html = view('templates/export_pdf_fallenrollmentreport', $data);

        // ✅ Clean any previous output
        if (ob_get_length()) ob_end_clean();

        $pdf->writeHTML($html, true, false, true, false, '');

        // ✅ Force correct headers and output as download
        header('Content-Type: application/pdf');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        $pdf->Output('fallenrollmentreport.pdf', 'I'); // 'I' = Inline view, 'D' = Download
        exit; // ✅ Ensure no extra output
    }


    public function export_excel_fallenrollmentreport()
    {
        //error_reporting(0);

        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_semester'] = $this->request->getPost('semester');
        $data['start_program_date'] = '5-10-';
        $data['end_program_date'] = '';

        if ($this->request->getPost()) {

            $data['course'] = $this->Report_model->get_filter_course('Fall');
            $data['records'] = $this->Report_model->classFall2SemesterReportByClass('F');
            // echo $this->db->last_query();die;
            $data['recordss'] = $this->Report_model->classFall2SemesterReportByClasss('F');
            $data['m_records'] = $this->Report_model->classFall2SemesterReportByClass('M');
            $data['m_recordss'] = $this->Report_model->classFall2SemesterReportByClasss('M');

            $data['all_records'] = $this->Report_model->classFall2SemesterReportByClass();

            $data['m_unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['all_records']));


            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['all_records']));


            //echo "<pre>";print_r($data['unique_types']);echo "</pre>";die;

        } else {
            $data['records'] = array();
            $data['recordss'] = array();
            $data['course'] = array();
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        }

        $tmpfname = FCPATH . 'uploads/example.xls';

        $excelReader = IOFactory::createReaderForFile($tmpfname);
        $data['objPHPExcel'] = $excelReader->load($tmpfname);

        return view('templates/export_excel_fallenrollmentreport', $data);
    }

    function enrollmentreport()
    {
        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_semester'] = $this->request->getPost('semester');

        if ($this->request->getPost()) {
            //  $data['records'] = $this->Report_model->fallenrollmentreport();

            $data['course'] = $this->Report_model->get_filter_course($this->request->getPost('semester'));
            $data['records'] = $this->Report_model->classFallSemesterReportByClass('F');
            $data['recordss'] = $this->Report_model->classFallSemesterReportByClasss('F');

            $data['m_records'] = $this->Report_model->classFallSemesterReportByClass('M');
            $data['m_recordss'] = $this->Report_model->classFallSemesterReportByClasss('M');

            //	echo "<pre>";print_r($data['m_recordss']);echo "<pre>";die;
            $data['all_records'] = $this->Report_model->classFallSemesterReportByClass();


            $data['m_unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['all_records']));


            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['all_records']));
            //	echo "<pre>";print_r($data['unique_types']);echo "</pre>";die;
            if (!empty($data['unique_types'])) {
                $data['enrolled_semester'] = $this->Report_model->enrolled_semester($data['unique_types']);
            } else {
                $data['enrolled_semester'] = array();
            }
            if (!empty($data['m_unique_types'])) {
                $data['m_enrolled_semester'] = $this->Report_model->enrolled_semester($data['m_unique_types']);
            } else {
                $data['m_enrolled_semester'] = array();
            }

            //	echo $this->db->last_query();
            //	echo "<pre>";print_r($this->request->getPost());echo "</pre>";die;


        } else {
            $data['records'] = array();
            $data['recordss'] = array();
            $data['course'] = array();
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        }
        $data['class'] = $this->Application_model->getAllClass();
        $data['semesters'] = $this->Report_model->getAllSemsterList();
        $data['content'] = 'backend/enrollmentreport';
        return view('backend/index', $data);
    }


    function export_excel_enrollmentreport()
    {
        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_semester'] = $this->request->getPost('semester');

        $data['start_program_date'] = '01-07-';
        $data['end_program_date'] = '30-06-';
        if ($this->request->getPost()) {
            //  $data['records'] = $this->Report_model->fallenrollmentreport();

            $data['course'] = $this->Report_model->get_filter_course($this->request->getPost('semester'));
            $data['records'] = $this->Report_model->classFallSemesterReportByClass('F');
            $data['recordss'] = $this->Report_model->classFallSemesterReportByClasss('F');

            $data['m_records'] = $this->Report_model->classFallSemesterReportByClass('M');
            $data['m_recordss'] = $this->Report_model->classFallSemesterReportByClasss('M');

            $data['all_records'] = $this->Report_model->classFallSemesterReportByClass();
            $data['m_unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['all_records']));


            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['all_records']));

            //	echo "<pre>";print_r($data['unique_types']);echo "</pre>";die;

            $data['enrolled_semester'] = $this->Report_model->enrolled_semester($data['unique_types']);

            //echo "<pre>";echo "</pre>";die;
            $data['m_enrolled_semester'] = $this->Report_model->enrolled_semester($data['m_unique_types']);

            if (!empty($data['unique_types'])) {
                $data['enrolled_semester'] = $this->Report_model->enrolled_semester($data['unique_types']);
            } else {
                $data['enrolled_semester'] = array();
            }
            if (!empty($data['m_unique_types'])) {
                $data['m_enrolled_semester'] = $this->Report_model->enrolled_semester($data['m_unique_types']);
            } else {
                $data['m_enrolled_semester'] = array();
            }
        } else {
            $data['records'] = array();
            $data['recordss'] = array();
            $data['course'] = array();
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        }

        $data['semesters'] = $this->Report_model->getAllSemsterList();

        $tmpfname = FCPATH . 'uploads/example.xls';
        $excelReader = IOFactory::createReaderForFile($tmpfname);
        $data['objPHPExcel'] = $excelReader->load($tmpfname);

        return view('templates/export_excel_enrollmentreport', $data);
    }

    public function export_pdf_enrollmentreport()
    {
        error_reporting(0);

        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_semester'] = $this->request->getPost('semester');

        $data['start_program_date'] = '1-07-';
        $data['end_program_date'] = '30-06-';
        $data['records'] = $this->Report_model->fallenrollmentreport('F');
        $data['m_records'] = $this->Report_model->fallenrollmentreport('M');

        $data['all_records'] = $this->Report_model->classFallSemesterReportByClass();
        $data['m_unique_types'] = array_unique(array_map(function ($elem) {
            return $elem['course_row_id'];
        }, $data['all_records']));

        $pdf = new Pdf('L', 'cm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/export_pdf_enrollmentreport', $data);

        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');

        $tagvs = ['div' => [0 => ['h' => 0, 'n' => 0], 1 => ['h' => 1, 'n' => 1]]];
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins(14, 26, 20);
        $pdf->SetHeaderMargin(10, 10, 10, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, [0, 0, 0], [255, 255, 255]);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->AddPage('L', 'MAKE-L');

        ob_end_clean(); // clear any output buffer before PDF rendering
        $pdf->writeHTML($html, true, false, true, false, '');

        // ✅ Force browser to download PDF instead of showing raw content
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('enrollment_report.pdf', 'I'); // I = inline view, D = download
        exit;
    }

    function filter_enrollmentreport()
    {
        $data['selected_program_start'] = $this->request->getPost('program_start');
        $data['selected_program_end'] = $this->request->getPost('program_end');
        $data['selected_semester'] = $this->request->getPost('semester');
        if ($this->request->getPost()) {
            $data['course'] = $this->Report_model->get_filter_course($this->request->getPost('semester'));
            $data['records'] = $this->Report_model->classFallSemesterReportByClass('F');
            $data['recordss'] = $this->Report_model->classFallSemesterReportByClasss('F');
            $data['m_records'] = $this->Report_model->classFallSemesterReportByClass('M');
            $data['m_recordss'] = $this->Report_model->classFallSemesterReportByClasss('M');
            $data['all_records'] = $this->Report_model->classFallSemesterReportByClass();
            $data['m_unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['all_records']));
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['all_records']));
            if (!empty($data['unique_types'])) {
                $data['enrolled_semester'] = $this->Report_model->enrolled_semester($data['unique_types']);
            } else {
                $data['enrolled_semester'] = array();
            }
            if (!empty($data['m_unique_types'])) {
                $data['m_enrolled_semester'] = $this->Report_model->enrolled_semester($data['m_unique_types']);
            } else {
                $data['m_enrolled_semester'] = array();
            }
        } else {
            $data['records'] = array();
            $data['recordss'] = array();
            $data['course'] = array();
            $data['unique_types'] = array_unique(array_map(function ($elem) {
                return $elem['course_row_id'];
            }, $data['records']));
        }
        $data['class']     = $this->Application_model->getAllClass();
        $data['semesters'] = $this->Report_model->getAllSemsterList();
        return view('templates/filter/filter_enrollmentreport', $data);
    }

    function course_report()
    {
        $data['records'] = $this->Report_model->course_report();
        $data['class'] = $this->Application_model->getAllClass();
        $data['semesters'] = $this->Report_model->getAllSemsterList();
        $data['content'] = 'backend/course_report';
        $data['data'] = $data;
        return view('backend/index', $data);
    }

    function filter_course_reports()
    {
        $data['records'] = $this->Report_model->course_report();
        return view('templates/filter/filter_course_reports', $data);
    }

    function get_contract_details_by_id()
    {
        if ($this->request->getPost('submit') == 'get_details') {
            $id = $this->request->getPost('id');
            $id =  encryptor('decrypt', $id);
            $data['edit_contract'] = $this->Users_model->getcontract($id);
            $data['team_name'] = $this->Users_model->getactiveteam();
            return view('templates/filter/edit_contract_detail', $data);
        }
    }

    function submitemploymentdata()
    {
        $post = $this->request->getPost();
        $response = array();
        $ID = $post['name_id'] != '' ? $post['name_id'] : '';

        if ($post['submit'] == 'name') {
            $rules = [
                'diver_license'       => 'permit_empty|trim',
                'diver_state'         => 'permit_empty|trim',
                'marital_status'      => 'required|trim',
                'veteran_status'      => 'permit_empty|trim',
                'medical_conditions'  => 'permit_empty|trim',
                'dietary_restrictions' => 'permit_empty|trim'
            ];
            $this->validation->setRules($rules);
            $form_validation = $this->validation->withRequest($this->request)->run();
            $post = $this->request->getPost();
            if ($form_validation == FALSE) {
                $errors = $this->validation->getErrors();
                $data['errors'] = $errors;
                if ($ID == '') {
                    $response['status'] = false;
                    $response['msg'] .= 'Contact Not Defined<br>';
                } else {
                    $response['status'] = false;
                    $response['msg'] .= $data['errors'] . "<br>";
                }
            } else {
                if (isset($post['submit'])) {

                    $param = array(
                        'ID' => $post['ID'],
                        'Name_id' => $post['name_id'],
                        'drivers_licence' => $post['diver_license'],
                        'marital_status' => $post['marital_status'],
                        'veteran_status' => $post['veteran_status'],
                        'drivers_licence_state' => $post['drivers_licence_state'],
                        'medical_conditions' => $post['medical_conditions'],
                        'dietary_restrictions' => $post['dietary_restrictions']
                    );
                    if ($_POST['ID'] == 0) {
                        $response = $this->Application_model->insertEmpData($param);
                    } elseif ($_POST['ID'] != 0) {
                        $param['ID'] = $post['ID'];
                        $response = $this->Application_model->updateEmpData($param);
                    }
                    if ($response['msg'] == "INSERTED" || $response['msg'] == "UPDATED") {
                        // Address Save
                        $response['msg'] .= "<br>";
                        $address_length = count($this->request->getPost('Street_Address'));

                        $validate_array = array();
                        $validate_array[] = $post['Contact_name'];
                        $validate_array[] = $post['Contact_number'];
                        $validate_array[] = $post['relationship'];
                        $validate_array[] = $post['Street_Address'];
                        $validate_array[] = $post['City'];
                        $validate_array[] = $post['State'];
                        $validate_array[] = $post['Country'];
                        $validate_array[] = $post['Postal_Code'];

                        $res = empty_search($validate_array);
                        if ($res['save'] == 1 && $res['status'] == 1) {
                            for ($i = 1; $i <= $address_length; $i++) {
                                $address_param['Address_RowID'] = $post['Address_RowID'][$i];
                                $address_param['contact_name'] = $post['Contact_name'][$i];
                                $address_param['contact_number'] = $post['Contact_number'][$i];
                                $address_param['relationship'] = $post['relationship'][$i];
                                $address_param['Street_Address'] = $post['Street_Address'][$i];
                                $address_param['City'] = $post['City'][$i];
                                $address_param['State'] = $post['State'][$i];
                                $address_param['Country'] = $post['Country'][$i];
                                $address_param['Postal_Code'] = $post['Postal_Code'][$i];
                                $address_param['AddressID'] = $ID;
                                $address_param['Active'] = isset($post['Active'][$i]) ? $post['Active'][$i] : 0;
                                //echo "<pre>"; print_r($address_param); die;
                                if ($address_param['Address_RowID'] == '') {
                                    unset($address_param['Address_RowID']);
                                    $response_add = $this->Application_model->insertEmergencyAddInfo($address_param);
                                } elseif ($ID != 0) {
                                    $response_add = $this->Application_model->updateEmergencyAddInfo($address_param);
                                }

                                if (!empty($response_add)) {
                                    if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
                                        $response['status'] = true;
                                        $response['msg'] = $response_add['msg'] . '<br>';
                                    } elseif ($response_add['msg'] == 'Record Already Exists') {
                                        $response['status'] = false;
                                        $response['msg'] .= $response_add['msg'] . '<br>';
                                    } else {
                                        $response['status'] = false;
                                        $response['msg'] .= 'Address not saved/update<br>';
                                    }
                                } else {
                                    $response['status'] = false;
                                    $response['msg'] .= 'Address not saved/update<br>';
                                }
                            }
                        } elseif ($res['save'] == 1 && $res['status'] == 2) {
                            $response['status'] = false;
                            $response['msg'] .= 'Please fill all mandatory details in address.';
                        }
                    } else {
                        $response['status'] = false;
                        $response['msg'] .= 'There is some Error Occurred in Submission. Please try later.';
                    }
                    echo json_encode($response);
                }
            }
        } elseif ($post['submit'] == 'address') {

            $response = array();

            $rules = [
                'Contact_name'   => 'required|trim',
                'Contact_number' => 'permit_empty|trim',
                'relationship'   => 'required|trim',
                'State'          => 'permit_empty|trim',
                'City'           => 'permit_empty|trim',
                'Country'        => 'required|trim'
            ];

            $this->validation->setRules($rules);
            $form_validation = $this->validation->withRequest($this->request)->run();
            $post = $this->request->getPost();

            if ($form_validation == FALSE) {
                $data['errors'] = validation_errors();
                session()->setFlashdata('post', $post);
                session()->setFlashdata('msg', '<div class="alert alert-danger">' . $data['errors'] . '</div>');

                if ($ID == '') {
                    $response['status'] = false;
                    $response['msg'] .= 'Contact Id Empty';
                } else {
                    $response['status'] = false;
                    $response['msg'] .= $data['errors'];
                }
            } else {
                $address_length = sizeof($this->request->getPost('Street_Address'));
                for ($i = 1; $i <= $address_length; $i++) {

                    $address_param['Address_RowID'] = $post['Address_RowID'][$i];
                    $address_param['Street_Address'] = $post['Street_Address'][$i];
                    $address_param['contact_name'] = $post['Contact_name'][$i];
                    $address_param['contact_number'] = $post['Contact_number'][$i];
                    $address_param['relationship'] = $post['relationship'][$i];
                    $address_param['Postal_Code'] = $post['Postal_Code'][$i];
                    $address_param['Country'] = $post['Country'][$i];
                    $address_param['City'] = $post['City'][$i];
                    $address_param['State'] = $post['State'][$i];
                    $address_param['AddressID'] = $ID;
                    $address_param['Active'] = isset($post['Active'][$i]) ? $post['Active'][$i] : 0;
                    if ($address_param['Address_RowID'] == '') {
                        unset($address_param['Address_RowID']);
                        $response_add = $this->Application_model->insertEmergencyAddInfo($address_param);
                    } elseif ($ID != '') {
                        $response_add = $this->Application_model->updateEmergencyAddInfo($address_param);
                    }

                    if (!empty($response_add)) {
                        if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
                            $response['status'] = true;
                            $response['msg'] .= 'Address Updated';
                        } elseif ($response_add['msg'] == 'Record Already Exists') {
                            $response['status'] = false;
                            $response['msg'] .= $response_add['msg'];
                        } else {
                            $response['status'] = false;
                            $response['msg'] .= 'Address not saved/update';
                        }
                    } else {
                        $response['status'] = false;
                        $response['msg'] .= 'Address not saved/update';
                    }
                }
                $response['status'] = true;
                //$response['msg'] .= $response['msg'];
            }
            echo json_encode($response);
        }
    }

    public function employmentListingSubmit()
    {

        $estTime = (new DateTime('America/New_York'))->format('Y-m-d h:i:s');

        $employement['name_id'] = $_POST['facultyEmployeeIDforms'];
        $employement['Title'] = $_POST['Title'];
        $employement['BeginDate'] = date('Y-m-d H:i:s', strtotime($_POST['BeginDate']));
        $employement['EndDate'] = date('Y-m-d H:i:s', strtotime($_POST['EndDate']));
        $employement['Days'] = $_POST['Days'];
        $employement['Hours'] = $_POST['Hours'];
        $employement['DailyRate'] = $_POST['DailyRate'];
        $employement['Compensation'] = $_POST['Compensation'];
        $employement['Full_Part'] = $_POST['FullPart'];
        $employement['Salary_Hourly'] = $_POST['SalaryHourly'];
        $employement['Health_Insurance'] = $_POST['HealthInsurance'];
        $employement['Dental'] = $_POST['Dental'];
        $employement['MedFlex'] = $_POST['MedFlex'];
        $employement['MedFlexDeduction'] = $_POST['MedFlexDeduction'];
        $employement['Dependent'] = $_POST['Dependent'];
        $employement['DependentDeduction'] = $_POST['DependentDeduction'];
        $employement['TIAA'] = $_POST['TIAA'];
        $employement['TIAA_Deduction'] = $_POST['TIAADeduction'];
        $employement['Days_Required_HQ'] = $_POST['DaysRequiredHQ'];
        $employement['Travel_Note'] = $_POST['TravelNote'];
        $employement['Comments'] = $_POST['Comments'];
        $employement['Organization'] = $_POST['Organization'];
        $employement['Termination'] = $_POST['TerminationDate'];
        $employement['Type_of_Termination'] = $_POST['TypeofTermination'];
        $employement['created_date'] = $estTime;
        $employement['created_by'] = session()->get('NAME_ID');
        $employement['modified_date'] = '';
        $employement['modifiedby'] = '';
        $employement['created_ip'] = actual_ip();

        //echo '<pre>'; print_r($employement); die;

        //echo '<pre>'; print_r($employement);

        $result = $this->Application_model->submitEmployeementRecord($employement);

        if ($result['msg'] == 'INSERTED') {

            $response_array['msg'] = 'INSERTED';
            $response_array['last_id'] = encryptor('encrypt', $result['last_insert_id']);
        } else {

            $response_array['msg'] = 'Something went wrong.';
        }
        echo json_encode($response_array, JSON_UNESCAPED_SLASHES);
    }

    public function employmentListingUpdate()
    {

        $estTime = (new DateTime('America/New_York'))->format('Y-m-d h:i:s');

        $employementIDDDD = $_POST['EmploymentDataID'];
        $employement['name_id'] = $_POST['facultyEmployeeID'];
        $employement['Title'] = $_POST['Title'];
        $employement['BeginDate'] = date('Y-m-d H:i:s', strtotime($_POST['BeginDate']));
        $employement['EndDate'] = date('Y-m-d H:i:s', strtotime($_POST['EndDate']));
        $employement['Days'] = $_POST['Days'];
        $employement['Hours'] = $_POST['Hours'];
        $employement['DailyRate'] = $_POST['DailyRate'];
        $employement['Compensation'] = $_POST['Compensation'];
        $employement['Full_Part'] = $_POST['FullPart'];
        $employement['Salary_Hourly'] = $_POST['SalaryHourly'];
        $employement['Health_Insurance'] = $_POST['HealthInsurance'];
        $employement['Dental'] = $_POST['Dental'];
        $employement['MedFlex'] = $_POST['MedFlex'];
        $employement['MedFlexDeduction'] = $_POST['MedFlexDeduction'];
        $employement['Dependent'] = $_POST['Dependent'];
        $employement['DependentDeduction'] = $_POST['DependentDeduction'];
        $employement['TIAA'] = $_POST['TIAA'];
        $employement['TIAA_Deduction'] = $_POST['TIAADeduction'];
        $employement['Days_Required_HQ'] = $_POST['DaysRequiredHQ'];
        $employement['Travel_Note'] = $_POST['TravelNote'];
        $employement['Comments'] = $_POST['Comments'];
        $employement['Organization'] = $_POST['Organization'];
        $employement['Termination'] = $_POST['TerminationDate'];
        $employement['Type_of_Termination'] = $_POST['TypeofTermination'];
        $employement['created_date'] = $estTime;
        $employement['created_by'] = session()->get('NAME_ID');
        $employement['modified_date'] = '';
        $employement['modifiedby'] = '';
        $employement['created_ip'] = actual_ip();

        //echo '<pre>'; print_r($employement); die;

        $result = $this->Application_model->updateEmployeementRecord($employement, $employementIDDDD);
        if ($result['msg'] == 'UPDATED') {

            $response_array['msg'] = 'UPDATED';
            $response_array['last_id'] = encryptor('encrypt', $result['last_insert_id']);
        } else {

            $response_array['msg'] = 'Something went wrong.';
        }
        echo json_encode($response_array, JSON_UNESCAPED_SLASHES);
    }

    public function employmentListingDelete()
    {
        $employementIDDDD = $_POST['EmploymentDataID'];


        $result = $this->Application_model->DeleteEmployeementRecord($employementIDDDD);
        if ($result['msg'] == 'DELETED') {

            $response_array['msg'] = 'DELETED';
            $response_array['last_id'] = encryptor('encrypt', $result['last_insert_id']);
        } else {

            $response_array['msg'] = 'Something went wrong.';
        }
        echo json_encode($response_array, JSON_UNESCAPED_SLASHES);
    }

    function timeReports()
    {
        $profiles = session()->get('profiles') ?? [];
        if (session()->get('role') == 1 || in_array('13', session()->get('profiles'))) {
            if (in_array('13', $profiles) && session()->get('role') != 1) {
                $timesheet_menu = session()->get('timesheet_menu');
                $menu_status = check_menu_permission($timesheet_menu, '46');
                if (!$menu_status) {
                    redirect('My401/');
                }
            }
            $data['users']    = $this->Timesheet_model->get_time_report_users();
            $data['category'] = $this->Timesheet_model->get_time_report_category();

            $data['tab_part_one'] = "";
            $data['tab_part_percentage'] = "style='display:none'";
            $data['select_current_month'] = date('m/Y');
            $data['selected_start_date'] = date('Y-m-01');
            $data['selected_end_date']   = date('Y-m-t');
            $data['content'] = 'backend/timeReports';

            $data['data'] = $data;
            return view('backend/index', $data);
        } else {
            return view('401.php');
            //die("Please Login with Adminstrative");
        }
    }

    function filter_timeReports()
    {
        if (session()->get('role') == 1) {
            $data['users']    = $this->Timesheet_model->get_time_report_users();
            $data['category'] = $this->Timesheet_model->get_time_report_category();
            $data['selected_start_date'] = $this->request->getPost('start_date');
            $data['selected_end_date']   = $this->request->getPost('end_date');
            $data['tab_part_one'] = "";
            $data['tab_part_percentage'] = "style='display:none'";
            if ($this->request->getPost('tab_no') == 2) {
                $data['tab_part_one'] = "style='display:none;'";
                $data['tab_part_percentage'] = "";
            }
            return view('templates/filter/filter_timeReports', $data);
        } else {
            return view('401.php');
        }
    }

    function export_excel_time_reports()
    {
        $tmpfname = FCPATH . 'uploads/example.xls';
        $excelReader = IOFactory::createReaderForFile($tmpfname);
        $data['objPHPExcel'] = $excelReader->load($tmpfname);
        $data['users']    = $this->Timesheet_model->get_time_report_users();
        $data['category'] = $this->Timesheet_model->get_time_report_category();
        $data['selected_start_date'] = $this->request->getPost('start_date');
        $data['selected_end_date']   = $this->request->getPost('end_date');
        return view('templates/export_excel_timeReports', $data);
    }

    function submitcontractdata()
    {
        if ($this->request->getPost('submit') == 'name') {
            $id = $this->request->getPost('id');
            $empid = $this->request->getPost('empid');
            $teamid = $this->request->getPost('team_name');
            $contract_begin_date = date('Y-m-d', strtotime($this->request->getPost('contract_begin_date')));
            $contract_end_date = date('Y-m-d', strtotime($this->request->getPost('contract_end_date')));
            $hours_to_work = $this->request->getPost('hours_to_work');
            $CarriedOverHours = $this->request->getPost('CarriedOverHours');
            $education = $this->request->getPost('education');
            $daily_rate = $this->request->getPost('daily_rate');
            $contract_1099 = $this->request->getPost('contract_1099');
            $adjunct_fee = $this->request->getPost('adjunct_fee');
            $contract = array();
            $contract['id'] = $id;
            $contract['empid'] = $empid;
            $contract['teamid'] = $teamid;
            $contract['contract_begin_date'] = $contract_begin_date;
            $contract['contract_end_date'] = $contract_end_date;
            $contract['hours_to_work'] = $hours_to_work;
            $contract['education'] = $education;
            $contract['CarriedOverHours'] = $CarriedOverHours;
            $contract['daily_rate'] = $daily_rate;
            $contract['contract_1099'] = $contract_1099;
            $contract['adjunct_fee']    = $adjunct_fee;
            $contract['early_termination_date'] = '';
            if ($this->request->getPost('early_termination') != '') {
                $contract['early_termination_date']    = date('Y-m-d', strtotime($this->request->getPost('early_termination')));
            }
            $contract['termination_initiate_by']    = $this->request->getPost('termination_initiate');
            $contract['employee_title']    = $this->request->getPost('title');
            if ($id != '') {
                $contract['modifiedby'] = $_SESSION['USER_ID'];
                $contract['modifieddate'] = date('Y-m-d h:i:s');
                $this->Users_model->updateContractLog($id);
                $data = $this->Users_model->getContractAttendence($id);
                $post = $this->request->getPost();
                if ($data) {
                    session()->setFlashdata('status', '2');
                    session()->setFlashdata('post', $post); //for post the data auto filled 
                    session()->setFlashdata('msg', 'Cannot change rates, as this contract has active attendance records. Please contact administrator.');
                    return;
                }
                $result = $this->Users_model->updateContract($contract);
                $this->Users_model->update_group_emp($id);
            } else {
                $contract['createdby'] = $_SESSION['USER_ID'];
                $contract['createddate'] = date('Y-m-d h:i:s');
                $result = $this->Users_model->insertContract($contract);
                if (isset($result['last_id'])) {
                    $this->Users_model->update_group_emp($result['last_id']);
                }
            }

            if ($result['msg'] == 'INSERTED') {
                session()->setFlashdata('status', '1');
                session()->setFlashdata('msg', 'Record Inserted Successfully');
                echo 'Record Inserted Successfully';
            } elseif ($result['msg'] == 'UPDATED') {
                session()->setFlashdata('status', '1');
                session()->setFlashdata('msg', 'Record Updated Successfully');
                echo 'Record Updated Successfully';
            } elseif ($result['msg'] == 'CONTRACT OVERLAP') {
                session()->setFlashdata('post', $post); //for post the data auto filled 
                session()->setFlashdata('status', '2');
                session()->setFlashdata('msg', 'This user have already one contact running between these dates.');
                echo 'This user have already one contact running between these dates.';
            } else {
                session()->setFlashdata('status', '2');
                session()->setFlashdata('post', $post); //for post the data auto filled 
                session()->setFlashdata('msg', 'There is some Error Occurred in Submission. Please try later.');
                echo 'There is some Error Occurred in Submission. Please try later.';
            }
        }
    }

    function get_tab_page()
    {
        if ($this->request->getPost('submit') == 'refresh_page') {
            $facultyEmployeeID = $_POST['facultyEmployeeID'];
            $infos = $this->Application_model->getApplicantByID($facultyEmployeeID);
            $data['infos'] = !empty($infos) ? $infos[0] : array();

            //$data['facultystaf']=$this->Application_model->getAllFacultyStaffDetails();    
            //End Montly Report 	
            $data['states'] = $this->SCBV_model->get_all_states();
            $data['country'] = $this->SCBV_model->get_country();
            $data['infos']['ID'] = $facultyEmployeeID;
            $data['team_name'] = $this->Users_model->getactiveteam();
            $data['contract'] = $this->Users_model->getcontract();
            $data['address_type'] = $this->Application_model->get_address_type();
            //$data['userDetails'] = $this->Users_model->getStudentName($facultyEmployeeID);
            $data['phonetypes'] = $this->Application_model->get_all_phone_type();
            $data['allnumbers'] = $this->Application_model->get_all_user_number($facultyEmployeeID);
            return view('backend/overviewEmployeedata', $data);
        }
    }

    function assign_remove_category()
    {
        if ($this->request->getPost('submit') == 'name') {
            $this->Users_model->add_remove_categoy();
            $response['msg'] = 'Record Inserted Successfully';
            echo json_encode($response);
        }
    }

    function filter_another_timesheet()
    {
        if ($this->request->getPost('submit') == 'name') {
            $facultyEmployeeID = $this->request->getPost('employee_id');
            $data['contractor_details'] = $this->Timesheet_model->getAllContractTransaction($facultyEmployeeID);

            //echo "<pre>";print_r($data);echo "</pre>";die;
            $data['facultyEmployeeID'] = $facultyEmployeeID;
            return view('templates/filter/filter_another_transaction', $data);
        }
    }

    function exportContactDetails()
    {
        //$data['all_user'] = $this->Report_model->getContactUser();
        $data['all_user'] = $this->Report_model->get_export_contact_result();
        //echo "<pre>";print_r($data['all_user']);echo "</pre>";die();
        $data['content'] = 'templates/export_excel_Contact_Details';
        //$this->load->view('backend/index', $data);
        /*$this->load->library('Excel');
        $tmpfname = "example.xls";
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        $data['objPHPExcel'] = $excelReader->load($tmpfname);*/
        return view('backend/index', $data);
        //$this->load->view('templates/export_excel_Contact_Details', $data);
    }

    public function addDonorMailingList($StateID = '')
    {

        //$data['records'] = $this->Report_model->getApplicantDonorMailReport();
        $data['records'] = $this->Report_model->getApplicantDonorMailReport_Neww();
        $data['content'] = 'backend/addDonorMailingList';
        //echo "<pre>"; print_r($data['records']); exit;
        return view('backend/index', $data);
    }

    function getDonationReportExcel()
    {
        $begin_date = $this->request->getPost('excel_begin_date');
        $end_date   = $this->request->getPost('excel_end_date');
        if ($begin_date == "") {
            $begin_date = '06-08-1970';
        }
        if ($end_date == "") {
            date_default_timezone_set('America/New_York');
            $end_date = date('d-m-Y');
        }
        $data = array();
        $data_array = array();
        $data_array['begin_date'] = $begin_date;
        $data_array['end_date'] = $end_date;
        $data['report_date'] = $data_array;
        $data['records'] = $this->Report_model->getmonthlydonationsExcelreport_without_tuition_credit_refund();

        $data['content'] = 'backend/getDonationReportExcel';
        return view('backend/index', $data);
    }

    public function getemploymentListingDetails()
    {
        if (!isset($_POST['facultyEmployeeID'])) {
            return redirect()->to('admin/Reports/employmentListing');
            die();
        }
        $facultyEmployeeID = $_POST['facultyEmployeeID'];
        $infos = $this->Application_model->getApplicantByID($facultyEmployeeID);
        $data['infos'] = !empty($infos) ? $infos[0] : array();
        //$data['facultystaf']=$this->Application_model->getAllFacultyStaffDetails();
        $data['facultystaf'] = $this->Report_model->Get_faculty_staff();
        $data['facultystafdetails'] = $this->Application_model->getFacultyStaffDetails($facultyEmployeeID);
        $data['result'] = $this->Application_model->getEmployeementRecord($facultyEmployeeID);
        $data['facultyprofileimage'] = $this->Application_model->getEmployeementProfileImage($facultyEmployeeID);
        $data['totalrecord'] = count($data['result']);
        $data['facultystaffid'] = $facultyEmployeeID;
        $data['facultystaffid'] = $facultyEmployeeID;
        $data['employmentrecord'] = $this->Application_model->getEmploymentRecord();
        //echo "<pre>";print_r($data['employmentrecord']);echo "</pre>";die;
        $data['empdetails'] = $this->Timesheet_model->getEmployeeNameById($facultyEmployeeID);
        $data['last_lock'] = $this->Timesheet_model->getSingleContractTransaction($facultyEmployeeID);
        $data['contractor_details'] = $this->Timesheet_model->getAllContractTransaction($facultyEmployeeID);

        //echo $this->db->last_query();die;
        // montly report
        $selected_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
        $selected_month = isset($_POST['month']) ? $_POST['month'] : date("m");
        $data['selected_year'] = $selected_year;
        $data['selected_month'] = $selected_month;
        $application_id = $facultyEmployeeID;
        //$data['records_category'] = $this->Timesheet_model->getCategoryactive($application_id);
        $data['records_categoryy'] = $this->Timesheet_model->getCategory($facultyEmployeeID);
        $data['records'] = $this->Report_model->getEmpDailyAttendance($facultyEmployeeID, $selected_month, $selected_year);
        $uniqecat = array_unique(array_column($data['records'], 'category_id'));
        $data['user_profile'] = $this->Application_model->get_faculty_profile($facultyEmployeeID);
        $category = array();
        foreach ($data['records_categoryy'] as $key => $value) {
            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }
        $data['tab_type'] = $this->request->getPost('tab_type');
        $data['records_category'] = $category;
        $data['records_sum_cat'] = $this->Report_model->getTotalforMonthlyReportByCategry($facultyEmployeeID, $selected_year, $selected_month);
        $data['records_sum_day'] = $this->Report_model->getTotalforMonthlyReportByDay($facultyEmployeeID, $selected_year, $selected_month);
        $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($facultyEmployeeID, $selected_year, $selected_month);
        $data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear($facultyEmployeeID, $selected_month, $selected_year);
        $findate = "28-" . $selected_month . "-" . $selected_year;
        $finyear = getfinancialyear_june($findate);
        $ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($finyear);
        $result = $ContractorDetails;
        $sum_hours = $sum_mins = 0;
        $cary_sum_hours = $cary_sum_mins = 0;
        foreach ($result as $key => $value) {
            $sum_hours += $value['hours_to_work'];
            $cary_sum_hours += $value['CarriedOverHours'];
        }
        $data['Sum_hour_contract'] = $sum_hours;
        $data['Sum_mins_contract'] = $sum_mins;
        $data['cary_Sum_hour_contract'] = $cary_sum_hours;
        $data['cary_Sum_mins_contract'] = $cary_sum_mins;
        //End Montly Report 	
        $data['employee'] = $this->Application_model->getEmployeeRecord($facultyEmployeeID);
        $data['states'] = $this->SCBV_model->get_all_states();
        $data['country'] = $this->SCBV_model->get_country();
        $data['infos']['ID'] = $facultyEmployeeID;
        $data['team_name'] = $this->Users_model->getactiveteam();
        $data['contract'] = $this->Users_model->getcontract();
        $data['address_type'] = $this->Application_model->get_address_type();
        //$data['userDetails'] = $this->Users_model->getStudentName($facultyEmployeeID);
        $data['phonetypes'] = $this->Application_model->get_all_phone_type();
        $data['allnumbers'] = $this->Application_model->get_all_user_number($facultyEmployeeID);
        //Documents
        $data['documenttypes'] = $this->Application_model->get_document_type('1');
        $data['form_id'] = $facultyEmployeeID;
        $data['contract_assign'] = $this->Users_model->getcontract2();
        $data['page_url'] = 'Reports/getemploymentListingDetails';
        $data['content']  = 'backend/viewEmployeeListingmain';
        $data['address_type_js'] = '';
        if (!empty($data['address_type'])) {
            $data['address_type_js'] = json_encode($data['address_type']);
        }
        $data['data'] = $data;
        //echo "<pre>";print_r($data['last_lock']);die;
        return view('backend/index', $data);
    }

    public function addVIPMailingList($StateID = '')
    {

        $data['records'] = $this->Report_model->getApplicantListMailReport();

        //echo "<pre>"; print_r($data['records']); die(); 
        $data['content'] = 'backend/addVIPMailingList';

        return view('backend/index', $data);
    }

    public function StudentPassportListings($class = '')
    {
        if ($this->request->getPost()) {
            $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
            $data['records'] = $this->Report_model->getPassportYearwiseReport($class);
            //echo "<pre>"; print_r($data['records']); die();
        } else {
            $data['records'] = array();
        }
        $data['selectedclass'] = $class;
        $data['class'] = $this->Application_model->getAllClass();
        $data['content'] = 'backend/viewPassportListing';
        $data['data'] = $data;
        return view('backend/index', $data);
    }

    public function adminTimeReport($class = '')
    {
        if (session()->get('role') != '1' && in_array('13', session()->get('profiles'))) {
            $timesheet_menu = session()->get('timesheet_menu');
            $menu_status = check_menu_permission($timesheet_menu, '39');
            if (!$menu_status) {
                redirect('My401/');
            }
        }

        $application_id = session()->get('NAME_ID');

        $data['facultystaff'] = $this->Report_model->Get_faculty_staff();
        //print_r(expression)
        if ($this->request->getPost()) {
            $BeginDate = $this->request->getPost('BeginDate') != '' ? $this->request->getPost('BeginDate') : '';
            $EndDate = $this->request->getPost('EndDate') != '' ? $this->request->getPost('EndDate') : '';
            $User_option = $this->request->getPost('User_option') != '' ? $this->request->getPost('User_option') : '';
            $Team_option = $this->request->getPost('Team_option') != '' ? $this->request->getPost('Team_option') : '';
            $data['BeginDate'] = test_input($BeginDate);
            $data['EndDate'] = test_input($EndDate);
            $data['User_option'] = test_input($User_option);
            $data['Team_option'] = test_input($Team_option);
        } else {

            $BeginDate = date("Y-m-d");
            $EndDate = date("Y-m-d");
            $data['BeginDate'] = date("m/d/Y");
            $data['EndDate'] = date("m/d/Y");
            $User_option = "0";
            $data['User_option'] = $User_option;
            $Team_option = "0";
            $data['Team_option'] = $Team_option;
        }


        $data['records_sum_cat_hr'] = $this->Report_model->getTotalforAdmin_TimeReport_catwise($BeginDate, $EndDate, $User_option, $Team_option);
        $data['records_sum_emp_hr'] = $this->Report_model->getTotalforAdmin_TimeReport_empwise($BeginDate, $EndDate);
        $data['records_sum'] = $this->Report_model->getTotalforAdminReport($BeginDate, $EndDate, $User_option, $Team_option);
        $data['team_name'] = $this->Users_model->getteam();
        $data['records'] = $this->Report_model->getEmpDailyAttendance_Byemp($application_id, $BeginDate, $EndDate, $User_option, $Team_option);
        //echo "<pre>"; print_r($data); exit;
        //echo "<pre>"; print_r($data['records_sum_emp_hr']); die;
        $records_categoryy = $this->Timesheet_model->getSubCategoryactiveonly();
        $finrecord = [];
        $records_category = [];
        foreach ($data['records'] as  $value) {
            if (!($value['t_minutes'] == '0' && $value['t_hours'] == '0')) {
                $finrecord[] = $value['category_id'];
            }
        }
        $uni_finecat = array_unique($finrecord);
        foreach ($records_categoryy as   $valuee) {
            if (in_array($valuee['id'], $uni_finecat)) {
                $records_category[] = $valuee;
            }
        }

        $data['records_category'] = $records_category;
        $data['records_categoryy'] = $this->Timesheet_model->getSubCategoryactiveonly();
        //echo "<pre>"; print_r($data['records_category']);print_r($data['records']); exit;
        //echo "<pre>"; print_r($finrecord); print_r($data['records']); exit;

        $data['catcount'] = count($data['records_category']);
        $data['catcountt'] = count($data['records_categoryy']);

        $data['uni_empid'] = array_values(array_column($data['records'], null, 'empid'));
        $data['content'] = 'backend/admin_time_report';
        $data['data'] = $data;
        return view('backend/index', $data);
    }

    public function filterAdminTimeReport($class = '')
    {
        if ($this->request->getPost('submit') == 'filter') {
            $application_id = session()->get('NAME_ID');
            $BeginDate = $this->request->getPost('BeginDate') != '' ? $this->request->getPost('BeginDate') : '';
            $EndDate = $this->request->getPost('EndDate') != '' ? $this->request->getPost('EndDate') : '';
            $User_option = $this->request->getPost('User_option') != '' ? $this->request->getPost('User_option') : '';
            $Team_option = $this->request->getPost('Team_option') != '' ? $this->request->getPost('Team_option') : '';
            $data['BeginDate'] = test_input($BeginDate);
            $data['EndDate'] = test_input($EndDate);
            $data['User_option'] = test_input($User_option);
            $data['Team_option'] = test_input($Team_option);

            $data['records_sum_cat_hr'] = $this->Report_model->getTotalforAdmin_TimeReport_catwise($BeginDate, $EndDate, $User_option, $Team_option);
            $data['records_sum_emp_hr'] = $this->Report_model->getTotalforAdmin_TimeReport_empwise($BeginDate, $EndDate);
            $data['records_sum'] = $this->Report_model->getTotalforAdminReport($BeginDate, $EndDate, $User_option, $Team_option);
            $data['team_name'] = $this->Users_model->getteam();
            $data['records'] = $this->Report_model->getEmpDailyAttendance_Byemp($application_id, $BeginDate, $EndDate, $User_option, $Team_option);
            $records_categoryy = $this->Timesheet_model->getSubCategoryactiveonly();
            $finrecord = [];
            $records_category = [];
            foreach ($data['records'] as  $value) {
                if (!($value['t_minutes'] == '0' && $value['t_hours'] == '0')) {
                    $finrecord[] = $value['category_id'];
                }
            }
            $uni_finecat = array_unique($finrecord);
            foreach ($records_categoryy as   $valuee) {
                if (in_array($valuee['id'], $uni_finecat)) {
                    $records_category[] = $valuee;
                }
            }
            $data['records_category'] = $records_category;
            $data['records_categoryy'] = $this->Timesheet_model->getSubCategoryactiveonly();
            $data['catcount'] = count($data['records_category']);
            $data['catcountt'] = count($data['records_categoryy']);
            $data['uni_empid'] = array_values(array_column($data['records'], null, 'empid'));
            return view('templates/filter/filter_admin_time_report', $data);
        }
    }

    public function AdminLockedReport($month = '', $year = '')
    {
        if (session()->get('role') != '1' && in_array('13', session()->get('profiles'))) {
            $timesheet_menu = session()->get('timesheet_menu');
            $menu_status = check_menu_permission($timesheet_menu, '40');
            if (!$menu_status) {
                redirect('My401/');
            }
        }
        //echo "<pre>"; print_r($_POST); die;

        if ($month != '') {
            $selected_month = $month;
        } else {
            $selected_month = isset($_POST['month']) ? $_POST['month'] : date("m");
        }
        if ($year != '') {
            $selected_year = $year;
        } else {
            $selected_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
        }


        $data['selected_year'] = $selected_year;
        $data['selected_month'] = $selected_month;
        $empid = isset($_POST['empid']) ? $_POST['empid'] : '';

        //echo "<pre>";	print_r($_POST); exit;

        if (isset($_POST['empid'])) {
            $emp_id = encryptor('decrypt', $empid);

            $data['emp_record'] = $this->Report_model->getlockAttendance_emp($selected_year, $selected_month, $emp_id);



            $data['employ_id'] = $emp_id;
            $data['facultystaff_unlock'] = $this->Report_model->Get_not_faculty_staff($emp_id);
            //echo "<pre>";	print_r($data['emp_record']); exit;
        }

        $application_id = session()->get('NAME_ID');

        $data['facultystaff'] = $this->Report_model->Get_not_faculty_staff();

        $data['contractstaff'] = $this->Report_model->Get_staff_of_contract1($selected_year, $selected_month);

        $data['records'] = $this->Report_model->getlockEmpAttendance($selected_year, $selected_month);


        $data['records_last'] = $this->Report_model->gelasttlockEmpAttendance($selected_year, $selected_month);



        /* echo "<pre>";
 		print_r($data['contractstaff']); 
 		exit;*/


        foreach ($data['contractstaff'] as $key => $value) {
            $rec[] = $value['empid'];
        }
        foreach ($data['facultystaff'] as $key => $valuee) {


            if (in_array($valuee['ID'], $rec)) {


                $recc_staff[] = $valuee;
            }
        }
        $data['recc_staff'] = $recc_staff;
        $data['content'] = 'backend/admin_locked_report';
        return view('backend/index', $data);
    }

    public function Update_lock()
    {


        $empid = isset($_POST['employ_id']) ? $_POST['employ_id'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : date("Y");

        if (!is_array($date) || empty($date)) {
            // No dates selected, handle the error gracefully
            return redirect()->back()->with('error', 'No dates were provided.');
        }

        //echo "<pre>";print_r($date);print_r($empid); exit;
        $time = strtotime($date[0]);
        $month = date("m", $time);
        $year = date("Y", $time);
        //echo "<pre>";print_r($month);print_r($year); exit;
        foreach ($_POST['date'] as  $value) {

            $status = $this->Report_model->Update_Lock_timesheet($value, $empid);
        }

        return redirect()->to('admin/Reports/AdminLockedReport/' . $month . '/' . $year);
    }


    public function Update_lock_ajax()
    { // update lock using ajax
        $empid = isset($_POST['empid']) ? $_POST['empid'] : '';
        $date = isset($_POST['new_date_format']) ? $_POST['new_date_format'] : date("Y");
        $month = $_POST['month'];
        $year = $_POST['year'];
        $status = $this->Report_model->Update_Lock_timesheet($_POST['new_date_format'], $empid);
        if ($this->Report_model->Update_Lock_timesheet($_POST['new_date_format'], $empid)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function adminMonthlyReport($class = '')
    {
        if (session()->get('role') != '1' && in_array('13', session()->get('profiles'))) {
            $timesheet_menu = session()->get('timesheet_menu');
            $menu_status = check_menu_permission($timesheet_menu, '44');
            if (!$menu_status) {
                redirect('My401/');
            }
        }
        $selected_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
        $selected_month = isset($_POST['month']) ? $_POST['month'] : date("m");
        $User_option = $this->request->getPost('User_option') != '' ? $this->request->getPost('User_option') : ''; // Apoorv 6-jul-2020

        $data['selected_year'] = $selected_year;
        $data['selected_month'] = $selected_month;
        // Apoorv 6/7/2020
        $application_id = '';
        if ($User_option != 0  && $User_option != '') {
            $application_id = $User_option;
        } else {
            $application_id = session()->get('NAME_ID');
        }


        $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);
        $data['records'] = $this->Report_model->getEmpDailyAttendance($application_id, $selected_month, $selected_year);
        // echo "<pre>";  print_r($data['records']); exit;
        $uniqecat = array_unique(array_column($data['records'], 'category_id'));
        //print_r(array_unique(array_column($data['records'], 'category_id'))); 
        //print_r($data['records']); exit; 
        $category = array();
        foreach ($data['records_categoryy'] as $key => $value) {
            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }

        $data['records_category'] = $category;
        $data['records_sum_cat'] = $this->Report_model->getTotalforMonthlyReportByCategry($application_id, $selected_year, $selected_month);
        $data['records_sum_day'] = $this->Report_model->getTotalforMonthlyReportByDay($application_id, $selected_year, $selected_month);
        $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($application_id, $selected_year, $selected_month);
        $data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear($application_id, $selected_month, $selected_year);

        $data['facultystaff'] = $this->Report_model->Get_contrcat_attendance_user();

        $data['User_option'] = test_input($User_option);
        $data['User_option_name'] = $this->Report_model->get_user_option_name($User_option); // Apoorv 
        $findate = "28-" . $selected_month . "-" . $selected_year;
        $finyear = getfinancialyear_june($findate);

        $ContractorDetails = $this->Timesheet_model->getActiveAdminContractorDetailsFisical($finyear);
        $result = $ContractorDetails;
        $carriedDetails = $this->Timesheet_model->carriedDetails($finyear);
        $sum_hours = $sum_mins = 0;
        $cary_sum_hours = $cary_sum_mins = 0;

        foreach ($result as $key => $value) {
            $sum_hours += $value['hours_to_work'];

            $cary_sum_hours += $value['CarriedOverHours'];
        }
        $data['Sum_hour_contract'] = $sum_hours;
        $data['Sum_mins_contract'] = $sum_mins;
        $data['cary_Sum_hour_contract'] = $cary_sum_hours;
        $data['cary_Sum_mins_contract'] = $cary_sum_mins;

        $data['carriedDetails'] = $carriedDetails;

        $data['content'] = 'backend/admin_monthly_report';
        return view('backend/index', $data);
    }

    public function export_monthly_report_pdf($class = '')
    {
        $selected_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
        $selected_month = isset($_POST['month']) ? $_POST['month'] : date("m");
        $User_option = $this->request->getPost('User_option') != '' ? $this->request->getPost('User_option') : ''; // Apoorv 6-jul-2020

        $data['selected_year'] = $selected_year;
        $data['selected_month'] = $selected_month;

        if ($User_option != 0) {
            $application_id = $User_option;
        } else {
            $application_id = session()->get('NAME_ID');
        }

        $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);
        $data['records'] = $this->Report_model->getEmpDailyAttendance($application_id, $selected_month, $selected_year);
        // echo "<pre>";  print_r($data['records']); exit;
        $uniqecat = array_unique(array_column($data['records'], 'category_id'));
        //print_r(array_unique(array_column($data['records'], 'category_id'))); 
        //print_r($data['records']); exit; 
        $category = array();
        foreach ($data['records_categoryy'] as $key => $value) {
            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }

        $data['records_category'] = $category;
        $data['records_sum_cat'] = $this->Report_model->getTotalforMonthlyReportByCategry($application_id, $selected_year, $selected_month);
        $data['records_sum_day'] = $this->Report_model->getTotalforMonthlyReportByDay($application_id, $selected_year, $selected_month);
        $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($application_id, $selected_year, $selected_month);
        $data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear($application_id, $selected_month, $selected_year);
        $data['facultystaff'] = $this->Report_model->Get_faculty_staff();
        $data['User_option'] = test_input($User_option);
        $data['User_option_name'] = $this->Report_model->get_user_option_name($User_option);
        /* echo "<pre>"; print_r($data['records_sum_cat']);
	    die();*/
        $findate = "28-" . $selected_month . "-" . $selected_year;
        $finyear = getfinancialyear_june($findate);

        $ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($finyear);
        $result = $ContractorDetails;
        $sum_hours = $sum_mins = 0;
        $cary_sum_hours = $cary_sum_mins = 0;

        foreach ($result as $key => $value) {
            $sum_hours += $value['hours_to_work'];

            $cary_sum_hours += $value['CarriedOverHours'];
        }
        $data['Sum_hour_contract'] = $sum_hours;
        $data['Sum_mins_contract'] = $sum_mins;
        $data['cary_Sum_hour_contract'] = $cary_sum_hours;
        $data['cary_Sum_mins_contract'] = $cary_sum_mins;


        error_reporting(0);

        $pdf = new Pdf('L', 'cm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/export_pdf_monthly_report', $data);
        //$pdf->setCellHeightRatio(0.8);
        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 1, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins(14, 26, 20);
        $pdf->SetHeaderMargin(10, 10, 10, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, array(0, 0, 0), array(255, 255, 255));
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->AddPage('L', 'MAKE-L');
        ob_start();
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $this->response->setContentType('application/pdf');
        $pdf->Output('monthly_report.pdf', 'I'); // 'I' to inline in browser, 'D' to download

        //	$pdf->Output($file,'D');
    }

    function adminMonthlyJournalReport()
    {
        if (session()->get('role') != '1' && in_array('13', session()->get('profiles'))) {
            $timesheet_menu = session()->get('timesheet_menu');
            $menu_status = check_menu_permission($timesheet_menu, '45');
            if (!$menu_status) {
                redirect('My401/');
            }
        }
        $data['facultystaff'] = $this->Report_model->Get_faculty_staff();
        $emp_id = $this->request->getPost('User_option');
        $team = $this->request->getPost('Team_option');
        $data['User_option'] = $emp_id;

        //echo $data['User_option'];die;

        //$data['categorys'] = $this->Timesheet_model->admingetCategory($emp_id);
        $data['categorys'] = $this->Timesheet_model->get_user_category($emp_id, $team);
        //$data['category_list'] = $this->Timesheet_model->get_Category_id($emp_id);

        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_admin_montly_report();


            $data['total_hours_data'] = $this->Timesheet_model->admin_total_hours_in_monthly_journal_report();
            //echo $this->db->last_query();die;

        } else {
            $data['records'] = array();
            $data['total_hours_data'] = array();
        }


        //echo $this->db->last_query();die;
        $data['Team_option'] = $this->request->getPost('Team_option');
        $data['begin_date'] =  '';
        $data['end_date'] = '';
        if ($this->request->getPost('BeginDate') != '') {
            $data['begin_date'] = $this->request->getPost('BeginDate');
        }
        if ($this->request->getPost('EndDate') != '') {
            $data['end_date'] = $this->request->getPost('EndDate');
        }

        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $emp_id;
        //$data['facultystaff'] = $this->Report_model->Get_faculty_staff();
        $data['facultystaff'] = $this->Report_model->Get_contrcat_attendance_user();
        //echo $this->db->last_query();die;
        $data['team_name'] = $this->Users_model->getteam();


        $data['selected_1099'] = $this->request->getPost('contract_1099');

        $data['content'] = 'backend/adminmonthlyJournalReport';
        $data['page'] = '';
        return view('backend/index', $data);
    }

    function filter_adminMonthlyJournalReport()
    {

        if ($this->request->getPost('submit') == 'filter') {
            $data['facultystaff'] = $this->Report_model->Get_faculty_staff();
            $emp_id = $this->request->getPost('User_option');
            $team = $this->request->getPost('Team_option');
            $data['User_option'] = $emp_id;
            $data['categorys'] = $this->Timesheet_model->get_user_category($emp_id, $team);
            if ($this->request->getPost()) {
                $data['records'] = $this->Timesheet_model->get_journal_in_admin_montly_report();
                //echo $this->db->last_query();die();
                $data['total_hours_data'] = $this->Timesheet_model->admin_total_hours_in_monthly_journal_report();
            } else {
                $data['records'] = array();
                $data['total_hours_data'] = array();
            }
            $data['Team_option'] = $this->request->getPost('Team_option');
            $data['begin_date'] =  '';
            $data['end_date'] = '';
            if ($this->request->getPost('BeginDate') != '') {
                $data['begin_date'] = $this->request->getPost('BeginDate');
            }
            if ($this->request->getPost('EndDate') != '') {
                $data['end_date'] = $this->request->getPost('EndDate');
            }
            $data['selected_cat'] = $this->request->getPost('category_id');
            $data['emp_id'] = $emp_id;
            $data['facultystaff'] = $this->Report_model->Get_faculty_staff();
            $data['team_name'] = $this->Users_model->getteam();
            $data['selected_1099'] = $this->request->getPost('contract_1099');
            $data['page'] = '';
            return view('templates/filter/filter_adminmonthlyJournalReport', $data);
        }
    }

    public function export_pdf_adminmothlyjournalreport()
    {
        $emp_id = $this->request->getPost('User_option');
        $data['User_option'] = $emp_id;
        $data['begin_date'] = $this->request->getPost('BeginDate');
        $data['end_date'] = $this->request->getPost('EndDate');

        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_admin_montly_report();
            $data['total_hours_data'] = $this->Timesheet_model->admin_total_hours_in_monthly_journal_report();
        } else {
            $data['records'] = [];
        }

        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $emp_id;

        // Create PDF
        $pdf = new Pdf('L', 'cm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/export_pdf_adminmothlyjournalreport', $data);

        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');
        $tagvs = ['div' => [0 => ['h' => 0, 'n' => 0], 1 => ['h' => 1, 'n' => 1]]];
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins(14, 26, 20);
        $pdf->SetHeaderMargin(10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, [0, 0, 0], [255, 255, 255]);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->AddPage('L', 'MAKE-L');

        // IMPORTANT: Clear output buffer before writing PDF
        if (ob_get_length()) {
            ob_end_clean();
        }

        $pdf->writeHTML($html, true, false, true, false, '');

        // Output as download with correct headers
        $pdfContent = $pdf->Output('admin_monthly_journal_report.pdf', 'I');

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($pdfContent);
    }


    function export_excel_adminmonthlyJournalReport()
    {
        $emp_id = $this->request->getPost('User_option');
        $data['User_option'] = $emp_id;
        $data['begin_date'] = $this->request->getPost('BeginDate');
        $data['end_date'] = $this->request->getPost('EndDate');
        //$data ['categorys'] = $this->Timesheet_model->gettestCategory($emp_id);
        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_admin_montly_report();
            $data['total_hours_data'] = $this->Timesheet_model->admin_total_hours_in_monthly_journal_report();
        } else {
            $data['records'] = array();
        }
        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $emp_id;

        $tmpfname = FCPATH . 'uploads/example.xls';
        $excelReader = IOFactory::load($tmpfname);
        $data['objPHPExcel'] = $excelReader;

        return view('templates/export_excel_adminmonthlyJournalReport', $data);
    }

    public function monthlyReport($class = '')
    {
        $selected_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
        $selected_month = isset($_POST['month']) ? $_POST['month'] : date("m");
        $data['selected_year'] = $selected_year;
        $data['selected_month'] = $selected_month;
        $application_id = session()->get('NAME_ID');
        //$data['records_category'] = $this->Timesheet_model->getCategoryactive($application_id);
        $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);
        $data['records'] = $this->Report_model->getEmpDailyAttendance($application_id, $selected_month, $selected_year);
        $uniqecat = array_unique(array_column($data['records'], 'category_id'));
        $category = array();
        foreach ($data['records_categoryy'] as $key => $value) {
            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }
        $data['records_category'] = $category;
        $data['records_sum_cat'] = $this->Report_model->getTotalforMonthlyReportByCategry($application_id, $selected_year, $selected_month);
        $data['records_sum_day'] = $this->Report_model->getTotalforMonthlyReportByDay($application_id, $selected_year, $selected_month);
        $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($application_id, $selected_year, $selected_month);
        $data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear($application_id, $selected_month, $selected_year);
        $findate = "28-" . $selected_month . "-" . $selected_year;
        $finyear = getfinancialyear_june($findate);
        // $ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($finyear);

        //$ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($finyear);
        $ContractorDetails = $this->Timesheet_model->getActiveContractorsByID_New($application_id, date('Y-m-d', strtotime($findate)));
        $result = $ContractorDetails;
        $data['contractor_details'] = $ContractorDetails;
        $data['sum_fisical'] = array();
        if (!empty($result)) {
            $data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear_2($application_id, $result[0]['contract_begin_date'], $result[0]['contract_end_date']);
        }


        $sum_hours = $sum_mins = 0;
        $cary_sum_hours = $cary_sum_mins = 0;
        $carriedDetails  = $this->Timesheet_model->carriedDetails($finyear);
        foreach ($result as $key => $value) {
            $sum_hours += $value['hours_to_work'];
            $cary_sum_hours += $value['CarriedOverHours'];
        }

        $data['Sum_hour_contract'] = $sum_hours;
        $data['Sum_mins_contract'] = $sum_mins;
        $data['cary_Sum_hour_contract'] = $cary_sum_hours;
        $data['cary_Sum_mins_contract'] = $cary_sum_mins;
        $total_days_month = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);
        $newDateTime = '05' . '-' . $selected_month . '-' . $selected_year;
        $data['total_days_month'] = $total_days_month;
        $data['newDateTime'] = $newDateTime;
        $data['carriedDetails'] = $carriedDetails;

        $link_contract1 = array();
        $link_contract2 = array();
        $sum_fisical1 = array();
        $sum_fisical2 = array();
        if (!empty($ContractorDetails)) {
            if ($ContractorDetails[0]['min_contact_id'] != $ContractorDetails[0]['max_contact_id']) {
                $link_contract1 =  $this->Timesheet_model->getActiveContractorsByContractID($application_id, $ContractorDetails[0]['min_contact_id']);
                $link_contract2 =  $this->Timesheet_model->getActiveContractorsByContractID($application_id, $ContractorDetails[0]['max_contact_id']);
                $sum_fisical1 = $this->Report_model->getTotalforFisicalYearByContractId($application_id, $ContractorDetails[0]['min_contact_id']);
                $sum_fisical2 = $this->Report_model->getTotalforFisicalYearByContractId($application_id, $ContractorDetails[0]['max_contact_id']);
            }
        }
        // Start Contract=>1 
        $sum_hours1 = 0;
        $cary_sum_hours1 = 0;
        $sum_mins1 = 0;
        $cary_sum_mins1 = 0;
        foreach ($link_contract1 as $key => $value) {
            $sum_hours1 += $value['hours_to_work'];
            $cary_sum_hours1 += $value['CarriedOverHours'];
        }
        $data['Sum_hour_contract_1'] = $sum_hours1;
        $data['Sum_mins_contract_1'] = $sum_mins1;
        $data['cary_Sum_hour_contract_1'] = $cary_sum_hours1;
        $data['cary_Sum_mins_contract_1'] = $cary_sum_mins1;
        $data['sum_fisical_1'] = $sum_fisical1;
        // End Contract=>1


        // Start Contract=>2 
        $sum_hours2 = 0;
        $cary_sum_hours2 = 0;
        $sum_mins2 = 0;
        $cary_sum_mins2 = 0;
        foreach ($link_contract2 as $key => $value) {
            $sum_hours2 += $value['hours_to_work'];
            $cary_sum_hours2 += $value['CarriedOverHours'];
        }
        $data['Sum_hour_contract_2'] = $sum_hours2;
        $data['Sum_mins_contract_2'] = $sum_mins2;
        $data['cary_Sum_hour_contract_2'] = $cary_sum_hours2;
        $data['cary_Sum_mins_contract_2'] = $cary_sum_mins2;
        $data['sum_fisical_2'] = $sum_fisical2;
        // End Contract=>1

        $data['link_contract1'] = $link_contract1;
        $data['link_contract2'] = $link_contract2;

        $carriedDetails  = $this->Timesheet_model->carriedDetails($finyear);
        $result = $ContractorDetails;
        $sum_hours = $sum_mins = 0;
        $cary_sum_hours = $cary_sum_mins = 0;
        foreach ($result as $key => $value) {
            $sum_hours += $value['hours_to_work'];
            $cary_sum_hours += $value['CarriedOverHours'];
        }

        $data['content'] = 'backend/monthly_report2';
        return view('backend/index', $data);
    }

    public function filter_monthlyReport2($class = '')
    {
        if ($this->request->getPost('submit') == 'filter') {
            $selected_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
            $selected_month = isset($_POST['month']) ? $_POST['month'] : date("m");
            $data['selected_year'] = $selected_year;
            $data['selected_month'] = $selected_month;
            $application_id = session()->get('NAME_ID');
            //$data['records_category'] = $this->Timesheet_model->getCategoryactive($application_id);
            $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);
            $data['records'] = $this->Report_model->getEmpDailyAttendance($application_id, $selected_month, $selected_year);
            $uniqecat = array_unique(array_column($data['records'], 'category_id'));
            $category = array();
            foreach ($data['records_categoryy'] as $key => $value) {
                if ($data['records_categoryy'][$key]['Active'] == '1') {
                    $category[] = $value;
                } else {
                    if (in_array($value['id'], $uniqecat)) {
                        $category[] = $value;
                    }
                }
            }
            $data['records_category'] = $category;
            $data['records_sum_cat'] = $this->Report_model->getTotalforMonthlyReportByCategry($application_id, $selected_year, $selected_month);
            $data['records_sum_day'] = $this->Report_model->getTotalforMonthlyReportByDay($application_id, $selected_year, $selected_month);
            $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($application_id, $selected_year, $selected_month);
            //$data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear($application_id,$selected_month,$selected_year);
            $last_day = date('t', strtotime($selected_year . "-" . $selected_month . "-1"));
            $findate = $last_day . "-" . $selected_month . "-" . $selected_year;
            $finyear = getfinancialyear_june($findate);
            //$ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($finyear);
            $ContractorDetails = $this->Timesheet_model->getActiveContractorsByID_New($application_id, date('Y-m-d', strtotime($findate)));
            $result = $ContractorDetails;
            $data['contractor_details'] = $ContractorDetails;
            $data['sum_fisical'] = array();
            if (!empty($result)) {
                $data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear_2($application_id, $result[0]['contract_begin_date'], $result[0]['contract_end_date']);
            }


            $sum_hours = $sum_mins = 0;
            $cary_sum_hours = $cary_sum_mins = 0;
            $carriedDetails  = $this->Timesheet_model->carriedDetails($finyear);
            foreach ($result as $key => $value) {
                $sum_hours += $value['hours_to_work'];
                $cary_sum_hours += $value['CarriedOverHours'];
            }
            $data['Sum_hour_contract'] = $sum_hours;
            $data['Sum_mins_contract'] = $sum_mins;
            $data['cary_Sum_hour_contract'] = $cary_sum_hours;
            $data['cary_Sum_mins_contract'] = $cary_sum_mins;
            $total_days_month = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);
            $newDateTime = '05' . '-' . $selected_month . '-' . $selected_year;
            $data['total_days_month'] = $total_days_month;
            $data['newDateTime'] = $newDateTime;
            $data['carriedDetails'] = $carriedDetails;

            $link_contract1 = array();
            $link_contract2 = array();
            $sum_fisical1 = array();
            $sum_fisical2 = array();
            if (!empty($ContractorDetails)) {
                if ($ContractorDetails[0]['min_contact_id'] != $ContractorDetails[0]['max_contact_id']) {
                    $link_contract1 =  $this->Timesheet_model->getActiveContractorsByContractID($application_id, $ContractorDetails[0]['min_contact_id']);
                    $link_contract2 =  $this->Timesheet_model->getActiveContractorsByContractID($application_id, $ContractorDetails[0]['max_contact_id']);
                    $sum_fisical1 = $this->Report_model->getTotalforFisicalYearByContractId($application_id, $ContractorDetails[0]['min_contact_id']);
                    $sum_fisical2 = $this->Report_model->getTotalforFisicalYearByContractId($application_id, $ContractorDetails[0]['max_contact_id']);
                }
            }
            // Start Contract=>1 
            $sum_hours1 = 0;
            $cary_sum_hours1 = 0;
            $sum_mins1 = 0;
            $cary_sum_mins1 = 0;
            foreach ($link_contract1 as $key => $value) {
                $sum_hours1 += $value['hours_to_work'];
                $cary_sum_hours1 += $value['CarriedOverHours'];
            }
            $data['Sum_hour_contract_1'] = $sum_hours1;
            $data['Sum_mins_contract_1'] = $sum_mins1;
            $data['cary_Sum_hour_contract_1'] = $cary_sum_hours1;
            $data['cary_Sum_mins_contract_1'] = $cary_sum_mins1;
            $data['sum_fisical_1'] = $sum_fisical1;
            // End Contract=>1


            // Start Contract=>2 
            $sum_hours2 = 0;
            $cary_sum_hours2 = 0;
            $sum_mins2 = 0;
            $cary_sum_mins2 = 0;
            foreach ($link_contract2 as $key => $value) {
                $sum_hours2 += $value['hours_to_work'];
                $cary_sum_hours2 += $value['CarriedOverHours'];
            }
            $data['Sum_hour_contract_2'] = $sum_hours2;
            $data['Sum_mins_contract_2'] = $sum_mins2;
            $data['cary_Sum_hour_contract_2'] = $cary_sum_hours2;
            $data['cary_Sum_mins_contract_2'] = $cary_sum_mins2;
            $data['sum_fisical_2'] = $sum_fisical2;
            // End Contract=>1

            $data['link_contract1'] = $link_contract1;
            $data['link_contract2'] = $link_contract2;

            return view('templates/filter/filter_monthly_report', $data);
        }
    }

    public function monthlyReport2($class = '')
    {

        $selected_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
        $selected_month = isset($_POST['month']) ? $_POST['month'] : date("m");
        $data['selected_year'] = $selected_year;
        $data['selected_month'] = $selected_month;

        $application_id = session()->get('NAME_ID');
        //$data['records_category'] = $this->Timesheet_model->getCategoryactive($application_id);

        $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);
        $data['records'] = $this->Report_model->getEmpDailyAttendance($application_id, $selected_month, $selected_year);
        // echo "<pre>";  print_r($data['records']); exit;
        $uniqecat = array_unique(array_column($data['records'], 'category_id'));
        //print_r(array_unique(array_column($data['records'], 'category_id'))); 
        //print_r($data['records']); exit; 
        $category = array();
        foreach ($data['records_categoryy'] as $key => $value) {
            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }

        $data['records_category'] = $category;
        $data['records_sum_cat'] = $this->Report_model->getTotalforMonthlyReportByCategry($application_id, $selected_year, $selected_month);
        $data['records_sum_day'] = $this->Report_model->getTotalforMonthlyReportByDay($application_id, $selected_year, $selected_month);
        $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($application_id, $selected_year, $selected_month);
        $data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear($application_id, $selected_month, $selected_year);
        /* echo "<pre>"; print_r($data['records_sum_cat']);
	    die();*/
        $findate = "28-" . $selected_month . "-" . $selected_year;
        $finyear = getfinancialyear_june($findate);

        $ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($finyear);
        $result = $ContractorDetails;
        $carriedDetails  = $this->Timesheet_model->carriedDetails($finyear);
        $sum_hours = $sum_mins = 0;
        $cary_sum_hours = $cary_sum_mins = 0;

        foreach ($result as $key => $value) {
            $sum_hours += $value['hours_to_work'];

            $cary_sum_hours += $value['CarriedOverHours'];
        }
        $data['carriedDetails'] = $carriedDetails;
        $data['Sum_hour_contract'] = $sum_hours;
        $data['Sum_mins_contract'] = $sum_mins;
        $data['cary_Sum_hour_contract'] = $cary_sum_hours;
        $data['cary_Sum_mins_contract'] = $cary_sum_mins;



        $data['content'] = 'backend/monthly_report';
        return view('backend/index', $data);
    }

    public function filter_monthlyReport($class = '')
    {
        if ($this->request->getPost('submit') == 'filter') {
            $selected_year = isset($_POST['year']) ? $_POST['year'] : date("Y");
            $selected_month = isset($_POST['month']) ? $_POST['month'] : date("m");
            $data['selected_year'] = $selected_year;
            $data['selected_month'] = $selected_month;
            $application_id = session()->get('NAME_ID');
            //$data['records_category'] = $this->Timesheet_model->getCategoryactive($application_id);
            $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);
            $data['records'] = $this->Report_model->getEmpDailyAttendance($application_id, $selected_month, $selected_year);
            //echo $this->db->last_query();
            //echo "<pre>";print_r($data['records']);echo "</pre>";
            //die();
            $uniqecat = array_unique(array_column($data['records'], 'category_id'));
            $category = array();
            foreach ($data['records_categoryy'] as $key => $value) {
                if ($data['records_categoryy'][$key]['Active'] == '1') {
                    $category[] = $value;
                } else {
                    if (in_array($value['id'], $uniqecat)) {
                        $category[] = $value;
                    }
                }
            }
            $data['records_category'] = $category;
            $data['records_sum_cat'] = $this->Report_model->getTotalforMonthlyReportByCategry($application_id, $selected_year, $selected_month);
            $data['records_sum_day'] = $this->Report_model->getTotalforMonthlyReportByDay($application_id, $selected_year, $selected_month);
            $data['records_sum'] = $this->Report_model->getTotalforMonthlyReport($application_id, $selected_year, $selected_month);
            $data['sum_fisical'] = $this->Report_model->getTotalforFisicalYear($application_id, $selected_month, $selected_year);

            $findate = "28-" . $selected_month . "-" . $selected_year;
            $finyear = getfinancialyear_june($findate);
            $ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($finyear);
            //echo $this->db->last_query();die();
            $result = $ContractorDetails;
            $sum_hours = $sum_mins = 0;
            $cary_sum_hours = $cary_sum_mins = 0;

            $carriedDetails  = $this->Timesheet_model->carriedDetails($finyear);

            foreach ($result as $key => $value) {
                $sum_hours += $value['hours_to_work'];
                $cary_sum_hours += $value['CarriedOverHours'];
            }
            $data['Sum_hour_contract'] = $sum_hours;
            $data['Sum_mins_contract'] = $sum_mins;
            $data['cary_Sum_hour_contract'] = $cary_sum_hours;
            $data['cary_Sum_mins_contract'] = $cary_sum_mins;
            $total_days_month = cal_days_in_month(CAL_GREGORIAN, $selected_month, $selected_year);
            $newDateTime = '05' . '-' . $selected_month . '-' . $selected_year;
            $data['total_days_month'] = $total_days_month;
            $data['newDateTime'] = $newDateTime;
            $data['carriedDetails'] = $carriedDetails;
            return view('templates/filter/filter_monthly_report', $data);
        }
    }

    function monthlyJournalReport()
    {
        $empid = session()->get('NAME_ID');
        $data['categorys'] = $this->Timesheet_model->gettestCategory($empid);
        $data['category_list'] = $this->Timesheet_model->get_Category_id($empid);
        // echo "<pre>";print_r($data['category_list']);die();
        // $data['records'] = $this->Timesheet_model->get_monthly_journal_report($empid);
        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_montly_report2();
            $data['total_hours_data'] = $this->Timesheet_model->total_hours_in_monthly_journal_report();
        } else {
            $data['records'] = array();
            $data['total_hours_data'] = array();
        }

        //echo $this->db->last_query();die;
        $data['begin_date'] =  '';
        $data['end_date'] = '';
        if ($this->request->getPost('BeginDate') != '') {
            $data['begin_date'] = $this->request->getPost('BeginDate');
        }
        if ($this->request->getPost('EndDate') != '') {
            $data['end_date'] = $this->request->getPost('EndDate');
        }

        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $empid;



        $data['content'] = 'backend/monthlyJournalReport';
        $data['page'] = '';
        $data['data'] = $data;
        return view('backend/index', $data);
    }

    function filter_monthlyJournalReport()
    {
        if ($this->request->getPost('submit') == 'filter') {
            $empid = session()->get('NAME_ID');
            $data['categorys'] = $this->Timesheet_model->gettestCategory($empid);
            $data['category_list'] = $this->Timesheet_model->get_Category_id($empid);
            $data['records'] = $this->Timesheet_model->get_journal_in_montly_report2();
            $data['total_hours_data'] = $this->Timesheet_model->total_hours_in_monthly_journal_report();
            $data['begin_date'] =  '';
            $data['end_date']   =  '';
            if ($this->request->getPost('BeginDate') != '') {
                $data['begin_date'] = $this->request->getPost('BeginDate');
            }
            if ($this->request->getPost('EndDate') != '') {
                $data['end_date'] = $this->request->getPost('EndDate');
            }
            $data['selected_cat'] = $this->request->getPost('category_id');
            $data['emp_id'] = $empid;

            return view('templates/filter/filter_monthlyJournalReport', $data);
        }
        //$this->load->view('backend/index',$data);
    }

    function get_journal_in_montly_report()
    {
        $details = $this->Timesheet_model->get_journal_in_montly_report();


        echo "<table class='table table-striped table-bordered'>";
        echo "<tr><th colspan='3' style='text-align:center;padding:10px;'>" . $this->request->getPost('rel_name') . "</th></tr>";
        echo "<tr>";
        echo "<th style='width:150px;'>Date</th>";
        echo "<th>Hour</th>";

        echo "<th style='width:70%;'>Journal</th>";

        echo "</tr>";
        $total_hour = 0.00;

        foreach ($details as $dt) {
            $total_hour = $total_hour + $dt['hours'];
            echo "<tr>";


            $tra = '';
            if ($dt['transaction_date'] != '') {
                $tra = date('d-M-Y', $dt['transaction_date']);
            }



            echo "<td style='width:150px;'>" . str_replace("00:00:00", "", $dt['transaction_date']) . "</td>";

            echo "<td>" . $dt['hours'] . "</td>";


            echo "<td style='width:70%;text-align:left'>" . $dt['journal'] . "</td>";

            echo "</tr>";
        }
        echo "<tr>";
        echo "<th>Total :</th>";
        echo "<td style='text-align:left;' colspan='2'>" . $this->request->getPost('rel_hour') . "</th>";
        echo "</tr>";
        echo "</table>";
    }




    function export_excel_monthlyJournalReport()
    {
        $tmpfname = FCPATH . 'uploads/example.xls';
        $excelReader = IOFactory::createReaderForFile($tmpfname);
        $data['objPHPExcel'] = $excelReader->load($tmpfname);

        $empid = session()->get('NAME_ID');
        $data['categorys'] = $this->Timesheet_model->gettestCategory($empid);
        $data['category_list'] = $this->Timesheet_model->get_Category_id($empid);
        // echo "<pre>";print_r($data ['data']['category_list']);die();
        // $data['records'] = $this->Timesheet_model->get_monthly_journal_report($empid);
        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_montly_report2();
            $data['total_hours_data'] = $this->Timesheet_model->total_hours_in_monthly_journal_report();
        } else {
            $data['records'] = array();
            $data['total_hours_data'] = array();
        }


        //echo $this->db->last_query();die;
        $data['begin_date'] =  '';
        $data['end_date'] = '';
        if ($this->request->getPost('BeginDate') != '') {
            $data['begin_date'] = $this->request->getPost('BeginDate');
        }
        if ($this->request->getPost('EndDate') != '') {
            $data['end_date'] = $this->request->getPost('EndDate');
        }

        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $empid;


        return view('templates/export_excel_monthlyJournalReport', $data);
    }

    function export_pdf_mothlyjournalreport()
    {
        error_reporting(0);
        $empid = session()->get('NAME_ID');
        $data['categorys'] = $this->Timesheet_model->gettestCategory($empid);
        $data['category_list'] = $this->Timesheet_model->get_Category_id($empid);
        // echo "<pre>";print_r($data ['data']['category_list']);die();
        // $data['records'] = $this->Timesheet_model->get_monthly_journal_report($empid);
        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_montly_report2();
        } else {
            $data['records'] = array();
        }


        //echo $this->db->last_query();die;
        $data['begin_date'] =  '';
        $data['end_date'] = '';
        if ($this->request->getPost('BeginDate') != '') {
            $data['begin_date'] = $this->request->getPost('BeginDate');
        }
        if ($this->request->getPost('EndDate') != '') {
            $data['end_date'] = $this->request->getPost('EndDate');
        }

        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $empid;

        //get total hours and minutes By Prabhat 30-09-2020
        $data['total_hours_data'] = $this->Timesheet_model->total_hours_in_monthly_journal_report();
        // echo "<pre>";print_r($data['total_hours_data']);die();
        // End

        $pdf = new Pdf('L', 'cm', 'MAKE-L', true, 'UTF-8', false);
        /*$this->load->library("Pdf_portrait");
			$pdf = new Pdf_portrait('L', 'mm', 'letter', true, 'UTF-8', false);*/
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/export_pdf_mothlyjournalreport', $data);
        //$pdf->setCellHeightRatio(0.8);
        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 1, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins(14, 26, 20);
        $pdf->SetHeaderMargin(10, 10, 10, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, array(0, 0, 0), array(255, 255, 255));
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //
        $pdf->AddPage('L', 'MAKE-L');
        ob_start();
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdfContent = $pdf->Output('mothlyjournalreport.pdf', 'I');

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($pdfContent);
    }

    public function indivisualReport($class = '')
    {
        $selected_year = isset($_POST['Financial_Y']) ? $_POST['Financial_Y'] : getfinancialyear_june(date("d-m-Y"));

        $data['selected_year'] = $selected_year;
        $application_id = session()->get('NAME_ID');

        $data['fisical_year'] = explode(",", $this->Report_model->getAllFisicalyear());

        $data['records'] = $this->Report_model->getEmpDailyAttendance_Bymonth($application_id, $selected_year);
        $data['sum_hr_mnth'] = $this->Report_model->getTotalforFisicalReportByMonth($application_id, $selected_year);
        $data['sum_hr_cat'] = $this->Report_model->getTotalforFisicalReportByCat($application_id, $selected_year);
        //$data['sum_hr'] = $this->Report_model->getTotalforFisicalReport($application_id,$selected_year);

        $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);
        // $data['records_category'] = $this->Timesheet_model->getcategorybyempid($application_id);
        $uniqecat = array_unique(array_column($data['records'], 'category_id'));
        $category = array();
        foreach ($data['records_categoryy'] as $key => $value) {
            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }
        $data['records_category'] = $category;
        //$ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($selected_year);
        $empid = '';
        if ($this->request->getPost('User_option') != '' && $this->request->getPost('User_option') != 0) {
            $empid = $this->request->getPost('User_option');
        } else {
            $empid = session()->get('NAME_ID');
        }

        $ContractorDetails = $activeContract =  $this->Timesheet_model->getActiveContractorsByIDFisical_New($empid, $selected_year);
        $data['contractor_details'] = $ContractorDetails;
        $result = $ContractorDetails;
        if (!empty($ContractorDetails)) {
            if ($ContractorDetails[0]['min_contact_id'] != $ContractorDetails[0]['max_contact_id']) {
                $link_contract1 =  $this->Timesheet_model->getActiveContractorsByContractID($application_id, $ContractorDetails[0]['min_contact_id']);
                $link_contract2 =  $this->Timesheet_model->getActiveContractorsByContractID($application_id, $ContractorDetails[0]['max_contact_id']);
                $sum_fisical1 = $this->Report_model->getTotalforFisicalYearByContractId($application_id, $ContractorDetails[0]['min_contact_id']);
                $sum_fisical2 = $this->Report_model->getTotalforFisicalYearByContractId($application_id, $ContractorDetails[0]['max_contact_id']);
            }
        }

        $sum_hours = $sum_mins = 0;
        $cary_sum_hours = $cary_sum_mins = 0;
        foreach ($result as $key => $value) {
            $sum_hours += $value['hours_to_work'];
            $cary_sum_hours += $value['CarriedOverHours'];
        }
        $data['sum_hr'] =  array();
        $data['sum_hr'] = $this->Report_model->getTotalforFisicalReport($application_id, $selected_year);
        if (!empty($result)) {
            $data['main_sum_hr'] = $this->Report_model->getTotalforFisicalYear_2($application_id, $result[0]['contract_begin_date'], $result[0]['contract_end_date']);
        }


        // Start Contract=>1 
        $sum_hours1 = 0;
        $cary_sum_hours1 = 0;
        $sum_mins1 = 0;
        $cary_sum_mins1 = 0;
        if (isset($link_contract1)) {
            foreach ($link_contract1 as $key => $value) {
                $sum_hours1 += $value['hours_to_work'];
                $cary_sum_hours1 += $value['CarriedOverHours'];
            }
        }
        $data['Sum_hour_contract_1'] = $sum_hours1;
        $data['Sum_mins_contract_1'] = $sum_mins1;
        $data['cary_Sum_hour_contract_1'] = $cary_sum_hours1;
        $data['cary_Sum_mins_contract_1'] = $cary_sum_mins1;
        $data['sum_fisical_1'] = isset($sum_fisical1) ?? '';
        // End Contract=>1


        // Start Contract=>2 
        $sum_hours2 = 0;
        $cary_sum_hours2 = 0;
        $sum_mins2 = 0;
        $cary_sum_mins2 = 0;
        if (isset($link_contract2)) {
            foreach ($link_contract2 as $key => $value) {
                $sum_hours2 += $value['hours_to_work'];
                $cary_sum_hours2 += $value['CarriedOverHours'];
            }
        }
        $data['Sum_hour_contract_2'] = $sum_hours2;
        $data['Sum_mins_contract_2'] = $sum_mins2;
        $data['cary_Sum_hour_contract_2'] = $cary_sum_hours2;
        $data['cary_Sum_mins_contract_2'] = $cary_sum_mins2;
        $data['sum_fisical_2'] = isset($sum_fisical2) ?? '';
        // End Contract=>1

        $data['link_contract1'] = isset($link_contract1) ?? '';
        $data['link_contract2'] = isset($link_contract2) ?? '';

        $data['Sum_hour_contract'] = $sum_hours;
        $data['cary_Sum_hour_contract'] = $cary_sum_hours;
        $data['content'] = 'backend/indivisual_financialyear_report2.php';
        return view('backend/index', $data);
    }

    public function indivisualReport2($class = '')
    {

        $selected_year = isset($_POST['Financial_Y']) ? $_POST['Financial_Y'] : getfinancialyear_june(date("d-m-Y"));
        $data['selected_year'] = $selected_year;
        $application_id = session()->get('NAME_ID');

        $data['fisical_year'] = explode(",", $this->Report_model->getAllFisicalyear());

        $data['records'] = $this->Report_model->getEmpDailyAttendance_Bymonth($application_id, $selected_year);
        $data['sum_hr_mnth'] = $this->Report_model->getTotalforFisicalReportByMonth($application_id, $selected_year);
        $data['sum_hr_cat'] = $this->Report_model->getTotalforFisicalReportByCat($application_id, $selected_year);
        $data['sum_hr'] = $this->Report_model->getTotalforFisicalReport($application_id, $selected_year);
        $data['records_categoryy'] = $this->Timesheet_model->getCategory($application_id);
        // $data['records_category'] = $this->Timesheet_model->getcategorybyempid($application_id);
        $uniqecat = array_unique(array_column($data['records'], 'category_id'));
        $category = array();
        foreach ($data['records_categoryy'] as $key => $value) {
            if ($data['records_categoryy'][$key]['Active'] == '1') {
                $category[] = $value;
            } else {
                if (in_array($value['id'], $uniqecat)) {
                    $category[] = $value;
                }
            }
        }
        $data['records_category'] = $category;
        $ContractorDetails = $this->Timesheet_model->getActiveContractorDetailsFisical($selected_year);

        $result = $ContractorDetails;
        $sum_hours = $sum_mins = 0;
        $cary_sum_hours = $cary_sum_mins = 0;
        foreach ($result as $key => $value) {
            $sum_hours += $value['hours_to_work'];
            $cary_sum_hours += $value['CarriedOverHours'];
        }
        $data['Sum_hour_contract'] = $sum_hours;
        $data['cary_Sum_hour_contract'] = $cary_sum_hours;
        $data['content'] = 'backend/indivisual_financialyear_report.php';
        return view('backend/index', $data);
    }

    public function TeamReport($class = '')
    {
        $application_id = session()->get('NAME_ID');
        $data['contractors'] = $this->Timesheet_model->getActiveContractors();

        $data['facultystaff'] = $this->Report_model->Get_faculty_staff();

        if ($this->request->getPost()) {
            $BeginDate = $this->request->getPost('BeginDate') != '' ? $this->request->getPost('BeginDate') : '';
            $EndDate = $this->request->getPost('EndDate') != '' ? $this->request->getPost('EndDate') : '';

            $data['BeginDate'] = test_input($BeginDate);
            $data['EndDate'] = test_input($EndDate);
        } else {

            $BeginDate = date("Y-m-d");
            $EndDate = date("Y-m-d");
        }

        $data['records'] = $this->Report_model->team_getEmpDailyAttendance_Byemp($application_id, $BeginDate, $EndDate);
        $data['team_member'] = $this->Report_model->get_team_member($application_id);
        /*echo "<pre>"; print_r($data['team_member']); die;*/
        $data['records_sum_cat_hr'] = $this->Report_model->team_getTotalforAdmin_TimeReport_catwise($application_id, $BeginDate, $EndDate);
        $data['records_sum_emp_hr'] = $this->Report_model->team_getTotalforAdmin_TimeReport_empwise($BeginDate, $EndDate);
        $data['records_sum'] = $this->Report_model->team_getTotalforAdminReport($application_id, $BeginDate, $EndDate);
        /*adminTimeReport*/
        $data['team_name'] = $this->Users_model->getteam();
        $data['records_category'] = $this->Timesheet_model->getCategoryactive();
        $data['catcount'] = count($data['records_category']);
        $data['uni_empid'] = array_values(array_column($data['records'], null, 'empid'));
        /*  echo "<pre>";
 		print_r($data['uni_empid']); 
 		exit;*/
        $data['content'] = 'backend/team_report';
        return view('backend/index', $data);
    }

    function teamMonthlyJournlReport()
    {
        $application_id = session()->get('NAME_ID');
        //$application_id = 3591;
        $data['team_member'] = $this->Report_model->get_team_member($application_id);

        //$data['facultystaff'] = $this->Report_model->superwiser_wise_Get_faculty_staff();
        $emp_id = $this->request->getPost('User_option');
        $team = $this->request->getPost('Team_option');
        $data['User_option'] = $emp_id;
        if ($emp_id == '') {
            $emp_id = $application_id;
        }

        $data['categorys'] = $this->Timesheet_model->get_user_category($emp_id, $team);

        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_admin_montly_report();
            $data['total_hours_data'] = $this->Timesheet_model->admin_total_hours_in_monthly_journal_report();
        } else {
            $data['records'] = array();
            $data['total_hours_data'] = array();
        }

        $data['Team_option'] = $this->request->getPost('Team_option');
        $data['begin_date'] =  '';
        $data['end_date'] = '';
        if ($this->request->getPost('BeginDate') != '') {
            $data['begin_date'] = $this->request->getPost('BeginDate');
        }
        if ($this->request->getPost('EndDate') != '') {
            $data['end_date'] = $this->request->getPost('EndDate');
        }

        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $emp_id;
        $data['facultystaff'] = $this->Users_model->superwiser_wise_Get_faculty_staff($data['team_member']);
        //echo "<pre>";print_r($data['facultystaff']);echo "</pre>";die;
        $data['team_name'] = $this->Users_model->supervisior_wise_getteam();


        $data['content'] = 'backend/teamMonthlyJournalReport';
        $data['page'] = '';
        return view('backend/index', $data);
    }


    function export_excel_teammonthlyJournalReport()
    {
        $application_id = session()->get('NAME_ID');
        //$application_id = 3591;
        $data['team_member'] = $this->Report_model->get_team_member($application_id);

        $emp_id = $this->request->getPost('User_option');

        $data['User_option'] = $emp_id;

        $data['begin_date'] = $this->request->getPost('BeginDate');
        $data['end_date'] = $this->request->getPost('EndDate');
        //$data ['categorys'] = $this->Timesheet_model->gettestCategory($emp_id);
        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_admin_montly_report();
            $data['total_hours_data'] = $this->Timesheet_model->admin_total_hours_in_monthly_journal_report();
        } else {
            $data['records'] = array();
        }
        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $emp_id;

        $tmpfname = FCPATH . 'uploads/example.xls';
        $excelReader = IOFactory::createReaderForFile($tmpfname);
        $data['objPHPExcel'] = $excelReader->load($tmpfname);

        return view('templates/export_excel_teammonthlyJournalReport', $data);
    }

    function export_pdf_teammothlyjournalreport()
    {
        $application_id = session()->get('NAME_ID');
        //$application_id = 3591;
        $data['team_member'] = $this->Report_model->get_team_member($application_id);
        $emp_id = $this->request->getPost('User_option');

        $data['User_option'] = $emp_id;

        //echo $data['User_option'];die;

        // $data ['categorys'] = $this->Timesheet_model->gettestCategory($emp_id);
        //$data ['data']['category_list'] = $this->Timesheet_model->get_Category_id($emp_id);
        $data['begin_date'] = $this->request->getPost('BeginDate');
        $data['end_date'] = $this->request->getPost('EndDate');
        if ($this->request->getPost()) {
            $data['records'] = $this->Timesheet_model->get_journal_in_admin_montly_report();
            $data['total_hours_data'] = $this->Timesheet_model->admin_total_hours_in_monthly_journal_report();
        } else {
            $data['records'] = array();
        }


        $data['selected_cat'] = $this->request->getPost('category_id');
        $data['emp_id'] = $emp_id;

        $pdf = new Pdf('L', 'cm', 'MAKE-L', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $data['last_page'] = $pdf->getAliasNbPages();
        $html = view('templates/export_pdf_teammothlyjournalreport', $data);
        //$pdf->setCellHeightRatio(0.8);
        $pdf->SetLineWidth(0.1);
        $pdf->SetAuthor('Future Generation University');
        $pdf->SetTitle('Future Generation');
        $pdf->SetSubject('Students Reports');
        $pdf->SetKeywords('PDF');
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 1, 'n' => 1)));
        $pdf->setHtmlVSpace($tagvs);
        $pdf->SetMargins(14, 26, 20);
        $pdf->SetHeaderMargin(10, 10, 10, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->setPrintHeader(true);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, false, false, array(0, 0, 0), array(255, 255, 255));
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
        $pdf->setPrintFooter(true);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //
        $pdf->AddPage('L', 'MAKE-L');
        ob_start();
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
       $pdfContent = $pdf->Output('teammothlyjournalreport.pdf', 'I');

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($pdfContent);
    }
    
}
