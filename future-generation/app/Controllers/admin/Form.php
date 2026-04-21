<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\ScbvModel;
use App\Models\UsersModel;
use App\Models\ApplicationModel;
use App\Models\ReportModel;

class Form extends BaseController
{
    protected $request;
    protected $applicationModel;
    protected $reportModel;
    protected $usersModel;
    protected $schemeModel;
    protected $scbvModel;
    protected $pager;
    protected $session;

    public function __construct()
    {
        // Load models manually
        $this->applicationModel = new ApplicationModel();
        // $this->reportModel = new ReportModel();
        $this->usersModel = new UsersModel();
        // $this->schemeModel = new SchemeModel();
        $this->scbvModel = new ScbvModel();

        $this->reportModel = new ReportModel();

        // Load pagination service
        $this->pager = \Config\Services::pager();
        $this->request = \Config\Services::request();
    }

    public function index()
    {

        $ID = $this->request->getPost('student_id');
        $data['studentid'] = $ID ?? '';
        $data['country'] = $this->scbvModel->get_country();
        $data['states'] = $this->scbvModel->get_all_states();
        $data['phonetypes'] = $this->applicationModel->get_all_phone_type();
        $data['address_type'] = $this->applicationModel->get_address_type();
        $data['allOrganization'] = $this->applicationModel->getAllOrganization();
        $data['allOrgRelationship'] = $this->applicationModel->allOrgRelationship();
        $data['all_organization'] = $this->applicationModel->getAllActiveOrganization();
        $data['assign_organization'] = $this->applicationModel->getAssignOrganization($ID);
        $data['patner_organizations'] = $this->applicationModel->getAllActivePartner();
        $data['group'] = getGroups($ID);
        $data['transcriptclass'] = $this->applicationModel->getAllActiveClass();
        $data['student_program'] = $this->applicationModel->getAllActiveProgram();
        $data['region'] = $this->applicationModel->getAllRegion();
        $data['student_special_program'] = $this->applicationModel->getspecialprogram();
        $data['tracks'] = $this->applicationModel->get_active_track();
        $data['total_credit'] = $this->reportModel->gettotalCreditattempt($ID);
        $data['quality_point'] = $this->reportModel->getTransciptDetailByStudent($ID);
        $data['editclass'] = $this->applicationModel->getAllClass();
        $data['completeregion'] = $this->applicationModel->getCompleteRegion();
        $data['all_scholarships'] = $this->applicationModel->get_all_scholarship();
        $data['assign_class'] = $this->applicationModel->assign_class($ID);
        $data['cert_assign_class'] = $this->applicationModel->cert_assign_class($ID);
        $data['assign_crm_list'] = [];
        $data['form_id'] = '';

        // These need to be outside the inner $data array
        $content = 'backend/addForm';
        $page = '';

        return view('backend/index', [
            'data' => $data,
            'content' => $content,
            'page' => $page,
        ]);
    }


    function ViewAppList()
    {

        //echo "<pre>";print_r($_SESSION);echo "</pre>";die;
        $data = [
            'data' => [
                'form_id' => '',
                'country' => $this->scbvModel->get_country(),
                'states'  => $this->scbvModel->get_all_states(),
                'address_type' => $this->applicationModel->get_address_type(),
                'tracks' => $this->applicationModel->get_active_track(),
            ],
            'all_scholarships' => $this->applicationModel->get_all_scholarship(),
            'transcriptclass'  => $this->applicationModel->getAllActiveClass(),
            'region'  => $this->applicationModel->getAllRegion(),
            'student_program' => $this->applicationModel->getAllActiveProgram(),
            'student_special_program' => $this->applicationModel->getspecialprogram(),
            'payment_type' => $this->applicationModel->getpaymentType(),
            'campaigns'  => $this->applicationModel->getAllCampaigns(),
            'transcriptgrades' => $this->applicationModel->getAllGradesTranscript(),
            'certificate' => $this->applicationModel->getAllActiveCertificate(),
            'contacttype' => $this->applicationModel->getActiveContactType(),
            'country' => $this->scbvModel->get_country(),   // Duplicate of data['country'], keep only if used separately
            'states' => $this->scbvModel->get_all_states(), // Duplicate of data['states'], keep only if needed separately
            'address_type' => $this->applicationModel->get_address_type(), // Duplicate
        ];

        $role = session()->get('role');
        $profiles = session()->get('profiles') ?? [];

        if ($role == 1 || in_array(7, $profiles) || in_array(8, $profiles)) {
            $data['content'] = 'backend/view_Applicant_users';
            return view('backend/index', $data);
        } else {
            $profiles = session()->get('profiles') ?? [];

            if (in_array(1, $profiles) || in_array(2, $profiles)) {
                return redirect()->to(site_url('admin/master/addClass'));
            } else if (in_array(5, $profiles) || in_array(6, $profiles)) {
                return redirect()->to(site_url('admin/reports/employmentListing'));
            } else if (in_array(9, $profiles)) {
                return redirect()->to(site_url('admin/timesheet/attendance'));
            } else if (in_array(10, $profiles)) {
                return redirect()->to(site_url('admin/users/contract'));
            } else if (in_array(3, $profiles) || in_array(4, $profiles)) {
                return redirect()->to(site_url('admin/form/dashboard'));
            } else {
                return redirect()->to(site_url('admin/timesheet/attendance'));
            }
        }
    }

    function getNameList()
    {
        $postData = $this->request->getPost();
        $data = $this->applicationModel->getNameList($postData);

        echo json_encode($data);


        // return $this->response->setJSON([
        //     'aaData' => $data,
        //     'csrfName' => csrf_token(),
        //     'csrfHash' => csrf_hash()
        // ]);
    }

    function ViewApp($ID)
    {
        $class = $this->request->getPost('classname');
        $semester = $this->request->getPost('semester'); 
        $student_rows = $this->applicationModel->checkStudentRecord($ID);
        if ($student_rows == 0) {
            redirect('admin/Form');
        } else {
            $data['country'] = $this->scbvModel->get_country();
            $data['states'] = $this->scbvModel->get_all_states();
            $infos = $this->applicationModel->getApplicantByID($ID);
            $data['student_info'] = $this->applicationModel->getStudentInfoDetails($ID);
            $data['enrolled_class_semester'] = $this->applicationModel->enrolled_class_semester($ID, $class, $semester);

            $data['enrolled_cert__class_semester'] = $this->applicationModel->enrolled_class_semester_in_certificate($ID, $class, $semester);
            $data['get_all_transaction'] = $this->applicationModel->get_all_transaction_by_student_id($ID);
            $data['donation'] = $this->applicationModel->getDonationDetails($ID);
            $data['without_tuition_donation'] = $this->applicationModel->getWithoutTuitionDonationDetails($ID);
            $data['contract_employee'] = $this->applicationModel->contract_employee($ID);

            $data['studentcurriculumgpa'] =   $this->reportModel->getCompleteGPAnew($ID);

            $data['quality_point'] =    $this->reportModel->getTransciptDetailByStudent($ID);

            $data['total_credit'] = $this->reportModel->gettotalCreditattempt($ID);

            //$data['studenttranscriptgpa'] = $this->reportModel->getCompleteGPA($ID);

            $data['infos'] = !empty($infos) ? $infos[0] : array();

            //echo "<pre>"; print_r($data['student_curriculum_gpa']); die();

            $data['studentid'] = $ID;
            //$address = $this->applicationModel->getAddressByID($ID);
            $data['address'] = getAddress($ID);/* 
			$infos = $this->applicationModel->getApplicantByID($ID);
			$data['infos'] = getPassport($ID); */
            //$group = $this->applicationModel->getGroupByID($ID);
            $data['group'] = getGroups($ID);
            //$email = $this->applicationModel->getEmailByID($ID);
            $data['email'] = getEmail($ID);
            $data['region'] = $this->applicationModel->getAllRegion();
            $data['completeregion'] = $this->applicationModel->getCompleteRegion();
            //echo "<pre>"; print_r($data['completeregion']);
            $data['studentinformation'] = $this->applicationModel->getStudentName($ID);
            $data['transcriptgrades'] = $this->applicationModel->getAllGradesTranscript();
            $data['transcriptclass'] = $this->applicationModel->getAllActiveClass();
            $data['editclass'] = $this->applicationModel->getAllClass();
            $data['student_program'] = $this->applicationModel->getAllActiveProgram();
            $data['student_special_program'] = $this->applicationModel->getspecialprogram();
            $data['student'] = getStudentInfo($ID);
            $data['user'] = getDonationPayment($ID);
            $data['certificate'] = $this->applicationModel->getAllActiveCertificate();
            $data['payment_type'] = $this->applicationModel->getpaymentType();
            $data['campaigns'] = $this->applicationModel->getAllCampaigns();
            $data['trans'] = $this->applicationModel->getTranscriptByID($ID);
            $data['grades'] = $this->applicationModel->getAllactiveGrade();
            $data['contacttype'] = $this->applicationModel->getActiveContactType();
            $data['studentrecord'] = $this->applicationModel->getStudentRecord();
            $data['employmentrecord'] = $this->applicationModel->getEmploymentRecord();
            $data['employee'] = $this->applicationModel->getEmployeeRecord($ID);
            $data['scholarship_applications'] = $this->applicationModel->getScholarshipApplications($ID);
            $data['student_enroll_class_semester'] = $this->applicationModel->get_student_enroll_class_semester($ID);
            $data['student_finance_course'] = $this->applicationModel->get_student_finance_detail2($ID);
            $data['all_scholarships'] = $this->applicationModel->get_all_scholarship();
            $data['student_finance_certificate'] = $this->applicationModel->get_student_finance_certificate($ID);
            $data['selected_filter_year'] = $this->request->getPost('filter_year');
            $data['selected_filter_semester'] = $this->request->getPost('filter_semester');
            if ($this->request->getPost('filter_year') != '') {
                $data['semester_acc_class'] = $this->applicationModel->getSemester($this->request->getPost('filter_year'));
            } else {
                $data['semester_acc_class'] = array();
            }
            $data['assign_class'] = $this->applicationModel->assign_class($ID);
            $data['cert_assign_class'] = $this->applicationModel->cert_assign_class($ID);
            $data['all_organization'] = $this->applicationModel->getAllActiveOrganization();
            $data['assign_organization'] = $this->applicationModel->getAssignOrganization($ID);
            $data['patner_organizations'] = $this->applicationModel->getAllActivePartner();
            $data['check_graduation'] = $this->applicationModel->check_graduation($ID);
            $data['check_current_employee'] = $this->applicationModel->check_current_employee($ID);
            $data['phonetypes'] = $this->applicationModel->get_all_phone_type();
            $data['allnumbers'] = $this->applicationModel->get_all_user_number($ID);
            $data['address_type'] = $this->applicationModel->get_address_type();
            $data['emp'] = getEmployment($ID);
            $data['form_id'] = $ID;
            $data['tracks'] = $this->applicationModel->get_active_track();
            $data['getContactTag'] = $this->applicationModel->get_user_conatct_tag_details($ID);
            // organization
            $data['allOrganization'] = $this->applicationModel->getAllOrganization();
            $data['allOrgRelationship'] = $this->applicationModel->allOrgRelationship();
            $data['assign_crm_list'] = $this->applicationModel->get_crm_organization_by_userid($ID);
            $data['contactAttachment'] = $this->applicationModel->getContactAttachment($ID);
            $data['allContact']  = $this->applicationModel->getAllContact();
            $data['content'] = 'backend/addForm';
            $data['page'] = '';
            $data['data'] = $data;
            return view('backend/index', $data);
        }
    }



    function set_add_more_USPhone_html()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $all_organization = $this->applicationModel->getAllActiveOrganization();
            $phonetypes = $this->applicationModel->get_all_phone_type();
            $counter = $this->request->getPost('counter');

            echo '<td>';
            echo '<input value="" type="hidden" name="US_RowID[' . $counter . ']" >';
            echo '<select  class="form-control  phonevalidate" name="phonetype[' . $counter . ']" id="phonetype' . $counter . '">';
            echo '<option value="">Select Phone</option>';
            foreach ($phonetypes as $pt) {
                echo '<option value="' . $pt['Id'] . '">' . $pt['PhoneType'] . '</option>';
            }
            echo '</select>';
            echo '</td>';
            echo '<td>';
            echo '<input  class="USPhoneNumber phonetype form-control phonevalidate"  type="text" name="USPhoneNumber[' . $counter . ']"  id="USPhoneNumber' . $counter . '" rel_id="' . $counter . '">';
            echo '</td>';
            echo '<td>';
            echo '<input class="no_decimal form-control"  type="text" name="Extension[' . $counter . ']"  id="Extension' . $counter . '">';
            echo '</td>';
            echo '<td>';
            echo '<input value="1" type="checkbox" name="USActive[' . $counter . ']" id="USstatus' . $counter . '" checked="true">';
            echo '</td>';
        }
    }

    function get_student_tab_data()
    {
        $class = $this->request->getPost('classname');
        $semester = $this->request->getPost('semester');
        $ID = $this->request->getPost('student_id');
        $data['student_id'] = $this->request->getPost('student_id');
        $student_rows = $this->applicationModel->checkStudentRecord($ID);
        if ($student_rows == 0) {
            redirect('admin/Form');
        } else {
            $data['country'] = $this->scbvModel->get_country();
            $data['states'] = $this->scbvModel->get_all_states();
            $infos = $this->applicationModel->getApplicantByID($ID);
            $data['student_info'] = $this->applicationModel->getStudentInfoDetails($ID);
            $data['tracks'] = $this->applicationModel->get_active_track();
            $data['enrolled_class_semester'] = $this->applicationModel->enrolled_class_semester($ID, $class, $semester);
            $data['enrolled_cert__class_semester'] = $this->applicationModel->enrolled_class_semester_in_certificate($ID, $class, $semester);
            $data['get_all_transaction'] = $this->applicationModel->get_all_transaction_by_student_id($ID);
            $data['donation'] = $this->applicationModel->getDonationDetails($ID);
            $data['without_tuition_donation'] = $this->applicationModel->getWithoutTuitionDonationDetails($ID);
            $data['contract_employee'] = $this->applicationModel->contract_employee($ID);
            $data['studentcurriculumgpa'] =   $this->reportModel->getCompleteGPAnew($ID);
            $data['quality_point'] =    $this->reportModel->getTransciptDetailByStudent($ID);
            $data['total_credit'] = $this->reportModel->gettotalCreditattempt($ID);
            $data['infos'] = !empty($infos) ? $infos[0] : array();
            $data['studentid'] = $ID;
            $data['address'] = getAddress($ID);
            //$group = $this->applicationModel->getGroupByID($ID);
            $data['group'] = getGroups($ID);
            //$email = $this->applicationModel->getEmailByID($ID);
            $data['email'] = getEmail($ID);
            $data['region'] = $this->applicationModel->getAllRegion();
            $data['completeregion'] = $this->applicationModel->getCompleteRegion();
            $data['studentinformation'] = $this->applicationModel->getStudentName($ID);
            $data['transcriptgrades'] = $this->applicationModel->getAllGradesTranscript();
            $data['transcriptclass'] = $this->applicationModel->getAllActiveClass();
            $data['editclass'] = $this->applicationModel->getAllClass();
            $data['student_program'] = $this->applicationModel->getAllActiveProgram();
            $data['student_special_program'] = $this->applicationModel->getspecialprogram();
            $data['student'] = getStudentInfo($ID);
            $data['user'] = getDonationPayment($ID);
            $data['certificate'] = $this->applicationModel->getAllActiveCertificate();
            $data['payment_type'] = $this->applicationModel->getpaymentType();
            $data['campaigns'] = $this->applicationModel->getAllCampaigns();
            $data['trans'] = $this->applicationModel->getTranscriptByID($ID);
            $data['grades'] = $this->applicationModel->getAllactiveGrade();
            $data['contacttype'] = $this->applicationModel->getActiveContactType();
            $data['studentrecord'] = $this->applicationModel->getStudentRecord();
            $data['employmentrecord'] = $this->applicationModel->getEmploymentRecord();
            $data['employee'] = $this->applicationModel->getEmployeeRecord($ID);
            $data['scholarship_applications'] = $this->applicationModel->getScholarshipApplications($ID); 
            $data['student_enroll_class_semester'] = $this->applicationModel->get_student_enroll_class_semester($ID);
            $data['student_finance_course'] = $this->applicationModel->get_student_finance_detail2($ID);
            $data['all_scholarships'] = $this->applicationModel->get_all_scholarship();
            $data['student_finance_certificate'] = $this->applicationModel->get_student_finance_certificate($ID);
            $data['selected_filter_year'] = $this->request->getPost('filter_year');
            $data['selected_filter_semester'] = $this->request->getPost('filter_semester');
            $data['address_type'] = $this->applicationModel->get_address_type();
            if ($this->request->getPost('filter_year') != '') {
                $data['semester_acc_class'] = $this->applicationModel->getSemester($this->request->getPost('filter_year'));
            } else {
                $data['semester_acc_class'] = array();
            }
            $data['assign_class'] = $this->applicationModel->assign_class($ID);

            $data['cert_assign_class'] = $this->applicationModel->cert_assign_class($ID);

            $data['all_organization'] = $this->applicationModel->getAllActiveOrganization();
            $data['assign_organization'] = $this->applicationModel->getAssignOrganization($ID);

            $data['patner_organizations'] = $this->applicationModel->getAllActivePartner();

            $data['check_graduation'] = $this->applicationModel->check_graduation($ID);

            $data['check_current_employee'] = $this->applicationModel->check_current_employee($ID);

            // By PRabhat 07-01-2021
            $data['phonetypes'] = $this->applicationModel->get_all_phone_type();
            $data['allnumbers'] = $this->applicationModel->get_all_user_number($ID);

            // $data['emp'] = getEmploymentRecord($ID);
            $data['components'] = $this->applicationModel->get_component(2);
            // Change Start by Prabhat 28-09-2023 Fwd: Database - New Check box
            $data['getContactTag'] = $this->applicationModel->get_user_conatct_tag_details($ID);

            $data['form_id'] = $ID;

            $data['page'] = '';
            $data['data'] = $data;
            return view('backend/addFormTab', $data);
        }
    }


    function header_part()
    {
        $studentid = $ID = $this->request->getPost('student_id');
        $studentinformation = $this->applicationModel->getStudentName($ID);
        $data['student_information'] = $studentinformation;
        $data['donation'] = $this->applicationModel->getDonationDetails($ID);
        $data['without_tuition_donation'] = $this->applicationModel->getWithoutTuitionDonationDetails($ID);
        $data['contract_employee'] = $this->applicationModel->contract_employee($ID);
        $data['patner_organizations'] = $this->applicationModel->getAllActivePartner();
        $data['check_graduation'] = $this->applicationModel->check_graduation($ID);
        $data['check_current_employee'] = $this->applicationModel->check_current_employee($ID);
        $data['student_info'] = $this->applicationModel->getStudentInfoDetails($ID);
        $groups = $data['group'] = getGroups($ID);
        echo '<input type="hidden" id="employee_id" value="' . $studentid . '">';
        if (isset($studentinformation)) {


            $student_name = $studentinformation['FirstName'] . " " . $studentinformation['LastName'] . " - $studentid";
            echo '<span class="user_name">' . $student_name . '</span>';
            $donor_status = true;
            $fac_status = true;
            echo '<span class="header_button">';
            if (!empty($data['without_tuition_donation'])) {
                $donor_status = false;
                echo '<button  class="themeBtn Donor_button" data-name="Donor">Donor</button>';
            }
            if (!empty($data['check_graduation'])) {
                echo '<button  class="themeBtn student_button">Alum</button>';
            } else if (!empty($data['student_info'])) {
                echo '<button  class="themeBtn student_button">Student</button>';
            }
            if (!empty($data['check_current_employee'])) {
                echo '<button  class="themeBtn_no_res" data-name="FacultyStaff" style="color:#fff;">Current Employee </button>';
            } else if (!empty($data['contract_employee'])) {
                echo '<button  class="themeBtn_no_res" data-name="FacultyStaff" style="color:#fff;"> Former Employee </button>';
            }

            if ($groups[0]['Foundation'] == '1') {
                echo '<button class="themeBtn Foundation_button" data-name="Foundation">Grantmaker Affiliate <i class="fa fa-times remove_button" rel_name="Foundation_button" ></i></button>';
            }
            if ($groups[0]['Media'] == '1') {
                echo '<button class="themeBtn Media_button" data-name="Media">Media <i class="fa fa-times remove_button" rel_name="Media_button"></i></button>';
            }
            if ($groups[0]['Appalachian'] == '1') {
                echo '<button class="themeBtn Appalachian_button" data-name="Appalachian">Appalachian Program <i class="fa fa-times remove_button" rel_name="Appalachian_button"></i></button>';
            }
            if ($groups[0]['BoardMember'] == '1') {
                echo '<button class="themeBtn BoardMember_button" data-name="BoardMember">Past & Present Board Members <i class="fa fa-times remove_button" rel_name="BoardMember_button"></i></button>';
            }
            if ($groups[0]['FacultyStaff'] == '1' && $fac_status) {
                echo '<button class="themeBtn FacultyStaff_button" data-name="FacultyStaff">Past & Present Faculty & Staff <i class="fa fa-times remove_button" rel_name="FacultyStaff_button"></i></button>';
            }
            if ($groups[0]['StudentFamily'] == '1') {
                echo '<button class="themeBtn StudentFamily_button" data-name="StudentFamily">Past & Present Student Family <i class="fa fa-times remove_button" rel_name="StudentFamily_button"></i></button>';
            }
            if ($groups[0]['AnnualReport'] == '1') {
            }
            if ($groups[0]['DanielVIP'] == '1') {
                echo '<button class="themeBtn DanielVIP_button" data-name="DanielVIP">VIP <i class="fa fa-times remove_button" rel_name="DanielVIP_button"></i></button>';
            }
            if ($groups[0]['FriendofDaniel'] == '1') {
                echo '<button class="themeBtn FriendofDaniel_button" data-name="FriendofDaniel">Friend of Daniel/ Not VIP <i class="fa fa-times remove_button" rel_name="FriendofDaniel_button"></i></button>';
            }
            if ($groups[0]['DanielPermissionNeeded'] == '1') {
            }
            if ($groups[0]['GraduationInvite'] == '1') {
            }
            if ($groups[0]['QuarterCenturyReport'] == '1') {
            }
            if ($groups[0]['Unsubscribed'] == '1') {
            }
            if ($studentinformation['Deceased'] == '1') {
                echo '<button class="themeBtn Deceased_button" data-name="Deceased">Deceased <i class="fa fa-times remove_button" rel_name="Deceased_button"></i></button>';
            }
            if ($groups[0]['Vista'] == '1') {
                echo '<button class="themeBtn Vista_button" data-name="Vista">Vista <i class="fa fa-times remove_button" rel_name="Vista_button"></i></button>';
            }

            if ($data['group'][0]['tribal_college'] == '1') {
                echo '<button class="themeBtn TribalCollege_button" data-name="tribal_college">Tribal College <i class="fa fa-times remove_button" rel_name="TribalCollege_button"></i></button>';
            }
            if ($data['group'][0]['hbcu'] == '1') {
                echo '<button class="themeBtn HBCU_button" data-name="hbcu">HBCU <i class="fa fa-times remove_button" rel_name="HBCU_button"></i></button>';
            }
            if ($data['group'][0]['wv_college'] == '1') {
                echo '<button class="themeBtn WVCollege_button" data-name="wv_college">WV College <i class="fa fa-times remove_button" rel_name="WVCollege_button"></i></button>';
            }
            if ($data['group'][0]['appalachia_college'] == '1') {
                echo '<button class="themeBtn AppalachiaCollege_button" data-name="appalachia_college">Appalachia College <i class="fa fa-times remove_button" rel_name="AppalachiaCollege_button"></i></button>';
            }
            if ($data['group'][0]['us_college'] == '1') {
                echo '<button class="themeBtn USCollege_button" data-name="us_college">US College <i class="fa fa-times remove_button" rel_name="USCollege_button"></i></button>';
            }
            if ($data['group'][0]['americorps'] == '1') {
                echo '<button class="themeBtn AmeriCorps_button" data-name="americorps">AmeriCorps <i class="fa fa-times remove_button" rel_name="AmeriCorps_button"></i></button>';
            }
            if ($data['group'][0]['peacecorps'] == '1') {
                echo '<button class="themeBtn PeaceCorps_button" data-name="peacecorps">PeaceCorps <i class="fa fa-times remove_button" rel_name="PeaceCorps_button"></i></button>';
            }
            /* end 08-02-2024 */
            if ($data['group'][0]['accthold'] == '1') {
                echo '<button class="themeBtn AcctHold_button" data-name="accthold">Acct Hold <i class="fa fa-times remove_button" rel_name="AcctHold_button"></i></button>';
            }
            echo '</span>';
            $data['donor_status'] = $donor_status;
            $data['fac_status']  = $fac_status;
            return view('templates/show_group_in_pop_up', $data);
            echo '</div>';
        }
    }

    function submitUserRole()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $data_history = $this->applicationModel->update_group_history();
            if ($data_history) {
                $data = $this->applicationModel->submitUserRole();
                if ($data) {
                    echo json_encode(true);
                } else {
                    echo json_encode(false);
                }
            }
        }
    }

    function get_all_country()
    {
        $country = $this->scbvModel->get_country();

        echo json_encode(array('country' => $country));
    }

    public function relationships()
    {
        if (
            session()->get('role') != 1 &&
            !(in_array(3, session()->get('profiles') ?? []) || in_array(4, session()->get('profiles') ?? []))
        ) {
            exit("Please Contact To Administrator");
        }

        $data['organizationList'] = $this->applicationModel->getAllOrganization();
        $data['individualList'] = $this->applicationModel->getAllIndividual();
        $data['country'] = $this->scbvModel->get_country();
        $data['states'] = $this->scbvModel->get_all_states();
        $data['phonetypes'] = $this->applicationModel->get_all_phone_type();
        $data['address_type'] = $this->applicationModel->get_address_type();
        $data['organizationLabel'] = $this->applicationModel->get_organization_labels();
        $data['payment_type'] = $this->applicationModel->getpaymentType();
        $data['campaigns'] = $this->applicationModel->getAllCampaigns();
        $data['page'] = '';

        $data['content'] = 'backend/relationship_ind_org';

        return view('backend/index', $data);
    }

    function OrganizationList()
    {
        $data['content'] = 'backend/organizationlist';
        $data['organizationList'] = $this->applicationModel->getAllOrganization();
        $data['page'] = '';
        return view('backend/index', $data);
    }

    function addOrganization()
    {
        $data['country'] = $this->scbvModel->get_country();
        $data['states'] = $this->scbvModel->get_all_states();
        $data['phonetypes'] = $this->applicationModel->get_all_phone_type();
        $data['address_type'] = $this->applicationModel->get_address_type();
        $data['organizationLabel'] = $this->applicationModel->get_organization_labels();
        $data['payment_type'] = $this->applicationModel->getpaymentType();
        $data['campaigns'] = $this->applicationModel->getAllCampaigns();
        $data['addressDetails'] = array();
        $data['internationAddressDetails'] = array();
        $data['form_id'] = '';
        $data['content'] = 'backend/addOrganization';
        $data['page'] = '';
        return view('backend/index', $data);
    }

    function submitOrganization()
    {
        $post = $this->request->getPost();
        $ID = $post['id'] != '' ? $post['id'] : '';
        $validation = \Config\Services::validation();
        if ($post['submit'] == 'name') {
            $validation->setRules([
                'org_name' => 'required|trim'
            ]);
            $form_validation = $validation->withRequest($this->request)->run();
            if ($form_validation == FALSE) {
                $data['errors'] = validation_errors();
                session()->setFlashdata('post', $post);
                session()->setFlashdata('msg', '<div class="alert alert-danger">' . $data['errors'] . '</div>');
                if ($ID == '') {
                    echo $data['errors'];
                    // redirect('admin/Form/OrganizationList');
                } else {
                    echo $data['errors'];
                    // redirect('admin/Form/editOrganization/'.encryptor('encrypt', $ID));
                }
            } else {
                if (isset($post['submit'])) {
                    $param = array(
                        'ID' => $post['id'],
                        'name' => $post['org_name'],
                        'website' => $post['website'],
                        'org_note' => $post['organization_note'],
                        'org_position' => $post['org_position'],
                        'created_by' => session()->get('USER_ID'),
                        'created_ip' => actual_ip()
                    );
                    if ($ID == '') {
                        $response = $this->applicationModel->insertOrganizationInfo($param);
                    } elseif ($ID != '') {
                        $param['ID'] = $post['id'];
                        $response = $this->applicationModel->updateOrganizationInfo($param);
                    }
                    $ID = isset($response['last_id']) ? $response['last_id'] : $ID;
                    if ($response['msg'] == "INSERTED" || $response['msg'] == "UPDATED") {

                        // $this->applicationModel->insert_or_update_organization_label($ID);

                        // Address Save
                        $address_length = sizeof($this->request->getPost('Street_Address'));
                        $validate_array = array();
                        $validate_array[] = $post['Street_Address'];
                        $validate_array[] = $post['City'];
                        $validate_array[] = $post['Country'];
                        //$validate_array[] = $post['addressType'];
                        $res = empty_search($validate_array);

                        if ($res['save'] == 1 && $res['status'] == 1) {
                            for ($i = 1; $i <= $address_length; $i++) {
                                $address_param['Address_RowID'] = $post['Address_RowID'][$i];
                                $address_param['Street_Address'] = $post['Street_Address'][$i];
                                $address_param['Address2'] = $post['Address2'][$i];
                                $address_param['City'] = $post['City'][$i];
                                $address_param['State'] = $post['State'][$i];
                                $address_param['Postal_Code'] = $post['Postal_Code'][$i];
                                $address_param['Country'] = $post['Country'][$i];
                                //$address_param['addressType'] = $post['addressType'][$i];
                                $address_param['physical_status'] = isset($post['physical'][$i]) ? '1' : '0';
                                $address_param['mailing_status'] = isset($post['mailing'][$i]) ? '1' : '0';
                                $address_param['AddressID'] = $ID;
                                $address_param['Active'] = isset($post['Active'][$i]) ? $post['Active'][$i] : 0;
                                if ($address_param['Address_RowID'] == '') {
                                    unset($address_param['Address_RowID']);
                                    $response_add = $this->applicationModel->insertOrgnanizationAddressInfo($address_param);
                                } elseif ($ID != '') {
                                    $response_add = $this->applicationModel->updateOrgnanizationAddressInfo($address_param);
                                }
                                if (!empty($response_add)) {
                                    if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
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
                            session()->setFlashdata('post', $post); //for post the data auto filled
                            session()->setFlashdata('msg', '<div class="alert alert-danger">Please fill all mandatory details in address.</div>');
                            if ($ID == '') {
                                if ($this->request->getPost('callType') == 'ajax') {
                                    session()->remove('msg');
                                    echo "Please fill all mandatory details in address";
                                } else {
                                    redirect('admin/Form/relationships');
                                }
                            } else {
                                if ($this->request->getPost('callType') == 'ajax') {
                                    session()->remove('msg');
                                    echo "Please fill all mandatory details in address";
                                } else {
                                    redirect('admin/Form/relationships');
                                }
                            }
                        }
                        $post = $this->request->getPost();
                        $address_length = sizeof($this->request->getPost('address1'));
                        $validate_array = array();
                        $validate_array[] = $post['interaddressType'];



                        for ($i = 1; $i <= $address_length; $i++) {
                            if ($post['address1'][$i] != '' || $post['address2'][$i] != '' || $post['address3'][$i] != '' || $post['inter_Country'][$i] != '' || $post['inter_City'][$i] != '')
                                $address_param1['Address_RowID_int'] = $post['inter_Address_RowID'][$i];
                            $address_param1['address1'] = $post['address1'][$i];
                            $address_param1['address2'] = $post['address2'][$i];
                            $address_param1['address3'] = $post['address3'][$i];
                            $address_param1['Country_int'] = $post['inter_Country'][$i];
                            $address_param1['City_int']  = $post['inter_City'][$i];
                            $address_param1['AddressID_int'] = $ID;
                            //$address_param1['AddressType'] = $post['interaddressType'][$i];
                            $address_param['physical_status'] = isset($post['inter_physical'][$i]) ? '1' : '0';
                            $address_param['mailing_status'] = isset($post['inter_mailing'][$i]) ? '1' : '0';
                            $address_param1['Active_int'] = isset($post['inter_Active'][$i]) ? $post['inter_Active'][$i] : 0;
                            if ($address_param1['Address_RowID_int'] == '0' || $address_param1['Address_RowID_int'] == '') {
                                $response_add = $this->applicationModel->insertOrrganizationInterAddInfo($address_param1);
                            } elseif ($address_param1['Address_RowID_int'] != '0') {
                                date_default_timezone_set("America/New_York");
                                $address_param1['modified_at']  = date("Y-m-d h:i:s");
                                $response_add = $this->applicationModel->updateOrganizationInterAddInfo($address_param1);
                            }
                            if (!empty($response_add)) {
                                if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
                                    $response['msg'] = 'Record Updated';
                                } elseif ($response_add['msg'] == 'Record Already Exists') {
                                    $response['status'] = false;
                                    $response['msg'] = $response_add['msg'];
                                } else {
                                    $response['status'] = false;
                                    $response['msg'] = 'Record not saved/update';
                                }
                            } else {
                                $response['status'] = false;
                                $response['msg'] = 'Record not saved/update';
                            }
                        }



                        $phone_length = sizeof($post['phonetype']);
                        $phone_param = array();
                        if ($phone_length > 0) {
                            for ($i = 1; $i <= $phone_length; $i++) {
                                if ($post['USPhoneNumber'][$i] != '') {
                                    $phone_param['AutoId'] = $post['US_RowID'][$i];
                                    $phone_param['Id'] = $ID;
                                    $phone_param['Type'] = $post['phonetype'][$i];
                                    $phone_param['Number'] = $post['USPhoneNumber'][$i];
                                    $phone_param['Extension'] = $post['Extension'][$i];
                                    $phone_param['createdby']  = session()->get('USER_ID');
                                    $active_phone = $phone_param['Active'] = $post['USActive'][$i];
                                    if ($active_phone != "") {
                                        $phone_param['Active'] = $post['USActive'][$i];
                                    } else {
                                        $phone_param['Active'] = 0;
                                    }
                                    if ($phone_param['AutoId'] == '') {
                                        unset($phone_param['AutoId']);
                                        $phone_response = $this->applicationModel->insertOrganizationPhoneInfo($phone_param);
                                    } elseif ($phone_param['AutoId'] != '') {
                                        $phone_response = $this->applicationModel->updateOrganizationPhoneInfo($phone_param);
                                    }

                                    if (!empty($phone_response)) {
                                        if ($phone_response['msg'] == 'UPDATED' || $phone_response['msg'] == 'INSERTED') {
                                            $response['status'] = true;
                                            $response['msg'] = 'Phone Updated';
                                        } elseif ($phone_response['msg'] == 'Record Already Exists') {
                                            $response['status'] = false;
                                            $response['msg'] = $phone_response['msg'];
                                        } else {
                                            $response['status'] = false;
                                            $response['msg'] = 'Phone not saved/update';
                                        }
                                    } else {
                                        $response['status'] = false;
                                        $response['msg'] = 'Phone not saved/update';
                                    }
                                }
                            }
                        } else {
                            $response['status'] = false;
                            $response['msg'] = 'Phone Not Save';
                        }

                        session()->setFlashdata('msg', '<div class="alert alert-success">' . $response['msg'] . '</div>');
                        if ($this->request->getPost('callType') == 'ajax') {
                            session()->remove('msg');
                            echo $response['msg'];
                        } else {
                            redirect('admin/Form/relationships');
                        }
                    } else {

                        session()->setFlashdata('post', $post); //for post the data auto filled
                        session()->setFlashdata('msg', '<div class="alert alert-danger">There is some Error Occurred in Submission. Please try later.</div>');
                        if ($this->request->getPost('callType') == 'ajax') {
                            session()->remove('msg');
                            echo "There is some Error Occurred in Submission. Please try later";
                        } else {
                            redirect('admin/Form/relationships');
                        }
                    }
                }
            }
        } elseif ($post['submit'] == 'address') {


            $rules = [
                'Street_Address.*'         => 'required|trim',
                'Address2.*'               => 'permit_empty|trim',
                'City.*'                   => 'required|trim',
                'State.*'                  => 'permit_empty|trim',
                'Postal_Code.*'            => 'permit_empty|trim',
                'Country.*'                => 'required|trim',
                'Active.*'                 => 'permit_empty|trim',  // FIXED HERE
            ];


            $validation->setRules($rules);

            $form_validation = $validation->withRequest($this->request)->run();
            $post = $this->request->getPost();
            if ($form_validation == FALSE) {
                $data['errors'] = validation_errors();
                session()->setFlashdata('post', $post);
                session()->setFlashdata('msg', '<div class="alert alert-danger">' . $data['errors'] . '</div>');
                if ($this->request->getPost('callType') == 'ajax') {
                    session()->remove('msg');
                    echo $data['errors'];
                } else if ($ID == '') {
                    redirect('admin/Form/OrganizationList');
                } else {
                    redirect('admin/Form/editOrganization/' . encryptor('encrypt', $ID));
                }
            } else {

                $response = [];
                $address_length = sizeof($this->request->getPost('Street_Address'));
                //$res = empty_search($validate_array);
                //if ($res['save'] == 1 && $res['status'] == 1) {
                for ($i = 1; $i <= $address_length; $i++) {
                    $address_param = array();
                    $address_param['Address_RowID'] = $post['Address_RowID'][$i];
                    $address_param['Street_Address'] = $post['Street_Address'][$i];
                    $address_param['Address2'] = $post['Address2'][$i];
                    $address_param['City'] = $post['City'][$i];
                    $address_param['State'] = $post['State'][$i];
                    $address_param['Postal_Code'] = $post['Postal_Code'][$i];
                    $address_param['Country'] = $post['Country'][$i];
                    //$address_param['addressType'] = $post['addressType'][$i];
                    $address_param['physical_status'] = isset($post['physical'][$i]) ? '1' : '0';
                    $address_param['mailing_status'] = isset($post['mailing'][$i]) ? '1' : '0';
                    $address_param['AddressID'] = $ID;
                    $address_param['Active'] = isset($post['Active'][$i]) ? $post['Active'][$i] : 0;

                    if ($address_param['Address_RowID'] == '') {
                        unset($address_param['Address_RowID']);

                        $response_add = $this->applicationModel->insertOrgnanizationAddressInfo($address_param);
                    } elseif ($ID != '') {
                        $response_add = $this->applicationModel->updateOrgnanizationAddressInfo($address_param);
                    }
                    if (!empty($response_add)) {
                        if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
                            $response['msg'] = $response_add['msg'] . "\n";
                        } elseif ($response_add['msg'] == 'Record Already Exists') {
                            $response['status'] = false;
                            $response['msg'] .= $response_add['msg'] . '\n';
                        } else {
                            $response['status'] = false;
                            $response['msg'] .= 'Address not saved/update<br>';
                        }
                    } else {
                        $response['status'] = false;
                        $response['msg'] .= 'Address not saved/update<br>';
                    }
                }

                if ($this->request->getPost('callType') == 'ajax') {
                    session()->remove('msg');
                    echo $response['msg'];
                } else {

                    session()->setFlashdata('msg', '<div class="alert alert-success">Address Updated</div>');
                    return redirect()->to('admin/Form/editOrganization/' . encryptor('encrypt', $ID));
                }
            }
        } elseif ($post['submit'] == 'USPhone') {
            $response['status'] = false;
            $response['msg'] = '';
            // echo"<'pre'>";print_r($this->request->getPost());'<pre>';
            $post = $this->request->getPost();
            $phone_length = sizeof($post['phonetype']);
            $phone_param = array();
            if ($phone_length > 0) {
                for ($i = 1; $i <= $phone_length; $i++) {
                    if (isset($post['USPhoneNumber'][$i]) && $post['USPhoneNumber'][$i] != '') {
                        $phone_param['AutoId'] = $post['US_RowID'][$i] ?? null;
                        $phone_param['Id'] = $ID;
                        $phone_param['Type'] = $post['phonetype'][$i] ?? null;
                        $phone_param['Number'] = $post['USPhoneNumber'][$i] ?? null;
                        $phone_param['Extension'] = $post['Extension'][$i] ?? null;
                        $phone_param['createdby']  = session()->get('USER_ID');
                        $active_phone = $phone_param['Active'] = $post['USActive'][$i] ?? null;
                        if ($active_phone != "") {
                            $phone_param['Active'] = $post['USActive'][$i];
                        } else {
                            $phone_param['Active'] = 0;
                        }
                        if ($phone_param['AutoId'] == '') {
                            unset($phone_param['AutoId']);
                            $phone_response = $this->applicationModel->insertOrganizationPhoneInfo($phone_param);
                        } elseif ($phone_param['AutoId'] != '') {
                            $phone_response = $this->applicationModel->updateOrganizationPhoneInfo($phone_param);
                        }

                        if (!empty($phone_response)) {
                            if ($phone_response['msg'] == 'UPDATED' || $phone_response['msg'] == 'INSERTED') {
                                $response['status'] = true;
                                $response['msg'] = 'Phone Updated';
                            } elseif ($phone_response['msg'] == 'Record Already Exists') {
                                $response['status'] = false;
                                $response['msg'] = $phone_response['msg'];
                            } else {
                                $response['status'] = false;
                                $response['msg'] = 'Phone not saved/update';
                            }
                        } else {
                            $response['status'] = false;
                            $response['msg'] = 'Phone not saved/update';
                        }
                    }
                }
            } else {
                $response['status'] = false;
                $response['msg'] = 'Phone Not Save';
            }
            if ($this->request->getPost('callType') == 'ajax') {
                session()->remove('msg');
                echo json_encode($response['msg']);
            } else {
                session()->setFlashdata('msg', '<div class="alert alert-success">' . $response['msg'] . '</div>');
                return redirect()->to('admin/Form/editOrganization/' . encryptor('encrypt', $ID));
            }
        } elseif ($post['submit'] == 'inter_address') {
            // $this->form_validation->set_rules('interaddressType[]','interaddressType','trim|required|xss_clean');
            $form_validation = $validation->withRequest($this->request)->run();
            $post = $this->request->getPost();
            // 	 if($form_validation==FALSE){
            // 		$data['errors'] = validation_errors();
            // 		session()->setFlashdata('post',$post);
            // 		session()->setFlashdata('msg','<div class="alert alert-danger">'.$data['errors'].'</div>');		        
            // 		if($ID == ''){

            // 		    if($this->request->getPost('callType')=='ajax'){
            // 		        echo $data['errors'];
            // 		    }
            // 		    else{
            // 		        return redirect()->to('admin/Form/OrganizationList');    
            // 		    }

            // 		}else{

            // 		     if($this->request->getPost('callType')=='ajax'){
            // 		        echo $data['errors'];
            // 		    }
            // 		    else{
            // 		        return redirect()->to('admin/Form/editOrganization/'.encryptor('encrypt', $ID));    
            // 		    }
            // 		}
            // 	 }else{
            $address_length = sizeof($this->request->getPost('address1'));
            for ($i = 1; $i <= $address_length; $i++) {

                if ($post['address1'][$i] != '' || $post['address2'][$i] != '' || $post['address3'][$i] != '' || $post['inter_Country'][$i] != '' || $post['inter_City'][$i] != '') {
                    $address_param1['Address_RowID_int']  = $post['inter_Address_RowID'][$i];
                    $address_param1['address1'] = $post['address1'][$i];
                    $address_param1['address2']       = $post['address2'][$i];
                    $address_param1['address3']           = $post['address3'][$i];
                    $address_param1['Country_int']        = $post['inter_Country'][$i];
                    $address_param1['City_int']          = $post['inter_City'][$i];
                    $address_param1['AddressID_int']      = $ID;
                    // $address_param1['AddressType']      = $post['interaddressType'][$i];
                    $address_param1['physical_status'] = isset($post['inter_physical'][$i]) ? '1' : '0';
                    $address_param1['mailing_status'] = isset($post['inter_mailing'][$i]) ? '1' : '0';
                    $address_param1['Active_int']         = isset($post['inter_Active'][$i]) ? $post['inter_Active'][$i] : 0;
                    if ($address_param1['Address_RowID_int'] == '0' || $address_param1['Address_RowID_int'] == '') {
                        $response_add = $this->applicationModel->insertOrrganizationInterAddInfo($address_param1);
                    } elseif ($address_param1['Address_RowID_int'] != '0') {
                        date_default_timezone_set("America/New_York");
                        $address_param1['modified_at']  = date("Y-m-d h:i:s");
                        $response_add = $this->applicationModel->updateOrganizationInterAddInfo($address_param1);
                    }
                    if (!empty($response_add)) {
                        if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
                            $response['msg'] = 'Record Updated';
                        } elseif ($response_add['msg'] == 'Record Already Exists') {
                            $response['status'] = false;
                            $response['msg'] = $response_add['msg'];
                        } else {
                            $response['status'] = false;
                            $response['msg'] = 'Record not saved/update';
                        }
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Record not saved/update';
                    }
                }
            }
            if ($this->request->getPost('callType') == 'ajax') {
                session()->remove('msg');
                echo $response['msg'];
            } else {
                session()->setFlashdata('msg', '<div class="alert alert-success">' . $response['msg'] . '</div>');
                return redirect()->to('admin/Form/editOrganization/' . encryptor('encrypt', $ID));
            }
            // 		} 
        }
    }

    function editOrganization()
    {

        $enc_ID = service('uri')->getSegment(4);
        if ($enc_ID == '') {
            return redirect()->to('admin/Form/OrganizationList');
        }

        $ID = encryptor('decrypt', $enc_ID);
        $data['form_id'] = $ID;
        $data['country'] = $this->scbvModel->get_country();
        $data['states'] = $this->scbvModel->get_all_states();
        $data['phonetypes'] = $this->applicationModel->get_all_phone_type();
        $data['address_type'] = $this->applicationModel->get_address_type();
        $data['payment_type'] = $this->applicationModel->getpaymentType();
        $data['campaigns'] = $this->applicationModel->getAllCampaigns();
        $data['infos'] = $this->applicationModel->get_organization_by_id($ID);
        $data['studentid'] = $ID;
        $data['addressDetails'] = $this->applicationModel->getOrganizationAddressByID($ID);
        $data['internationAddressDetails'] = $this->applicationModel->getOrganizationInterAddressByID($ID);
        $data['allnumbers'] = $this->applicationModel->get_all_organization_user_number($ID);
        $data['organizationDonation'] = $this->applicationModel->getOrganizationDonationPaymentByID($ID);
        $data['grandTotalorganizationDonation'] = $this->applicationModel->getTotalOrganizationDonationPaymentByID($ID);
        $data['organizationUser'] = $this->applicationModel->get_organization_user($ID);

        $data['organizationLabel'] = $this->applicationModel->get_organization_labels();
        $data['organizationSelectedLabel'] = $this->applicationModel->get_organization_selected_labels($ID);

        $data['content'] = 'backend/addOrganization';
        $data['page'] = '';
        return view('backend/index', $data);
    }

    function submitOrganizationPaymentDetails()
    {
        $post = $this->request->getPost();
        $donation_array = array();
        $donor_rowid = $post['donor_rowid'];
        $donorid = $post['donorid'];
        $received_date = isset($post['received_date']) && $post['received_date'] != "" ? date('Y-m-d', strtotime($post['received_date'])) : '';
        $payment_type = $post['payment_type'];
        $checknumber = $post['checknumber'];
        $amount = $post['amount'];
        $campaign = $post['campaign'];
        $donationNote = $post['donationNote'];
        $short_note = $post['short_note'];
        $start_date = ($post['start_date'] != '') ? date('Y-m-d', strtotime($post['start_date'])) : null;
        $end_date = ($post['end_date'] != '') ? date('Y-m-d', strtotime($post['end_date'])) : null;

        $credit = $post['credit'];
        $course_id = $post['course_id'];

        $credit_note = $post['credit_note'];
        $scholor_adjustment = $post['scholor_adjustment'];
        $scholor_adjustment_note = $post['scholor_adjustment_note'];

        $receiptDate = isset($post['ReceiptDate']) && $post['ReceiptDate'] != "" ? date('Y-m-d', strtotime($post['ReceiptDate'])) : '';
        $payment['Donor_RowID'] = $donor_rowid;
        $payment['org_id'] = $donorid;
        $payment['ReceivedDate'] = $received_date;
        $payment['Campaign'] = $campaign;
        $payment['PaymentType'] = $payment_type;
        $payment['CheckNumber'] = $checknumber;
        $payment['Amount'] = $amount;
        $payment['ReceiptDae'] = $receiptDate;
        $payment['added_by'] = session()->get('USER_ID');
        $payment['DonationNote'] = $donationNote;
        $payment['added_date'] = date('Y-m-d');

        $GrantID = $post['GrantID'];
        $SoftCredit = $post['SoftCredit'];
        $payment['GrantID'] = $GrantID;
        $payment['SoftCredit'] = $SoftCredit;
        $payment['short_note'] = $short_note;
        $payment['start_date'] = $start_date;
        $payment['end_date'] = $end_date;


        $donation_array['org_id'] = $donorid;
        $donation_array['ReceivedDate'] = $received_date;
        $donation_array['Campaign'] = $campaign;

        $donation_array['GrantID'] = $GrantID;
        $donation_array['SoftCredit'] = $SoftCredit;

        $donation_array['PaymentType'] = $payment_type;
        $donation_array['CheckNumber'] = $checknumber;
        $donation_array['Amount'] = $amount;
        $donation_array['ReceiptDae'] = $receiptDate;
        $donation_array['ReceiptDae'] = $receiptDate;
        $donation_array['DonationNote'] = $donationNote;

        $donation_array['short_note'] = $short_note;
        $donation_array['start_date'] = $start_date;
        $donation_array['end_date'] = $end_date;

        $tablename = 'organization_donations';
        $testrecords = recordExist($donation_array, $tablename);
        $response_array = array();
        $last_id = 0;
        if (! $testrecords) {
            if ($donor_rowid != '') {
                $result = $this->applicationModel->updateOrganizationPayement($payment);
                $last_id = $donor_rowid;
            } else {
                $payment['added_date'] = date('Y-m-d');
                $result = $this->applicationModel->submitOrganizationPayement($payment);
            }
            $response_array = array();
            if ($result['msg'] == 'INSERTED') {
                $response_array['msg'] = 'Record Inserted Successfully';
                $response_array['last_id'] = $result['last_insert_id'];
                $last_id = $result['last_insert_id'];
            } else {
                $response_array['msg'] = 'Record Updated Successfully';
                $response_array['last_id'] = '';
            }
        } else {
            $response_array['msg'] = 'Record Already Exist or saved';
            $response_array['last_id'] = '';
        }
        echo json_encode($response_array, JSON_UNESCAPED_SLASHES);
    }

    function delete_organization_donation()
    {
        $id = $this->request->getPost('id');
        $data = $this->applicationModel->delete_organization_donation($id);
        if ($data) {
            echo true;
        } else {
            echo false;
        }
    }

    function submitOrganizationLabelRole()
    {
        $ID = encryptor('decrypt', $this->request->getPost('org_id'));
        $this->applicationModel->insert_or_update_organization_label($ID);
    }

    function addGenralInfo()
    {
        $validation = \Config\Services::validation();
        $post = $this->request->getPost();
        $ID = isset($post['id']) && $post['id'] != '' ? $post['id'] : '';
        $email_length = sizeof((array) $this->request->getPost('Email'));
        if ($post['submit'] == 'name') {
            if (!empty(array_filter($this->request->getPost('Email')))) {
                $check_email = $this->applicationModel->check_duplicate_email($ID);
                //echo $this->db->last_query();die;
                if (!empty($check_email)) {
                    $dup_email = array_column($check_email, 'Email');
                    $dup_email = implode(',', $dup_email);
                    $dup_id = array_column($check_email, 'EmailID');
                    $dup_id = implode(',', $dup_id);
                    session()->setFlashdata('post', $post);
                    session()->setFlashdata('msg', '<div class="alert alert-danger">Following email ' . $dup_email . ' Associated with Contact ID ' . $dup_id . ' respectively.</div>');
                    if ($ID == '') {
                        return redirect()->to(base_url('admin/Form'));
                    } else {
                        return redirect()->to(base_url('admin/Form/ViewApp/' . $ID));
                    }
                    die();
                }
            }

            $validation->setRules([
                'FirstName'   => 'trim|required|permit_empty',
                'LastName'    => 'trim|required|permit_empty',
                'Greeting'    => 'trim|required|permit_empty',
                'Addressee'   => 'trim|required|permit_empty',
                'Spouse'      => 'trim|permit_empty',
                'Company'     => 'trim|permit_empty',
                'HomePhone'   => 'trim|permit_empty',
                'MobilePhone' => 'trim|permit_empty',
                'MainPhone'   => 'trim|permit_empty',
                'Position'    => 'trim|permit_empty',
                'WorkPhone'   => 'trim|permit_empty',
                'Deceased'    => 'trim|permit_empty',
                'title'       => 'trim|permit_empty'
            ]);

            $form_validation = $validation->withRequest($this->request)->run();

            $post = $this->request->getPost();


            if ($form_validation == FALSE) {
                $data['errors'] = $validation->getErrors();
                session()->setFlashdata('post', $post);
                session()->setFlashdata('msg', '<div class="alert alert-danger">' . $data['errors'] . '</div>');
                if ($ID == '') {
                    return redirect()->to(base_url('admin/Form'));
                } else {
                    return redirect()->to(base_url('admin/Form/ViewApp/' . $ID));
                }
            } else {

                if (isset($post['submit'])) {
                    $param = array(
                        'ID' => $post['id'],
                        'FirstName' => $post['FirstName'],
                        'LastName' => $post['LastName'],
                        'Greeting' => $post['Greeting'],
                        'Spouse' => $post['Spouse'],
                        'Company' => $post['Company'],
                        'title' => $post['title'],
                        'Note' => $post['Note'],

                        'boardHistory' => $post['boardHistory'],

                        'Birthdate' => ($post['Birthdate'] != '' && $post['Birthdate'] != null) ? date('m/d/Y', strtotime($post['Birthdate'])) : '',
                        'sex' => $post['Sex'],
                        'gender_another' => $post['gender_another'],
                        'Ethnicity' => $post['Ethnicity'],
                        'citizenship' => $post['citizenship'],
                        'citizenship_country' => $post['citizenship_country'],
                        'web_link' => $post['web_link'],
                        'Addressee' => $post['Addressee'],
                        'HomePhone' => isset($post['HomePhone']) ? unmask($post['HomePhone']) : '',
                        'MobilePhone' => isset($post['MobilePhone']) ? unmask($post['MobilePhone']) : '',
                        'MainPhone'   => isset($post['MainPhone']) ? unmask($post['MainPhone']) : '',
                        'Position'    => isset($post['Position']) ? unmask($post['Position']) : '',
                        'WorkPhone'   => isset($post['WorkPhone']) ? unmask($post['WorkPhone']) : '',
                        'organization_id' => $post['crm_organization_id'] ?? '',
                        'org_rel_id'      => $post['relation_organization'] ?? '',
                    );

                    if (isset($post['ssn'])) {
                        $param['ssn'] = $post['ssn'];
                    }

                    if ($ID == '') {
                        $param['created_by'] = session()->get('NAME_ID');
                        $param['created_date'] = date('Y-m-d h:m:i');
                        $response = $this->applicationModel->insertGeneralInfo($param);
                    } elseif ($ID != '') {
                        $param['ID'] = $post['id'];
                        $param['modified_by'] = session()->get('NAME_ID');
                        $param['modified_date'] = date('Y-m-d h:m:i');
                        $response = $this->applicationModel->updateGeneralInfo($param);
                    }
                    $ID = isset($response['last_id']) ? $response['last_id'] : $ID;



                    if ($response['msg'] == "INSERTED" || $response['msg'] == "UPDATED") {

                        // Start Fwd: Database - New Check box
                        $check_contact_tag = $this->applicationModel->get_user_conatct_tag_details($ID);
                        if (!empty($check_contact_tag)) {
                            $this->applicationModel->update_contact_tag($ID, $post);
                        } else if (isset($post['doNotContact']) || $post['doNotContactNote'] != '') {
                            $this->applicationModel->insert_contact_tag($ID, $post);
                        }
                        // End Fwd: Database - New Check box

                        // Address Save
                        $address_length = sizeof($this->request->getPost('Street_Address'));
                        $validate_array = array();
                        $validate_array[] = $post['Street_Address'];
                        $validate_array[] = $post['City'];
                        $validate_array[] = $post['Country'];
                        $validate_array[] = $post['addressType'];
                        $res = empty_search($validate_array);
                        if ($res['save'] == 1 && $res['status'] == 1) {
                            for ($i = 1; $i <= $address_length; $i++) {



                                $address_param['Address_RowID'] = $post['Address_RowID'][$i];
                                $address_param['Street_Address'] = $post['Street_Address'][$i];
                                $address_param['Address2'] = $post['Address2'][$i];
                                $address_param['City'] = $post['City'][$i];
                                $address_param['State'] = $post['State'][$i];
                                $address_param['Postal_Code'] = $post['Postal_Code'][$i];
                                $address_param['Country'] = $post['Country'][$i];
                                $address_param['addressType'] = $post['addressType'][$i];
                                $address_param['AddressID'] = $ID;
                                $address_param['Active'] = isset($post['Active'][$i]) ? $post['Active'][$i] : 0;

                                if ($address_param['Address_RowID'] == '') {
                                    unset($address_param['Address_RowID']);
                                    $response_add = $this->applicationModel->insertAddressInfo($address_param);
                                } elseif ($ID != '') {
                                    $response_add = $this->applicationModel->updateAddressInfo($address_param);
                                }

                                if (!empty($response_add)) {
                                    if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
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

                            session()->setFlashdata('post', $post); //for post the data auto filled
                            session()->setFlashdata('msg', '<div class="alert alert-danger">Please fill all mandatory details in address.</div>');

                            if ($ID == '') {
                                return redirect()->to(base_url('admin/Form'));
                            } else {
                                return redirect()->to(base_url('admin/Form/ViewApp/' . $ID));
                            }
                        }


                        // start organization changes
                        $this->applicationModel->insert_or_update_organization_user2($ID, $post);
                        // end organization changes

                        $post = $this->request->getPost();



                        $address_length = sizeof($this->request->getPost('interaddressType'));


                        $validate_array = array();

                        $validate_array[] = $post['interaddressType'];

                        $res = empty_search($validate_array);

                        if ($res['save'] == 1 && $res['status'] == 1) {

                            for ($i = 1; $i <= $address_length; $i++) {
                                $address_param1['Address_RowID_int']  = $post['inter_Address_RowID'][$i];
                                $address_param1['Street_Address_int'] = $post['inter_Address1'][$i];
                                $address_param1['company_name']       = $post['inter_Company_Name'][$i];
                                // $address_param['Street_Address_int'] 	 	 = $post['inter_Address1'][$i];
                                $address_param1['Address2_int']           = $post['inter_Address2'][$i];
                                //$address_param['City_int']    = $post['inter_Postal_Code'][$i];
                                $address_param1['Country_int']        = $post['inter_Country'][$i];
                                // $address_param['City_int']           = $post['inter_City'][$i];
                                $address_param1['City_int']          = $post['inter_City'][$i];
                                $address_param1['AddressID_int']      = $ID;
                                $address_param1['AddressType']      = $post['interaddressType'][$i];
                                $address_param1['Active_int']         = isset($post['inter_Active'][$i]) ? $post['inter_Active'][$i] : 0;

                                if ($address_param1['Address_RowID_int'] == '0' || $address_param1['Address_RowID_int'] == '') {
                                    //unset($address_param['Address_RowID_int']);
                                    $response_add = $this->applicationModel->insertInterAddInfo($address_param1);
                                } elseif ($address_param1['Address_RowID_int'] != '0') {
                                    date_default_timezone_set("America/New_York");
                                    $address_param1['modified_at']  = date("Y-m-d h:i:s");
                                    $response_add = $this->applicationModel->updateInterAddInfo($address_param1);
                                }

                                if (!empty($response_add)) {
                                    if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
                                        $response['msg'] = 'Record Updated';
                                    } elseif ($response_add['msg'] == 'Record Already Exists') {
                                        $response['status'] = false;
                                        $response['msg'] = $response_add['msg'];
                                    } else {
                                        $response['status'] = false;
                                        $response['msg'] = 'Record not saved/update';
                                    }
                                } else {
                                    $response['status'] = false;
                                    $response['msg'] = 'Record not saved/update';
                                }
                            }
                        }








                        // Email Save
                        $email_length = sizeof($this->request->getPost('Email'));

                        $validate_array = array();
                        $validate_array[] = $post['Email'];



                        $res = empty_search($validate_array);



                        if ($res['save'] == 1 && $res['status'] == 1) {

                            for ($i = 1; $i <= $email_length; $i++) {

                                $email_param['Email_RowID'] = $post['Email_RowID'][$i];
                                $email_param['EmailID'] = $ID;
                                $active_email = $email_param['Email'] = $post['Email'][$i];
                                if ($active_email != "") {
                                    $email_param['Active'] = $post['EmailActive'][$i];
                                    $email_param['Unsubscribed'] = $post['EmailUnsubscribed'][$i];
                                } else {
                                    $email_param['Active'] = 0;
                                    $email_param['Unsubscribed'] = 0;
                                }

                                if ($email_param['Email_RowID'] == '') {
                                    unset($email_param['Email_RowID']);
                                    $email_response = $this->applicationModel->insertEmailInfo($email_param);
                                } elseif ($ID != '') {
                                    $email_response = $this->applicationModel->updateEmailInfo($email_param);
                                }

                                if (!empty($email_response)) {
                                    if ($email_response['msg'] == 'UPDATED' || $email_response['msg'] == 'INSERTED') {
                                    } elseif ($email_response['msg'] == 'Record Already Exists') {
                                        $response['status'] = false;
                                        $response['msg'] .= $email_response['msg'] . '<br>';
                                    } else {
                                        $response['status'] = false;
                                        $response['msg'] .= 'Email not saved/update<br>';
                                    }
                                } else {
                                    $response['status'] = false;
                                    $response['msg'] .= 'Email not saved/update<br>';
                                }
                            }
                        }


                        foreach ($post['boardtype'] as $key => $val) {
                            if ($post['boardtype'][$key] != '') {
                                $board_param['id'] = $post['Board_RowID'][$key];
                                $board_param['org_id'] = $post['boardtype'][$key];
                                $board_param['name_id'] = $ID;
                                $board_param['assign_by'] = session()->get('NAME_ID');
                                $board_param['Deletestatus'] = '0';
                                $board_param['ip'] = $_SERVER['REMOTE_ADDR'];
                                if ($post['start_date'][$key] != '') {
                                    $board_param['start_date'] = date('Y-m-d', strtotime($post['start_date'][$key]));
                                } else {
                                    $board_param['start_date'] =  '';
                                }

                                if ($post['end_date'][$key] != '') {
                                    $board_param['end_date'] = date('Y-m-d', strtotime($post['end_date'][$key]));
                                } else {
                                    $board_param['end_date'] =  '';
                                }
                                if ($board_param['id'] == '') {
                                    unset($board_param['id']);
                                    $board_response = $this->applicationModel->insertBoradInfo($board_param);
                                } elseif ($board_param['id'] != '') {
                                    $board_response = $this->applicationModel->updateBoardInfo($board_param);
                                }
                            }
                        }

                        $phone_length = sizeof($post['phonetype']);
                        $phone_param = array();
                        // echo "<pre>";print_r($post);echo "</pre>";
                        if ($phone_length > 0) {

                            for ($i = 1; $i <= $phone_length; $i++) {
                                if ($post['USPhoneNumber'][$i] != '') {
                                    $phone_param['AutoId'] = $post['US_RowID'][$i];
                                    $phone_param['Id'] = $ID;
                                    $phone_param['Type'] = $post['phonetype'][$i];
                                    $phone_param['Number'] = $post['USPhoneNumber'][$i];
                                    $phone_param['Extension'] = $post['Extension'][$i];

                                    $active_phone = $phone_param['Active'] = $post['USActive'][$i];
                                    if ($active_phone != "") {
                                        $phone_param['Active'] = $post['USActive'][$i];
                                    } else {
                                        $phone_param['Active'] = 0;
                                    }



                                    if ($phone_param['AutoId'] == '') {
                                        unset($phone_param['AutoId']);
                                        $phone_response = $this->applicationModel->insertPhoneInfo($phone_param);
                                    } elseif ($phone_param['AutoId'] != '') {
                                        $phone_response = $this->applicationModel->updatePhoneInfo($phone_param);
                                    }

                                    //echo"<'pre'>";print_r($email_response);

                                    if (!empty($phone_response)) {
                                        if ($phone_response['msg'] == 'UPDATED' || $phone_response['msg'] == 'INSERTED') {
                                            $response['status'] = true;
                                            $response['msg'] = 'Record Updated';
                                        } elseif ($phone_response['msg'] == 'Record Already Exists') {
                                            $response['status'] = false;
                                            $response['msg'] = $phone_response['msg'];
                                        } else {
                                            $response['status'] = false;
                                            $response['msg'] = 'Phone not saved/update';
                                        }
                                    } else {
                                        $response['status'] = false;
                                        $response['msg'] = 'Phone not saved/update';
                                    }
                                }
                            }
                        } else {
                            $response['status'] = false;
                            $response['msg'] = 'No Phone to save';
                        }

                        $group_param = array(
                            'NameLink' => $ID,
                            'PartnerOrganization' => isset($post['PartnerOrganization']) ? $post['PartnerOrganization'] : 0,
                            'PartnerOrgName' => isset($post['PartnerOrgName']) ? $post['PartnerOrgName'] : 0,
                        );
                        $group_response = $this->applicationModel->insertUpdateGroupInfo($group_param);

                        //echo "<pre>";print_r($group_response);die('ygyu');


                        session()->setFlashdata('msg', '<div class="alert alert-success">' . $response['msg'] . '</div>');
                        return redirect()->to('admin/Form/ViewApp/' . $ID);
                    } else {

                        session()->setFlashdata('post', $post); //for post the data auto filled
                        session()->setFlashdata('msg', '<div class="alert alert-danger">There is some Error Occurred in Submission. Please try later.</div>');

                        return redirect()->to('admin/Form/ViewApp/' . $ID);
                    }
                }
            }
        } elseif ($post['submit'] == 'email') {

            $response['status'] = false;
            $response['msg'] = '';

            if (!empty(array_filter($this->request->getPost('Email')))) {

                $check_email = $this->applicationModel->check_duplicate_email($ID);
                //echo $this->db->last_query();die;  
                if (!empty($check_email)) {
                    $dup_email = array_column($check_email, 'Email');
                    $dup_email = implode(',', $dup_email);
                    $dup_id = array_column($check_email, 'EmailID');
                    $dup_id = implode(',', $dup_id);
                    session()->setFlashdata('post', $post);
                    session()->setFlashdata('msg', '<div class="alert alert-danger">Following email ' . $dup_email . ' Associated with Contact ID ' . $dup_id . ' respectively.</div>');

                    $response = 'Following email ' . $dup_email . ' Associated with Contact ID ' . $dup_id . ' respectively.';
                    if ($this->request->getPost('form_submit_type') == 'ajax') {
                        session()->remove('msg');
                        echo json_encode($response);
                    } else if ($ID == '') {
                        return redirect()->to('admin/Form');
                    } else {
                        return redirect()->to('admin/Form/ViewApp/' . $ID);
                    }
                    die();
                }
            }

            $post = $this->request->getPost();
            $email_length = sizeof($post['Email']);

            if ($email_length > 0) {

                for ($i = 1; $i <= $email_length; $i++) {

                    $email_param['Email_RowID'] = $post['Email_RowID'][$i];
                    $email_param['EmailID'] = $ID;
                    $active_email = $email_param['Email'] = $post['Email'][$i];
                    if ($active_email != "") {
                        $email_param['Active'] = $post['EmailActive'][$i];
                        $email_param['Unsubscribed'] = $post['EmailUnsubscribed'][$i];
                    } else {
                        $email_param['Active'] = 0;
                        $email_param['Unsubscribed'] = 0;
                    }

                    //echo"<'pre'>";print_r($email_param);

                    if ($email_param['Email_RowID'] == '') {
                        unset($email_param['Email_RowID']);
                        $email_response = $this->applicationModel->insertEmailInfo($email_param);
                    } elseif ($email_param['EmailID'] != '') {
                        $email_response = $this->applicationModel->updateEmailInfo($email_param);
                    }

                    //echo"<'pre'>";print_r($email_response);

                    if (!empty($email_response)) {
                        if ($email_response['msg'] == 'UPDATED' || $email_response['msg'] == 'INSERTED') {
                            $response['status'] = true;
                            $response['msg'] = 'Email Updated';
                        } elseif ($email_response['msg'] == 'Record Already Exists') {
                            $response['status'] = false;
                            $response['msg'] = $email_response['msg'];
                        } else {
                            $response['status'] = false;
                            $response['msg'] = 'Email not saved/update';
                        }
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Email not saved/update';
                    }
                } //die;

            } else {
                $response['status'] = false;
                $response['msg'] = 'No email to save';
            }

            //die;
            if ($this->request->getPost('form_submit_type') == 'ajax') {
                session()->remove('msg');
                echo json_encode($response['msg']);
            } else {
                session()->setFlashdata('msg', '<div class="alert alert-success">' . $response['msg'] . '</div>');
                redirect('admin/Form/ViewApp/' . $ID);
            }
        } elseif ($post['submit'] == 'address') {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'Street_Address.*' => 'trim|required|permit_empty',
                'Address2.*'       => 'trim|permit_empty',
                'City.*'           => 'trim|required|permit_empty',
                'State.*'          => 'trim|permit_empty',
                'Postal_Code.*'    => 'trim|permit_empty',
                'Country.*'        => 'trim|required|permit_empty',
                'Active'           => 'trim|permit_empty'
            ]);

            $form_validation = $validation->withRequest($this->request)->run();
            $post = $this->request->getPost();

            if ($form_validation == false) {
                $data['errors'] = $validation->getErrors();
                session()->setFlashdata('post', $post);
                session()->setFlashdata('msg', '<div class="alert alert-danger">' . implode('<br>', $data['errors']) . '</div>');

                if ($this->request->getPost('form_submit_type') == 'ajax') {
                    session()->remove('msg');
                    echo json_encode($data['errors']);
                } elseif ($ID == '') {
                    return redirect()->to(base_url('admin/Form'));
                } else {
                    return redirect()->to(base_url('admin/Form/ViewApp/' . $ID));
                }
            } else {
                $address_length = count($this->request->getPost('Street_Address'));

                for ($i = 1; $i <= $address_length; $i++) {
                    $address_param = [];
                    $address_param['Address_RowID']    = $post['Address_RowID'][$i];
                    $address_param['Street_Address']   = $post['Street_Address'][$i];
                    $address_param['Address2']         = $post['Address2'][$i];
                    $address_param['City']             = $post['City'][$i];
                    $address_param['State']            = $post['State'][$i];
                    $address_param['Postal_Code']      = $post['Postal_Code'][$i];
                    $address_param['Country']          = $post['Country'][$i];
                    $address_param['AddressID']        = $ID;
                    $address_param['addressType']      = $post['addressType'][$i];
                    $address_param['Active']           = isset($post['Active'][$i]) ? $post['Active'][$i] : 0;

                    if ($address_param['Address_RowID'] == '') {
                        unset($address_param['Address_RowID']);
                        $response_add = $this->applicationModel->insertAddressInfo($address_param);
                    } elseif ($ID != '') {
                        $response_add = $this->applicationModel->updateAddressInfo($address_param);
                    }

                    if (!empty($response_add)) {
                        if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
                            $response['msg'] = 'Address Updated';
                        } elseif ($response_add['msg'] == 'Record Already Exists') {
                            $response['status'] = false;
                            $response['msg'] = $response_add['msg'];
                        } else {
                            $response['status'] = false;
                            $response['msg'] = 'Address not saved/update';
                        }
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Address not saved/update';
                    }
                }

                if ($this->request->getPost('form_submit_type') == 'ajax') {
                    session()->remove('msg');
                    echo json_encode($response['msg']);
                } else {
                    session()->setFlashdata('msg', '<div class="alert alert-success">' . $response['msg'] . '</div>');
                    return redirect()->to(base_url('admin/Form/ViewApp/' . $ID));
                }
            }
        } elseif ($post['submit'] == 'board_info') {
            //echo "<pre>";print_r($this->request->getPost());echo "</pre>";die;
            $response['status'] = false;
            $response['msg'] = '';

            $post = $this->request->getPost();
            $board_length = sizeof($post['boardtype']);

            if ($board_length > 0) {

                foreach ($post['boardtype'] as $key => $val) {
                    if ($post['boardtype'][$key] != '') {
                        $board_param['id'] = $post['Board_RowID'][$key];
                        $board_param['org_id'] = $post['boardtype'][$key];
                        $board_param['name_id'] = $ID;
                        $board_param['assign_by'] = session()->get('NAME_ID');
                        $board_param['Deletestatus'] = '0';
                        $board_param['ip'] = $_SERVER['REMOTE_ADDR'];
                        if ($post['start_date'][$key] != '') {
                            $board_param['start_date'] = date('Y-m-d', strtotime($post['start_date'][$key]));
                        } else {
                            $board_param['start_date'] =  '';
                        }

                        if ($post['end_date'][$key] != '') {
                            $board_param['end_date'] = date('Y-m-d', strtotime($post['end_date'][$key]));
                        } else {
                            $board_param['end_date'] =  '';
                        }
                        if ($board_param['id'] == '') {
                            unset($board_param['id']);
                            $board_response = $this->applicationModel->insertBoradInfo($board_param);
                        } elseif ($board_param['id'] != '') {
                            $board_response = $this->applicationModel->updateBoardInfo($board_param);
                        }


                        if (!empty($board_response)) {
                            if ($board_response['msg'] == 'UPDATED' || $board_response['msg'] == 'INSERTED') {
                                $response['status'] = true;
                                $response['msg'] = '<div class="alert alert-success">Board Info Updated</div>';
                            } elseif ($board_response['msg'] == 'Record Already Exists') {
                                $response['status'] = false;
                                $response['msg'] = '<div class="alert alert-danger">' . $board_response['msg'] . "</div>";
                            } else {
                                $response['status'] = false;
                                $response['msg'] = '<div class="alert alert-danger">Board Info not saved/update</div>';
                            }
                        } else {
                            $response['status'] = false;
                            $response['msg'] = '<div class="alert alert-danger">Board Info not saved/update</div>';
                        }
                    } else {
                        session()->setFlashdata('msg', '<div class="alert alert-danger">Organization Required</div>');
                        return redirect()->to('admin/Form/ViewApp/' . $ID);
                    }
                }



                //die;

            } else {
                $response['status'] = false;
                $response['msg'] = '<div class="alert alert-danger">No Board Info to save</div>';
            }


            session()->setFlashdata('msg', $response['msg']);
            return redirect()->to('admin/Form/ViewApp/' . $ID);
        } elseif ($post['submit'] == 'USPhone') {

            $response['status'] = false;
            $response['msg'] = '';

            // echo"<'pre'>";print_r($this->request->getPost());'<pre>';

            $post = $this->request->getPost();
            $phone_length = sizeof($post['phonetype']);
            $phone_param = array();

            if ($phone_length > 0) {

                for ($i = 1; $i <= $phone_length; $i++) {

                    $phone_param['AutoId'] = $post['US_RowID'][$i];
                    $phone_param['Id'] = $ID;
                    $phone_param['Type'] = $post['phonetype'][$i];
                    $phone_param['Number'] = $post['USPhoneNumber'][$i];
                    $phone_param['Extension'] = $post['Extension'][$i];

                    $active_phone = $phone_param['Active'] = $post['USActive'][$i];
                    if ($active_phone != "") {
                        $phone_param['Active'] = $post['USActive'][$i];
                    } else {
                        $phone_param['Active'] = 0;
                    }

                    if ($phone_param['AutoId'] == '') {
                        unset($phone_param['AutoId']);
                        $phone_response = $this->applicationModel->insertPhoneInfo($phone_param);
                    } elseif ($phone_param['AutoId'] != '') {
                        $phone_response = $this->applicationModel->updatePhoneInfo($phone_param);
                    }

                    //echo"<'pre'>";print_r($email_response);

                    if (!empty($phone_response)) {
                        if ($phone_response['msg'] == 'UPDATED' || $phone_response['msg'] == 'INSERTED') {
                            $response['status'] = true;
                            $response['msg'] = 'Phone Updated';
                        } elseif ($phone_response['msg'] == 'Record Already Exists') {
                            $response['status'] = false;
                            $response['msg'] = $phone_response['msg'];
                        } else {
                            $response['status'] = false;
                            $response['msg'] = 'Phone not saved/update';
                        }
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Phone not saved/update';
                    }
                }
            } else {
                $response['status'] = false;
                $response['msg'] = 'No Phone to save';
            }

            if ($this->request->getPost('form_submit_type') == 'ajax') {
                $this->session->remove('msg');
                echo json_encode($response['msg']);
            } else {
                session()->setFlashdata('msg', '<div class="alert alert-success">' . $response['msg'] . '</div>');
                return redirect()->to('admin/Form/ViewApp/' . $ID);
            }
        } elseif ($post['submit'] == 'inter_address') {


            // Load Validation service (not needed if autoloaded in constructor)
            $validation = \Config\Services::validation();

            // Set rules
            $validation->setRule('interaddressType[]', 'interaddressType', 'trim|required');

            // Run validation
            $form_validation = $validation->withRequest($this->request)->run();

            // Get POST data
            $post = $this->request->getPost();

            if (!$form_validation) {
                $data['errors'] = $validation->listErrors(); // use listErrors() in CI4
                session()->setFlashdata('post', $post);
                session()->setFlashdata('msg', '<div class="alert alert-danger">' . $data['errors'] . '</div>');

                if ($ID == '') {
                    return redirect()->to('admin/Form');
                } else {
                    return redirect()->to('admin/Form/ViewApp/' . $ID);
                }
            } else {


                $address_length = sizeof($this->request->getPost('interaddressType'));
                for ($i = 1; $i <= $address_length; $i++) {
                    $address_param['Address_RowID_int']  = $post['inter_Address_RowID'][$i];
                    $address_param['Street_Address_int'] = $post['inter_Address1'][$i];
                    $address_param['company_name']       = $post['inter_Company_Name'][$i];
                    $address_param['Address2_int']           = $post['inter_Address2'][$i];
                    $address_param['Country_int']        = $post['inter_Country'][$i];
                    $address_param['City_int']          = $post['inter_City'][$i];
                    $address_param['AddressID_int']      = $ID;
                    $address_param['AddressType']      = $post['interaddressType'][$i];
                    $address_param['Active_int']         = isset($post['inter_Active'][$i]) ? $post['inter_Active'][$i] : 0;
                    if ($address_param['Address_RowID_int'] == '0') {
                        $response_add = $this->applicationModel->insertInterAddInfo($address_param);
                    } elseif ($address_param['Address_RowID_int'] != '0') {
                        date_default_timezone_set("America/New_York");
                        $address_param['modified_at']  = date("Y-m-d h:i:s");
                        $response_add = $this->applicationModel->updateInterAddInfo($address_param);
                    }
                    if (!empty($response_add)) {
                        if ($response_add['msg'] == 'UPDATED' || $response_add['msg'] == 'INSERTED') {
                            $response['msg'] = 'Address Updated';
                        } elseif ($response_add['msg'] == 'Record Already Exists') {
                            $response['status'] = false;
                            $response['msg'] = $response_add['msg'];
                        } else {
                            $response['status'] = false;
                            $response['msg'] = 'Address not saved/update';
                        }
                    } else {
                        $response['status'] = false;
                        $response['msg'] = 'Address not saved/update';
                    }
                }


                if ($this->request->getPost('form_submit_type') == 'ajax') {
                    $this->session->remove('msg');
                    echo json_encode($response['msg']);
                } else {
                    session()->setFlashdata('msg', '<div class="alert alert-success">' . $response['msg'] . '</div>');
                    return redirect()->to('admin/Form/ViewApp/' . $ID);
                }
            }
        } elseif ($post['submitOrg'] == 'submitOrg') {

            $data = $this->applicationModel->insert_or_update_organization_user2($ID, $post);

            if ($data) {
                session()->setFlashdata('post', $post); //for post the data auto filled
                session()->setFlashdata('msg', '<div class="alert alert-success">Organization updated successfully.</div>');
                return redirect()->to('admin/Form/ViewApp/' . $ID);
            } else {
                session()->setFlashdata('post', $post); //for post the data auto filled
                session()->setFlashdata('msg', '<div class="alert alert-danger">Organization not updated.</div>');
                return redirect()->to('admin/Form/ViewApp/' . $ID);
            }
        }
    }

    function get_organization_html_by_id()
    {
        if (!session()->has('USER_ID')) {
            echo "<h3 style='color:red;text-align:center'>Session Expired. Please login Again</h3>";
        } else if ($this->request->getPost('submit') == 'submit') {
            $encrypt_id = $this->request->getPost('organization_id');
            $ID = encryptor('decrypt', $encrypt_id);
            $data['form_id'] = $ID;
            $data['country'] = $this->scbvModel->get_country();
            $data['states'] = $this->scbvModel->get_all_states();
            $data['phonetypes'] = $this->applicationModel->get_all_phone_type();
            $data['address_type'] = $this->applicationModel->get_address_type();
            $data['payment_type'] = $this->applicationModel->getpaymentType();
            $data['campaigns']  = $this->applicationModel->getAllOrganizationCampaigns();
            $data['infos'] = $this->applicationModel->get_organization_by_id($ID);
            $data['studentid'] = $ID;
            $data['addressDetails'] = $this->applicationModel->getOrganizationAddressByID($ID);
            $data['internationAddressDetails'] = $this->applicationModel->getOrganizationInterAddressByID($ID);
            $data['allnumbers'] = $this->applicationModel->get_all_organization_user_number($ID);
            $data['organizationDonation'] = $this->applicationModel->getOrganizationDonationPaymentByID($ID);
            $data['grandTotalorganizationDonation'] = $this->applicationModel->getTotalOrganizationDonationPaymentByID($ID);
            $data['organizationUser'] = $this->applicationModel->get_organization_user($ID);
            //echo "<pre>";print_r($this->db->last_query());echo "</pre>";
            $data['organizationLabel'] = $this->applicationModel->get_organization_labels();
            $data['organizationSelectedLabel'] = $this->applicationModel->get_organization_selected_labels($ID);
            $data['individual_user'] = $this->applicationModel->getIndividualbyOrganizationId($ID);
            //echo $this->db->last_query();die;

            //echo $this->db->last_query();die();
            $data['data'] = $data;
            return view('templates/organization/master_relationship', $data);
        }
    }

    function set_add_more_board_html()
    {
        if ($this->request->getPost('submit') == 'submit') {
            $all_organization = $this->applicationModel->getAllActiveOrganization();
            $counter = $this->request->getPost('counter');
            echo '<tr id="Textboardmemeber' . $counter . '">';
            echo '<td>';
            echo '<input value="" type="hidden" name="Board_RowID[' . $counter . ']" >';
            echo '<select class="form-control show board_validation" name="boardtype[' . $counter . ']">';
            echo '<option value="">Select Organization</option>';
            foreach ($all_organization as $org) {
                echo '<option value="' . $org['id'] . '">' . $org['name'] . '</option>';
            }
            echo '</select>';
            echo '</td>';
            echo '<td>';
            echo '<div class="input-group date show" data-provide="datepicker">';
            echo '<input  class="form-control datepickerbackward board_start_date" rel_id="' . $counter . '" id="start_date_board' . $counter . '" name="start_date[' . $counter . ']"   type="text">';
            echo '<div class="input-group-addon" style="display:none;">';
            echo '<span class="glyphicon glyphicon-th"></span>';
            echo '</div>';
            echo '</div>';
            echo '</td>';
            echo '<td>';
            echo '<div class="input-group date show" data-provide="datepicker">';
            echo '<input  class="form-control datepickerbackward board_end_date" rel_id="' . $counter . '" id="end_date_board' . $counter . '" name="end_date[' . $counter . ']" type="text">';
            echo '<div class="input-group-addon"  style="display:none;">';
            echo '<span class="glyphicon glyphicon-th"></span>';
            echo '</div>';
            echo '</div>';
            echo '</td>';
            echo '</tr>';
        }
    }

    function validate_end_date_from_start_date()
    {
        //echo "<pre>"; print_r($this->request->getPost());die;
        if ($this->request->getPost('submit') == 'submit') {
            $start_date = $this->request->getPost('start_date');
            $end_date   = $this->request->getPost('end_date');
            if ($start_date == '') {
                echo "Please Select First Start Date";
            } else if ($end_date != '') {
                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date   = date('Y-m-d', strtotime($end_date));
                if ($start_date > $end_date) {
                    echo "End date should not be smaller than start date";
                }
            }
        }
    }

    function submitemploymentrecord()
    {

        $employmentrecord_array = array();

        $NameID = $this->request->getPost('NameID_em');
        $attachment_name = $this->request->getPost('attachment_name_em');
        $document_type = $this->request->getPost('document_type');
        if ($NameID != '' && $attachment_name != '' && !empty($_FILES["upload_attachment_em"]) && $_FILES["upload_attachment_em"]["error"] == 0) {
            //echo "<pre>"; print_r($_POST);print_r($_FILES); die;
            $response_array = array();
            //$DOCUMENT_Name_New='upload_attachment'.'_'.docdate().'.pdf';
            $uploaded_file = $_FILES['upload_attachment_em'];
            $filename = basename($uploaded_file['name']);
            //$ext = substr($filename, strrpos($filename, '.') + 1);

            $temporary = explode(".", $filename);
            $file_extension = end($temporary);

            $allowed =  array('png', 'jpg', 'pdf', 'doc', 'docx', 'xls', 'xlsx');
            $ext = pathinfo($filename, PATHINFO_EXTENSION);



            if (in_array($ext, $allowed)) {


                $DOCUMENT_Name_New = 'upload_attachment' . '_' . docdate() . '.' . $file_extension;
                $new_path = 'docs/employment_record/';
                $UPLOAD_PATH1 = FCPATH . $new_path . $DOCUMENT_Name_New;

                $full_dir = FCPATH . $new_path;  // Full folder path

                // ✅ Ensure folder exists
                if (!is_dir($full_dir)) {
                    mkdir($full_dir, 0777, true); // Create folder with recursive dirs
                }

                if (move_uploaded_file($_FILES['upload_attachment_em']['tmp_name'], $UPLOAD_PATH1)) {
                    //echo $PREGNO_UPLOAD_PATH; die;

                    $attachment_path = $new_path . $DOCUMENT_Name_New;

                    //$student['id']=$id;
                    $student['student_id'] = $NameID;

                    $student['attachment_name'] = $attachment_name;
                    $student['attachment_path'] = $attachment_path;
                    $student['document_type'] = $document_type;

                    $employmentrecord_array['student_id'] = $NameID;
                    $employmentrecord_array['attachment_name'] = $attachment_name;
                    $employmentrecord_array['document_type'] = $document_type;
                    $tablename = 'tbl_employment_record_attachment';
                    $testrecords = recordExist($employmentrecord_array, $tablename);

                    $response_array = array();
                    if (! $testrecords) {

                        $student['created_date'] = date('Y-m-d H:i:s');
                        $student['created_by'] = session()->get('USER_ID');
                        $student['created_ip'] = actual_ip();
                        $result = $this->applicationModel->submitEmploymentRecord($student);
                        if ($result['msg'] == 'INSERTED') {

                            $response_array['msg'] = 'INSERTED';
                            $response_array['path'] = $attachment_path;
                            $response_array['last_id'] = encryptor('encrypt', $result['last_insert_id']);
                            $response_array['NameID'] = encryptor('encrypt', $NameID);
                        } else {
                            $response_array['msg'] = 'Something went wrong.';
                        }
                    } else {
                        $response_array['msg'] = 'Record Already Exist or saved';
                    }
                } else {
                    $response_array['msg'] = 'Unable to upload document';
                }
            } else {
                $response_array['msg'] = 'Uploaded file is not a valid. Only JPG, PNG, PDF, Word, and Excel files are allowed.';
            }
        } else {
            $response_array['msg'] = 'all fields are mandatory';
        }
        echo json_encode($response_array, JSON_UNESCAPED_SLASHES);
    }

    public function delemploymentrecord()
    {
        $RowID = $this->request->getPost('clogid');

        $student_id = $this->request->getPost('NameID');
        if ($RowID != '' && $student_id != '') {
            $RowID =  encryptor('decrypt', $RowID);
            $student_id =  encryptor('decrypt', $student_id);
            $isdeleted = $this->applicationModel->updateEmploymentRecord(array("Deletestatus" => 1), array("id" => $RowID, "student_id" => $student_id));
            if ($isdeleted['msg'] == 'UPDATED') {
                echo 'OK';
            } else {
                echo 'Unable to delete the record';
            }
        }
    }

    function getSemester()
    {

        $class = $this->request->getPost('classname');
        $results = $this->applicationModel->getSemester($class);
        echo "<option value=''>Select Semester</option>";
        foreach ($results as $rec) {

            echo "<option value='" . $rec['Semester'] . "'>" . $rec['Semester'] . "</option>";
        }
    }

    function type_scholaorship()
	{
			$data['scholarships'] = $this->applicationModel->get_scholar_ship();
            $data['content'] = 'backend/type_scholaorship';
            
			$data['page'] = '';
			return view('backend/index',$data);
	}
	
	function store_scholarship()
	{
	     $this->applicationModel->store_scholarship();
	     session()->setFlashdata('msg',"Scholarship has been added successfully");
         session()->setFlashdata('msg_class','alert-success');
         return redirect('admin/form/type_scholaorship');
	}
	
	function get_scholar_detail_by_id()
	{
	    $id =   encryptor('decrypt', $this->request->getPost('id'));
	    
	    $data = $this->applicationModel->get_scholar_detail_by_id($id);
	    echo json_encode($data);
	    
	}


	function update_scholarship()
	{
	    $this->applicationModel->update_scholarship();
	    //echo $this->db->last_query();die;
	     session()->setFlashdata('msg',"Scholarship has been updated successfully");
         session()->setFlashdata('msg_class','alert-success');
         return redirect('admin/form/type_scholaorship');
	}

    function student_transcripts(){
        $type='';
        $data['recordss'] = array();
        $data['selected_grade']=$type;
        $data['class']=$this->applicationModel->getAllClass();
        $data['semesterlist'] = $this->reportModel->getAllSemsterList();
        $data['grades'] = $this->applicationModel->getAllactiveGrade();
        $data['content']='backend/course_wise_student_transcript';
        $data['page']='';
        $data['data']=$data;
        return view('backend/index',$data);
    }

    function filter_student_transcripts(){

        $type = '';
        $data['transcriptgrades'] = $this->applicationModel->getAllGradesTranscript();
        $class = $this->request->getPost('class') != '' ? $this->request->getPost('class') : '';
        $semester = $this->request->getPost('semester') != '' ? $this->request->getPost('semester') : '';
        $data['recordss'] = $this->reportModel->get_course_wise_student($type,$class,$semester);
        $data['selectedcourse'] = $this->request->getPost('course');
        $data['selectedclass'] = $class;
        $data['selectedSemester']= $semester; 
        $data['class']=$this->applicationModel->getAllClass();
        $data['semesterlist'] = $this->reportModel->getAllSemsterList();
        $course_id = $this->request->getPost('course');
        $data['selected_course_detail'] = $this->reportModel->getCorse_details_by_ID($course_id);
        return view('templates/filter/filter_course_wise_student_transcript', $data);
    }

    function submitTranscript(){		
		$transcript_array = array();
	    $transcript_rowid = $this->request->getPost('transcript_rowid');
		$student_id = $this->request->getPost('student_id');
		$courseid =  $this->request->getPost('courseid');
		$grade = $this->request->getPost('grade');
		
		$check_duplicate = $this->applicationModel->check_transcript_course();
	    if($check_duplicate > 0){
	        $response_array = array();
            $response_array['msg']='This Course is already added';
            echo json_encode($response_array, JSON_UNESCAPED_SLASHES);
            die;
	    }
		//end check duplicate course check in transcript student Fwd: Weird database glitch - Priority Item => 19-march-2024
		
		// By Prabhat 05-12-2020
		$completion_date = $this->request->getPost('completion_date');
		if($completion_date != '' && $completion_date != '0000-00-00')
		{
		    $completion_date = date('Y-m-d',strtotime($completion_date));
		}
		else{
		    $completion_date = null;
		}
		
		$withdrawn_date = $this->request->getPost('withdrawn_date');
		if($withdrawn_date != '' && $withdrawn_date != '0000-00-00')
		{
		    $withdrawn_date = date('Y-m-d',strtotime($withdrawn_date));
		}
		else{
		    $withdrawn_date = null;
		}

                if($grade == "AUDIT" ){
			$creditattempt = number_format(0, 2, '.', '');
			$creditearned = number_format(0,2,'.','');
			$qualitypoints = number_format(0,2,'.','');
		}else{
			$creditattempt = number_format($this->request->getPost('creditattempt'), 2, '.', '');
			$creditearned = number_format($this->request->getPost('creditearned'),2,'.','');
			$qualitypoints = number_format($this->request->getPost('qualitypoints'),2,'.','');
		}
		
	    $transcript_param['Transcript_RowID'] = $transcript_rowid;
		$transcript_param['StudentID'] = $student_id;
		$transcript_param['CourseID'] = $courseid;
		$transcript_param['Grade'] = $grade;
		$transcript_param['CreditAttempt'] = $creditattempt;
		$transcript_param['CreditEarned'] = $creditearned;
		$transcript_param['QualityPoints'] = $qualitypoints;
		
		$transcript_param['withdrawn_date'] = ($withdrawn_date != '')?$withdrawn_date:null;
	
		$transcript_param['completion_date'] = ($completion_date!= '')?$completion_date:null;

		$transcript_array['StudentID'] = $student_id;
		$transcript_array['CourseID'] = $courseid;
		$transcript_array['Grade'] = $grade;
		$transcript_array['CreditAttempt'] = $creditattempt;
		$transcript_array['CreditEarned'] = $creditearned;
		$transcript_array['QualityPoints'] = $qualitypoints;
		
		$transcript_array['withdrawn_date'] = ($withdrawn_date != '')?$withdrawn_date:null;
		
		$transcript_array['completion_date'] = ($completion_date!= '')?$completion_date:null;
		
		$tablename = 'transcript';
		$testrecord = recordExist($transcript_array,$tablename);
		$response_array = array();
		$course_detail = $this->applicationModel->get_couse_detail_by_id($courseid);																	   

		if(!$testrecord){
			// echo "<pre>"; print_r($_POST); die;
			if($transcript_rowid != ''){

			     $check_old_grade = $this->applicationModel->check_old_grade($transcript_rowid);
			     
                		if($grade == 'W')
                		{
                		    if($withdrawn_date != '')
			                {
                        		    $now =  strtotime($withdrawn_date); // or your date as well
                                    $your_date = strtotime(date('Y-m-d',strtotime($course_detail['start_date'])));
                                    $datediff = $now - $your_date;
                                    $diff_days = round($datediff / (60 * 60 * 24));
                                    $refund_amount = 0;
                        		    if($diff_days <=14 && $diff_days >=0)
                        		    {
                        		        //$refund_amount = $course_detail['tuition'];
                        		        $refund_amount = 100;
                        		        
                        		    }
                        		    elseif($diff_days > 14 && $diff_days<=35)
                        		    {
                        		        //$refund_amount = ($course_detail['tuition']*50)/100;
                        		        $refund_amount = 50;
                        		    }
                        		    $transcript_param['refund_amount'] = $refund_amount;
                    		}
                    		
			            }
			            else
                		{
                		    $transcript_param['refund_amount'] = 0;
                		}

				$response = $this->applicationModel->updtateTranscriptDetails($transcript_param);
				
				 $this->applicationModel->update_group_student($transcript_rowid);
				
				if(strtoupper($grade) == 'SCH' || strtoupper($grade) == 'AUDIT' || strtoupper($grade == 'W')) {
					$email_data = array();
					$student_id = $this->request->getPost('student_id');
					$courseid = $this->request->getPost('courseid');
					$student_name = $this->applicationModel->getStudentName($student_id);
					$course_name = $this->applicationModel->getCourseTitleName($courseid);

					$email_data['student_name'] = $student_name['FirstName'].' '.$student_name['LastName'];
					$email_data['grade'] = $this->request->getPost('grade');
					$email_data['semester'] = $this->request->getPost('coursedates');
					$email_data['CourseName'] = $course_name['CourseTitle'];

					$subject = "Transcript Notification ";	
					$body = view('email_transcript', $email_data);
					
				}
			} else {
				
			     	if($grade == 'W')
            		{
            		    //$course_detail = $this->applicationModel->get_couse_detail_by_id($courseid);
            		    $now = strtotime($withdrawn_date); // or your date as well
                        $your_date = strtotime(date('Y-m-d',strtotime($course_detail['start_date'])));
                        $datediff = $now - $your_date;
                        $diff_days = round($datediff / (60 * 60 * 24));
                        $refund_amount = 0;
            		    if($diff_days <=14)
            		    {
            		        //$refund_amount = $course_detail['tuition'];
            		        $refund_amount = 100;
            		    }
            		    elseif($diff_days > 14 && $diff_days<=35)
            		    {
            		        //$refund_amount = ($course_detail['tuition']*50)/100;
            		        $refund_amount = 50;
            		    }
            		    $transcript_param['refund_amount'] = $refund_amount;
            		} 
            		else
            		{
            		    $transcript_param['refund_amount'] = 0;
            		}
			    
				
				$response = $this->applicationModel->submitTranscriptDetails($transcript_param);

				 $this->applicationModel->update_group_student($response['last_insert_id']);
				
				if(strtoupper($grade) == 'SCH' || strtoupper($grade) == 'AUDIT' || strtoupper($grade == 'W')) {
					$email_data = array();
					$student_id = $this->request->getPost('student_id');
					$courseid = $this->request->getPost('courseid');
					$student_name = $this->applicationModel->getStudentName($student_id);
					$course_name = $this->applicationModel->getCourseTitleName($courseid);

					$email_data['student_name'] = $student_name['FirstName'].' '.$student_name['LastName'];
					$email_data['grade'] = $this->request->getPost('grade');
					$email_data['semester'] = $this->request->getPost('coursedates');
					$email_data['CourseName'] = $course_name['CourseTitle'];

					$subject = "Transcript Notification ";	
					$body = view('email_transcript', $email_data);
					//Removed learn@future.edu By change Request Dated 10 Sept 2020 Fwd: Scheduling emails
					
					//$this->Sendmail_model->send(array(), array("learn@future.edu" => "learn","registrar@future.edu" => "registrar","accounts@future.edu" => "registrar"), $subject, $body,array());					$this->Sendmail_model->send(array(), array("registrar@future.edu" => "registrar","accounts@future.edu" => "registrar"), $subject, $body,array());
				}
			}
			$response_result = $this->applicationModel->updateStudentRecordsInfo($student_id);
			// echo "<pre>"; print_r($response_result); die;
			$QualityPoints = $response_result['QualityPoints'];
		    $CreditAttempt = $response_result['CreditAttempt'];	

		    if($grade == "SCH" || $grade == "AUDIT" || $grade == "TA" || $grade == "TB" || $grade == "TC" || $grade == "T"){
			  $gpa_calculate = 0;
			} else {
				$gpa_calculate = ($QualityPoints/$CreditAttempt);
			}

		    $gpa = number_format((float)$gpa_calculate, 2, '.', '');
		 
			if($response['msg']=='INSERTED'){
				$response_array['msg']='Record Inserted Successfully';
				$response_array['last_id']= $response['last_insert_id'];
				$response_array['encrypt_last_id'] = encryptor('encrypt',$response['last_insert_id']);
				$response_array['encrypt_student_id'] = encryptor('encrypt',$response['last_insert_id']);				
			} else {				
				$response_array['msg']='Record Updated Successfully';
				$response_array['last_id']= '';
			}
	    } else {
			$response_array['msg']='Record Already Exist or saved';
			$response_array['last_id']= '';
		}
		//print_r($transcript_param); die();
	 	echo json_encode($response_array, JSON_UNESCAPED_SLASHES);
	} 

    function getGradeValue(){
		
		//echo '<pre>'; print_r($_POST); die;
		$gradevalue= $this->request->getPost('gradename');
		$transcriptclasval = $this->request->getPost('transcriptclas');
		$result = $this->applicationModel->getGradeName($gradevalue,$transcriptclasval);
        $GradeValuecustom = $result['GradeValue'];
		
		//echo $GradeValuecustom;
		//$gradevalue=$result['GradeValue'];
	
 	   echo number_format((float)$GradeValuecustom, 2, '.', '');  
	}
}
